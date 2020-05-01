<?php


class IdRepository
{
    public function getQuizFromGameId($gameId)
    {
        $sql = "CALL getQuizFromGameId(?);";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("s", $gameId);
        if (!$stmt->execute()) {
            return false;
        }
        $res = $stmt->get_result();
        if (!$stmt->num_rows)
            return false;
        return $res->fetch_row();
    }

    public function getGameIdFromQuiz($quiz)
    {
        $sql = "CALL getGameIdFromQuiz(?);";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("s", $quiz);
        if (!$stmt->execute()) {
            return false;
        }
        $res = $stmt->get_result();
        if (!$res->num_rows) {
            return false;
        }
        return $res->fetch_row();
    }

}