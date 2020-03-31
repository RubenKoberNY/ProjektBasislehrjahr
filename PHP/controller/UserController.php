<?php

class UserController
{
    private $userRepository = null;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }


    //Author: Ruben & Jan
    public function login($username, $password)
    {
        $uidAndPassword = $this->userRepository->getUserIdAndPasswordFromUserName($username);

        if ($uidAndPassword != null && password_verify($password, $uidAndPassword[1])) {

            if (session_status() == PHP_SESSION_NONE)
                session_start();
            $_SESSION = array();
            $_SESSION["uid"] = $uidAndPassword[0];
            $_SESSION["login"] = time();
            Utils::redirect("/dashboard");
        } else {
            Utils::redirect("/login", 401);
        }
    }

    //Author: Jan
    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        $_SESSION = array();
        $_SESSION["login"] = time();
        Utils::redirect("/login");
    }

    //Author: Michelle
    public function register($firstname, $lastname, $username, $pwd)
    {
        $inserted = $this->userRepository->insertUser($firstname, $lastname, $username, $pwd);
        if ($inserted) {
            Utils::redirect("/login");
        } else {
            Utils::redirect("/register");
        }
    }
}
