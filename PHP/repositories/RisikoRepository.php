<?php


class RisikoRepository
{

    const ID_QUIZ = 4;

    public function __construct()
    {
    }

    public function getAllQuestions()
    {
        $sql = "CALL getFrageFromQuizId(?)";
        $stmt = DB::getInstance()->prepare($sql);
        $id = self::ID_QUIZ;
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAnswersFromQuestionId($id)
    {
        $sql = "CALL getAntwortFromFrageId(?)";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
