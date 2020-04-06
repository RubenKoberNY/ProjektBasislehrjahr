<?php


class SocialmediaRepository
{
    public function __construct()
    {
    }

    public function getQuestionsAndAnswersForSocialMedia()
    {
        $sql = "call corona_prototype.getFrageAndAntwortFromQuizId(20);";
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
