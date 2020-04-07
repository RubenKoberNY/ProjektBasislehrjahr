<?php


class TheBigFiveRepository
{
    public function __construct()
    {
    }

    public function getAllQuestionsFromBigFive()
    {
        $query = "SELECT * FROM frage WHERE quiz_id = 2";
        $stmt = DB::getInstance()->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        return $result;
    }
}
