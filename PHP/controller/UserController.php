<?php
    class UserController {
        private $userRepository = null;
        public function __construct() {
            $this->userRepository = new UserRepository();
        }

        //Author: Ruben & Jan
        public function login($username, $password){
            $uidAndPassword = $this->userRepository->getUserIdAndPasswordFromUserName($username);

            if($uidAndPassword != null && password_verify($password, $uidAndPassword[1])){

                if(session_status() == PHP_SESSION_NONE)
                    session_start();
                session_unset();
                $_SESSION["uid"] = $uidAndPassword[0];
                Utils::redirect("/dashboard");
            }else{
                Utils::redirect("/login", 401);

            }
        }
}
