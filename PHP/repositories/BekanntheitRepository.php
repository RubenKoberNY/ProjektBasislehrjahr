<?php


class BekanntheitRepository
{
    public function __construct()
    {
    }

    public function getAllQuestions()
    {
        $sql = "CALL getFrageFromQuizId(21)";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
