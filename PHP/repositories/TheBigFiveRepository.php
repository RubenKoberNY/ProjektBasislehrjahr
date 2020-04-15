<?php


class TheBigFiveRepository
{
    public function __construct()
    {
    }

public function getAllQuestionsFromBigFive()
{
    $query = "SELECT fragetext FROM frage WHERE quiz_id = 2";
    $stmt = DB::getInstance()->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    return $result;
}
public function createResult($userid, $quizid, $gameid) {
    $sql = "INSERT INTO resultat(benutzer_id, quiz_id, gameid_id, punktzahlantwort_id) VALUES(?, ?, ?, 2);";
    $stmt = DB::getInstance()->prepare($sql);
    $stmt->bind_param("iii", $userid, $quizid, $gameid);
    if($stmt->execute()) {
        return $stmt->insert_id;
    }
        return null;
}
public function insertUserResult($answerid, $userid, $resultid) {
    $sql = "INSERT INTO benutzerantwort(antwort_id, benutzer_id, resultat_id) VALUES (?, ?, ?)";
    $stmt = DB::getInstance()->prepare($sql);
    $stmt->bind_param("iii", $answerid, $userid, $resultid);
    if($stmt->execute()) {
        return $stmt->insert_id;
    }
        return null;
    }
}