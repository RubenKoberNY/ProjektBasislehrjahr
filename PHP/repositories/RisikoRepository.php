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
}
