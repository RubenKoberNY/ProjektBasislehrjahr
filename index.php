<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Http\UploadedFile;
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


require './vendor/autoload.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start(); //start session if not started
}

$timeout = 1800; //set session timeout in seconds

if (isset($_SESSION["login"]) && $_SESSION["login"] - time() < (-1 * $timeout)) { //set the session timeout
    $_SESSION = array(); //reset session array
}

$uri = $_SERVER["REQUEST_URI"]; //get the request uri

$allowed = array("/login", "/api/login", "/api/register", "/register", "/"); //all pages that can be visited without login
if (!in_array($uri, $allowed) && !isset($_SESSION["uid"])) { //redirect to login if requested page requires a user
    //TODO: uncomment next line(line is only a comment because login isn't working yet)
    //Utils::redirect("/login", 401);
}
$c = new \Slim\Container();

//Override the default Not Found Handler before creating App
$c['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $response->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write('<script>window.location="/quiz/notfound"</script>');//i bi ä  boum
    };
};

$app = new \Slim\App($c);

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello world");
    return $response;
});

//Router
$app->get("/quiz/{quiz}", function (Request $request, Response $response, array $args) {
    Render::render($args["quiz"] . "/quiz.html", $args["quiz"] . "/style.css", $args["quiz"] . "/script.js");
});

// Login Frontend
$app->get("/login", function(Request $request, Response $response, array $args ){
    Render::render("general/login.html");
});
//Register Frontend
$app->get("/register", function(Request $request, Response $response, array $args){
    Render::render("general/register.html");
});

//API
$app->post("/api/login", function (Request $request, Response $response, array $args){
    $userController = new UserController();
    $userController->login($_POST["username"], $_POST["password"]);
});

$app->post("/api/register", function(Request $request, Response $response, array $args){

});

$app->get("/debug/{password}", function(Request $request, Response $response, array $args){
    echo password_hash($args["password"], PASSWORD_DEFAULT);
});
$app->run();

