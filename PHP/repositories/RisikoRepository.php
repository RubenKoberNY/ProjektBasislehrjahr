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

    public function insertResult($uid, $user_answer_id, $quiz_id, $gamecode_id, $score_answer_id)
    {
        $sql = "INSERT INTO resultat(benutzer_id, benutzerantwort_id, quiz_id, gameid_id, punktzahlantwort_id) VALUES(?, ?, ?, ?, ?);";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bindParam("iiiii", $uid, $user_answer_id, $quiz_id, $gamecode_id, $score_answer_id);
        return $stmt->execute();
    }
}
