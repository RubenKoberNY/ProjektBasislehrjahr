<?php


class IdRepository
{
    public function getQuizFromGameId($gameId){
        $sql = "";
        $stmt = DB::getInstance()->prepare($sql);
        if(!$stmt->execute()){
            return false;
        }
    }
}