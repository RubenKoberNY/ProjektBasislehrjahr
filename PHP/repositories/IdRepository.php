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
        return $stmt->get_result()->fetch_row();
    }

}