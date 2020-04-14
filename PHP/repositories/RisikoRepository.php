<?php

if (!defined("MYSQLI_ASSOC"))
    define("MYSQLI_ASSOC", 1);

class RisikoRepository
{
    public function __construct()
    {
    }

    public function getAllQuestions()
    {
        $sql = "CALL risiko_getAllFrage()";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAnswersFromQuestionId($id)
    {
        $sql = "CALL risiko_getAntwortFromFrageId(?)";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function insertResult($uid, $quiz_id, $gamecode_id)
    {
        $sql = "INSERT INTO resultat(benutzer_id, quiz_id, gameid_id, punktzahlantwort_id) VALUES(?, ?, ?, 12);";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("iii", $uid, $quiz_id, $gamecode_id);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function insertUserAnswer($answer_id, $user_id, $result_id)
    {
        $sql = "INSERT INTO benutzerantwort(antwort_id, benutzer_id, resultat_id) VALUES(?, ?, ?)";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("iii", $answer_id, $user_id, $result_id);
        $stmt->execute();
        return $stmt->insert_id;
    }
}
