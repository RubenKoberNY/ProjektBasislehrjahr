<?php

    class UserController {
        private $userRepository = null;
        public function __construct() {
            $this->userRepository = new UserRepository();
        }

        public function login($username, $password){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $uidAndPassword = $this->userRepository->getUserIdFromUserNameAndPassword($username);
        }
}
