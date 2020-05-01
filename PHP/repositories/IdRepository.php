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
        return $res->fetch_row();
    }

}