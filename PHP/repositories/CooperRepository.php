<?php


class CooperRepository
{
    public function __construct()
    {
    }

    public function getQuestionsAndAnswersForCooper()
    {
        $sql = "call corona_prototype.getFrageAndAntwortFromQuizId(8);";
        $stmt = DB::getInstance()->prepare($sql);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_all(1);
            }
        }
        return null;
    }
}
