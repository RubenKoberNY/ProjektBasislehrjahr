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

    //Author: Jan
    public function getQuizzesFromUserId($uid)
    {
        $sql = "SELECT 
                    id_quiz,
                    Quiz
                FROM
                    quiz
                WHERE
                id_quiz IN (SELECT quiz_id FROM resultat WHERE benutzer_id = ?) LIMIT 5";

        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("i", $uid);
        return $this->fetchAssoc($stmt);
    }

    public function getResultIdFromUserId($uid, $limit = false)
    {
        $sql = "SELECT id_resulte 'id' FROM resultat WHERE benutzer_id = ? ORDER BY id_resulte DESC";
        if ($limit && is_numeric($limit))
            $sql .= " LIMIT ?";
        $stmt = DB::getInstance()->prepare($sql);
        if ($limit && is_numeric($limit))
            $stmt->bind_param("ii", $uid, $limit);
        else
            $stmt->bind_param("i", $uid);
        return $this->fetchAssoc($stmt);
    }

    public function getQuizzesAndAnswersFromUserId($uid)
    {
        $quizzes = $this->getResultIdFromUserId($uid, 5);
        $out = array();
        if ($quizzes) {
            foreach ($quizzes as $v) {
                array_push($out, array("quiz" => $this->getQuizFromResultId($v['id']), "qna" => $this->getQuestionsAndAnswersFromResultId($v['id'])));
            }
        }
        return $out;
    }

    public function getQuizFromResultId($resid)
    {
        $sql = "SELECT id_quiz, Quiz FROM quiz WHERE id_quiz IN (SELECT quiz_id FROM resultat WHERE id_resulte = ?)";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("i", $resid);
        $res = $this->fetchRow($stmt);
        if ($res[0] == false) {
            error_log("Query returned null values on result id: $resid");
        }
        return array("id" => $res[0], "quiz" => $res[1]);
    }

    public function getQuestionsAndAnswersFromResultId($resid)
    {
        $sql = "SELECT fragetext, antwortmöglichkeiten 'antwort' FROM frage
                INNER JOIN antwortfrage ON antwortfrage.frage_id = frage.id_frage
                INNER JOIN antwort ON antwort.id_antwort = antwortfrage.antwort_id
                INNER JOIN benutzerantwort ON benutzerantwort.antwort_id = antwort.id_antwort
                WHERE benutzerantwort.resultat_id = ?";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("i", $resid);
        return $this->fetchAssoc($stmt);
    }

    private function fetchRow($stmt)
    {
        if ($stmt->execute()) {
            $res = $stmt->get_result();
            if ($res->num_rows) {
                return $res->fetch_row();
            }
        }
        return false;
    }

    private function fetchAssoc($stmt)
    {
        if ($stmt->execute()) {
            $res = $stmt->get_result();
            if ($res->num_rows) {
                return $res->fetch_all(MYSQLI_ASSOC);
            }
        }
        return false;
    }
}
