<?php

class UserRepository
{
    public function __construct()
    {

    }

    public function getUserIdAndPasswordFromUserName($username)
    {
        $sql = "SELECT id_benutzer, passwort FROM benutzer WHERE benutzername = ?;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return null;
        }
    }
}
