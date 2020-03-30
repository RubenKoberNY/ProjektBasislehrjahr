<?php

    class UserController {
        private $userRepository = null;
        public function __construct() {
            $this->userRepository = new UserRepository();
        }

        //Author: Ruben & Jan
        public function login($username, $password){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $uidAndPassword = $this->userRepository->getUserIdAndPasswordFromUserName($username);
            if($hash==$uidAndPassword[1]){
                if(session_status() == PHP_SESSION_NONE)
                    session_start();
                session_unset();
                $_SESSION["uid"] = $uidAndPassword[0];
            }
        }
}
