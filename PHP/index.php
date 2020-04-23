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
$path = substr(__FILE__, 0, -strlen($_SERVER['SCRIPT_NAME'])) . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR;
const BASE_URL = "/";
$GLOBALS["BASE_URL"] = BASE_URL;
$allowed = array(BASE_URL . "login", BASE_URL . "api/login", BASE_URL . "api/register", BASE_URL . "register", BASE_URL . "", BASE_URL . "api/idlogin", BASE_URL . "api/loadfile"); //all pages that can be visited without login
if ((!in_array($uri, $allowed)) && !isset($_SESSION["uid"])) { //redirect to login if requested page requires a user
    Utils::redirect(BASE_URL . "login", 401);
}
$c = new \Slim\Container();

//Override the default Not Found Handler before creating App
$c['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $response->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write('<script>window.location="'. BASE_URL . '/quiz/notfound"</script>');
    };
};

$app = new \Slim\App($c);


$app->get(BASE_URL, function (Request $request, Response $response, array $args) {
    if (isset($_SESSION["uid"])) {
        Utils::redirect(BASE_URL . "dashboard");
    } else {
        Utils::redirect(BASE_URL . "login");
    }
});

//Router
$app->get(BASE_URL . "quiz/{quiz}", function (Request $request, Response $response, array $args) {
    Render::render($args["quiz"] . "/quiz.html", $args["quiz"] . "/style.css", $args["quiz"] . "/script.js");
});

$app->get(BASE_URL . "dashboard", function (Request $request, Response $response, array $args) {
    Render::render("general/index.html");
});
// Login Frontend
$app->get(BASE_URL . "login", function (Request $request, Response $response, array $args) {
    if (isset($_SESSION["uid"]))
        Utils::redirect(BASE_URL . "/");
    Render::render("general/login.html", "static/css/login.css", "static/js/login.js", array(), true);
});

$app->get(BASE_URL . "logout", function (Request $request, Response $response, array $args) {
    $userController = new UserController();
    $userController->logout();
});


$app->get(BASE_URL . "impressum", function (Request $request, Response $response, array $args){
    Render::render("general/impressum.html", null,null);
});

$app->get(BASE_URL . "evaluation", function (Request $request, REsponse $response, array $args) {
    Render::render("general/auswertung.html", null, null, array(), true);
});
//API
$app->post(BASE_URL . "api/login", function (Request $request, Response $response, array $args) {
    $userController = new UserController();
    $userController->login($_POST["username"], $_POST["password"]);
});

$app->post(BASE_URL . "api/logout", function (Request $request, Response $response, array $args) {
    $userController = new UserController();
    $userController->logout();
});

$app->post(BASE_URL . "api/idlogin", function (Request $request, Response $response, array $args) {
    $idController = new IdController();
    $idController->login($_POST["game_id"]);
});

$app->post(BASE_URL . "api/register", function (Request $request, Response $response, array $args) {
    $userController = new UserController();
    $userController->register(trim($_POST["first_name"]), trim($_POST["last_name"]), trim($_POST["username"]), $_POST["password"]);
});

$app->get(BASE_URL . "api/werwirdmillionaer/get", function (Request $request, Response $response, array $args) {
    $werWirdMillionaerController = new WerWirdMillionaerController();
    $qna = $werWirdMillionaerController->getQuestionsAndAnswers();
    $response->getBody()->write($qna);
});

$app->post(BASE_URL . "api/werwirdmillionaer/post", function (Request $request, Response $response, array $args) {
    $werWirdMillionaerController = new WerWirdMillionaerController();
    $data = (array)json_decode(file_get_contents('php://input'));
    echo $werWirdMillionaerController->save($data);
});

$app->get(BASE_URL . "api/risiko/get", function (Request $request, Response $response, array $args) {
    $risikoController = new RisikoController();
    $risikoController->get();
});

$app->post(BASE_URL . "api/risiko/post", function (Request $request, Response $response, array $args) {
    $risikoController = new RisikoController();
    $data = json_decode(file_get_contents('php://input'));
    echo json_encode($risikoController->save($data));
});

$app->get(BASE_URL . "api/thebigfive/get", function (Request $request, Response $response, array $args) {
    $theBigFiveController = new TheBigFiveController();
    $questions = $theBigFiveController->getAllQuestions();
    $response->getBody()->write($questions);
});
$app->get(BASE_URL . "api/socialmedia/get", function (Request $request, Response $response, array $args) {
    $socialmediaController = new SocialmediaController();
    echo $socialmediaController->getQuestionsAndAnswers();
});

$app->post(BASE_URL . "api/socialmedia/post", function (Request $request, Response $response, array $args) {
    $socialmediaController = new SocialmediaController();
    $socialmediaController->save($_POST);
});

$app->get(BASE_URL . "api/einbuergerung/get", function (Request $request, Response $response, array $args) {
    $einbuergerungController = new EinbuergerungController();
    echo $einbuergerungController->getQuestionsAndAnswers();
});

$app->post(BASE_URL . "api/einbuergerung/post", function (Request $request, Response $response, array $args) {
    $einbuergerungController = new EinbuergerungController();
    $einbuergerungController->save($_POST);
});

$app->post(BASE_URL . "api/maximisierung/post", function (Request $request, Response $response, array $args) {
    $maximisierungController = new MaximisierungController();
    echo $maximisierungController->save((array)json_decode(file_get_contents('php://input')));
});
$app->get(BASE_URL . "api/lerntyp/get", function (Request $request, Response $response, array $args) {
    $lerntypController = new LerntypController();
    echo $lerntypController->getQuestionsAndAnswers();
});

$app->post(BASE_URL . "api/lerntyp/post", function (Request $request, Response $response, array $args) {
    $lerntypController = new LerntypController();
    $lerntypController->save($_POST);
});

$app->get(BASE_URL . "api/ayurveda/get", function (Request $request, Response $response, array $args) {
    $ayurvedaController = new AyurvedaController();
    echo $ayurvedaController->getQuestionsAndAnswers();
});

$app->post(BASE_URL . "api/ayurveda/post", function (Request $request, Response $response, array $args) {
    $ayurvedaController = new AyurvedaController();
    $ayurvedaController->save($_POST);
});
$app->post(BASE_URL . "api/thebigfive/post", function (Request $request, Response $response, array $args) {
    $bigFiveController = new TheBigFiveController();
    $data = json_decode(file_get_contents('php://input'));
    echo $bigFiveController->save($data);
});

$app->get(BASE_URL . "api/cooper/get", function (Request $request, Response $response, array $args) {
    $cooperController = new CooperController();
    echo $cooperController->getQuestionsAndAnswers();
});

$app->post(BASE_URL . "api/cooper/post", function (Request $request, Response $response, array $args) {
    $cooperController = new CooperController();
    $cooperController->save($_POST);
});

$app->get(BASE_URL . "api/worklife/get", function (Request $request, Response $response, array $args) {
    $worklifeController = new WorklifeController();
    echo $worklifeController->getQuestionsAndAnswers();
});

$app->post(BASE_URL . "api/worklife/post", function (Request $request, Response $response, array $args) {
    $worklifeController = new WorklifeController();
    $worklifeController->save($_POST);
});

$app->get(BASE_URL . "api/selfleadership/get", function (Request $request, Response $response, array $args) {
    $selfleadershipController = new SelfleadershipController();
    echo $selfleadershipController->getQuestionsAndAnswers();
});

$app->post(BASE_URL . "api/selfleadership/post", function (Request $request, Response $response, array $args) {
    $selfleadershipController = new SelfleadershipController();
    $selfleadershipController->save($_POST);
});

$app->get(BASE_URL . "api/bekanntheit/get", function (Request $request, Response $response, array $args) {
    $bekanntheitController = new BekanntheitController();
    echo $bekanntheitController->get();
});

$app->post(BASE_URL . "api/bekanntheit/post", function (Request $request, Response $response, array $args) {
    $bekanntheitController = new BekanntheitController();
    $data = json_decode(file_get_contents('php://input'));
    echo $bekanntheitController->save($data);
});


$app->get(BASE_URL . "api/loadfile", function (Request $request, Response $response, array $args) {
    global $path;
    if (file_exists($path)) {
        Render::render( $_GET["file"], null, null, array("BASE_URL" => BASE_URL), true);
    }
});
$app->run();
