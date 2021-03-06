<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//UTILITIES
require "utilities/Render.php";
require "utilities/Utils.php";
require "utilities/DB.php";

//REPOSITORIES
require "repositories/UserRepository.php";
require "repositories/AyurvedaRepository.php";
require "repositories/BekanntheitRepository.php";
require "repositories/CooperRepository.php";
require "repositories/EinbuergerungRepository.php";
require "repositories/LerntypRepository.php";
require "repositories/LiegestuetzeRepository.php";
require "repositories/MaximisierungRepository.php";
require "repositories/RisikoRepository.php";
require "repositories/SelfleadershipRepository.php";
require "repositories/SocialmediaRepository.php";
require "repositories/TheBigFiveRepository.php";
require "repositories/WerWirdMillionaerRepository.php";
require "repositories/WorklifeRepository.php";
require "repositories/IdRepository.php";

//CONTROLLER
require "controller/UserController.php";
require "controller/AyurvedaController.php";
require "controller/BekanntheitController.php";
require "controller/CooperController.php";
require "controller/EinbuergerungController.php";
require "controller/LerntypController.php";
require "controller/LiegestuetzeController.php";
require "controller/MaximisierungController.php";
require "controller/RisikoController.php";
require "controller/SelfleadershipController.php";
require "controller/SocialmediaController.php";
require "controller/TheBigFiveController.php";
require "controller/WerWirdMillionaerController.php";
require "controller/WorklifeController.php";
require "controller/IdController.php";

require './vendor/autoload.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start(); //start session if not started
}
$timeout = (24 * 60 * 60); //set session timeout in seconds

if (isset($_SESSION["login"])) {
    if ($_SESSION["login"] - time() < (-1 * $timeout)) { //set the session timeout
        $userController = new UserController();
        $userController->logout();
    }
}

$uri = strtok($_SERVER["REQUEST_URI"], '?'); //get the request uri
$path = "./";
const BASE_URL = "/";
$GLOBALS["BASE_URL"] = BASE_URL;
$allowed = array(BASE_URL . "login", BASE_URL . "api/login", BASE_URL . "api/register", BASE_URL . "register", BASE_URL . "", BASE_URL . "api/idlogin", BASE_URL . "api/loadfile", BASE_URL . "datenschutz", BASE_URL . "impressum"); //all pages that can be visited without login
if ((!in_array($uri, $allowed)) && !isset($_SESSION["uid"])) { //redirect to login if requested page requires a user
    Utils::redirect("/login", 401);
}
$c = new \Slim\Container();

//Override the default Not Found Handler before creating App
$c['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $response->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write('<script>window.location="' . BASE_URL . '/quiz/notfound"</script>');
    };
};

$app = new \Slim\App($c);


$app->get("/", function (Request $request, Response $response, array $args) {
    if (isset($_SESSION["uid"]) && $_SESSION["uid"] != "gameid") {
        Utils::redirect("/dashboard");
    } else {
        Utils::redirect("/login");
    }
});

//Router
$app->get("/quiz/{quiz}", function (Request $request, Response $response, array $args) {
    $idController = new IdController();
    $quiz = array_search($args["quiz"], Utils::$map);
    $gameIdCode = "<h6 class='white-text'>Game-ID: " . $idController->getGameId($quiz) . "</h6>";
    error_log($gameIdCode);
    Render::render($args["quiz"] . "/quiz.html", $args["quiz"] . "/style.css", $args["quiz"] . "/script.js", array("gameid" => $gameIdCode));
});

$app->get("/dashboard", function (Request $request, Response $response, array $args) {
    Render::render("general/index.html", null, "static/js/index.js");
});

$app->get("/datenschutz", function (Request $request, Response $response, array $args) {
    Render::render("general/datenschutz.html", null, null, array(), true);
});
// Login Frontend
$app->get("/login", function (Request $request, Response $response, array $args) {
    if (isset($_SESSION["uid"]) && $_SESSION["uid"] != "gameid") Utils::redirect(BASE_URL);
    Render::render("general/login.html", null, null, array(), true);
});

$app->get("/logout", function (Request $request, Response $response, array $args) {
    $userController = new UserController();
    $userController->logout();
});

$app->get("/impressum", function (Request $request, Response $response, array $args) {
    Render::render("general/impressum.html", null, null, array(), true);
});

$app->get("/evaluation", function (Request $request, REsponse $response, array $args) {
    Render::render("general/auswertung.html", null, null, array(), true);
});
//API
$app->post("/api/login", function (Request $request, Response $response, array $args) {
    $userController = new UserController();
    $userController->login($_POST["username"], $_POST["password"]);
});

$app->post("/api/logout", function (Request $request, Response $response, array $args) {
    $userController = new UserController();
    $userController->logout();
});

$app->post("/api/idlogin", function (Request $request, Response $response, array $args) {
    $idController = new IdController();
    $idController->login($_POST["game_id"]);
});

$app->post("/api/register", function (Request $request, Response $response, array $args) {
    $userController = new UserController();
    $userController->register(trim($_POST["first_name"]), trim($_POST["last_name"]), trim($_POST["username"]), $_POST["password"]);
});

$app->get("/api/werwirdmillionaer/get", function (Request $request, Response $response, array $args) {
    $werWirdMillionaerController = new WerWirdMillionaerController();
    $qna = $werWirdMillionaerController->getQuestionsAndAnswers();
    $response->getBody()->write($qna);
});

$app->post("/api/werwirdmillionaer/post", function (Request $request, Response $response, array $args) {
    $werWirdMillionaerController = new WerWirdMillionaerController();
    $data = (array)json_decode(file_get_contents('php://input'));
    echo $werWirdMillionaerController->save($data);
});

$app->get("/api/risiko/get", function (Request $request, Response $response, array $args) {
    $risikoController = new RisikoController();
    $risikoController->get();
});

$app->post("/api/risiko/post", function (Request $request, Response $response, array $args) {
    $risikoController = new RisikoController();
    $data = json_decode(file_get_contents('php://input'));
    echo json_encode($risikoController->save($data));
});

$app->get("/api/thebigfive/get", function (Request $request, Response $response, array $args) {
    $theBigFiveController = new TheBigFiveController();
    $questions = $theBigFiveController->getAllQuestions();
    $response->getBody()->write($questions);
});
$app->get("/api/socialmedia/get", function (Request $request, Response $response, array $args) {
    $socialmediaController = new SocialmediaController();
    echo $socialmediaController->getQuestionsAndAnswers();
});

$app->post("/api/socialmedia/post", function (Request $request, Response $response, array $args) {
    $socialmediaController = new SocialmediaController();
    $socialmediaController->save($_POST);
});

$app->get("/api/einbuergerung/get", function (Request $request, Response $response, array $args) {
    $einbuergerungController = new EinbuergerungController();
    echo $einbuergerungController->getQuestionsAndAnswers();
});

$app->post("/api/einbuergerung/post", function (Request $request, Response $response, array $args) {
    $einbuergerungController = new EinbuergerungController();
    $einbuergerungController->save($_POST);
});

$app->post("/api/maximisierung/post", function (Request $request, Response $response, array $args) {
    $maximisierungController = new MaximisierungController();
    echo $maximisierungController->save((array)json_decode(file_get_contents('php://input')));
});
$app->get("/api/lerntyp/get", function (Request $request, Response $response, array $args) {
    $lerntypController = new LerntypController();
    echo $lerntypController->getQuestionsAndAnswers();
});

$app->post("/api/lerntyp/post", function (Request $request, Response $response, array $args) {
    $lerntypController = new LerntypController();
    $lerntypController->save($_POST);
});

$app->get("/api/ayurveda/get", function (Request $request, Response $response, array $args) {
    $ayurvedaController = new AyurvedaController();
    echo $ayurvedaController->getQuestionsAndAnswers();
});

$app->post("/api/ayurveda/post", function (Request $request, Response $response, array $args) {
    $ayurvedaController = new AyurvedaController();
    $ayurvedaController->save($_POST);
});
$app->post("/api/thebigfive/post", function (Request $request, Response $response, array $args) {
    $bigFiveController = new TheBigFiveController();
    $data = json_decode(file_get_contents('php://input'));
    echo $bigFiveController->save($data);
});

$app->get("/api/cooper/get", function (Request $request, Response $response, array $args) {
    $cooperController = new CooperController();
    echo $cooperController->getQuestionsAndAnswers();
});

$app->post("/api/cooper/post", function (Request $request, Response $response, array $args) {
    $cooperController = new CooperController();
    $cooperController->save($_POST);
});

$app->get("/api/worklife/get", function (Request $request, Response $response, array $args) {
    $worklifeController = new WorklifeController();
    echo $worklifeController->getQuestionsAndAnswers();
});

$app->post("/api/worklife/post", function (Request $request, Response $response, array $args) {
    $worklifeController = new WorklifeController();
    $worklifeController->save($_POST);
});

$app->get("/api/selfleadership/get", function (Request $request, Response $response, array $args) {
    $selfleadershipController = new SelfleadershipController();
    echo $selfleadershipController->getQuestionsAndAnswers();
});

$app->post("/api/selfleadership/post", function (Request $request, Response $response, array $args) {
    $selfleadershipController = new SelfleadershipController();
    $selfleadershipController->save($_POST);
});

$app->get("/api/bekanntheit/get", function (Request $request, Response $response, array $args) {
    $bekanntheitController = new BekanntheitController();
    echo $bekanntheitController->get();
});

$app->post("/api/bekanntheit/post", function (Request $request, Response $response, array $args) {
    $bekanntheitController = new BekanntheitController();
    $data = json_decode(file_get_contents('php://input'));
    echo $bekanntheitController->save($data);
});

$app->get("/api/loadfile", function (Request $request, Response $response, array $args) {
    global $path;
    if (!isset($_GET["file"]) || !isset($_GET["type"])) return;
    $filepath = $path . $_GET["file"];
    if (!file_exists($filepath)) return;
    $temp = $response->withStatus(200);
    if ($_GET["type"] == "css") {
        $temp = $temp->withHeader('Content-Type', 'text/css');
    } elseif ($_GET["type"] == "js") {
        $temp = $temp->withHeader('Content-Type', 'text/script');
    }
    return $temp->write(str_replace("%BASE_URL%", BASE_URL, file_get_contents($filepath)));
});

$app->get(BASE_URL . "api/questions/get", function (Request $request, Response $response, array $args) {
    header("Content-Type: application/json");
    $userController = new UserController();
    if (isset($_SESSION['uid']) && $_SESSION['uid'] != 'gameid')
        $userController->printAllQuizzes($_SESSION['uid']);
    else
        echo "{}";
});

$app->run();
