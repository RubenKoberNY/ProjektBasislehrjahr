<?php


class IdRepository
{
    public function getQuizFromGameId($gameId){
        $sql = "";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
    }
}