<?php

class UserRepository
{
    public function __construct()
    {

    }

    //Author: Ruben, Jan
    public function getUserIdAndPasswordFromUserName($username)
    {
        $sql = "SELECT id_benutzer, passwort FROM benutzer WHERE benutzername = ?;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_row();
            }
        }
        return null;
    }

    //Author: Michelle
    public function insertUser($firstname, $lastname, $username, $password)
    {
        $sql = "INSERT INTO benutzer (vorname, nachname, benutzername, passwort) VALUES (?, ?, ?, ?);";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("ssss", $firstname, $lastname, $username, password_hash($password, PASSWORD_DEFAULT));
        return $stmt->execute();
    }
}
