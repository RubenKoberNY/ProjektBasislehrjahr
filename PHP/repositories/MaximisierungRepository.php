<?php

if (!defined( "MYSQLI_ASSOC"))
    define("MYSQLI_ASSOC", 1);

class MaximisierungRepository
{
    public function __construct()
    {
    }

    public function getQuestions()
    {
        $sql = "CALL maximierung_getQuestions()";
        $statement = DB::getInstance()->prepare($sql);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAnswersFromQuestionId($id)
    {
        $sql = "CALL maximierung_getAnswersFromQuestionId(?)";
        $statement = DB::getInstance()->prepare($sql);
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function insertResult($uid, $quiz_id, $gamecode_id)
    {
        $sql = "INSERT INTO resultat(benutzer_id, quiz_id, game_id) VALUES (?,?,?);";
        $statement = DB::getInstance()->prepare($sql);
        $statement->bind_param("iii", $uid,  $quiz_id, $gamecode_id);
        $statement->execute();
        return $statement->insert_id;
    }

    public function insertUserAnswer($answer_id, $user_id, $result_id)
    {
        $sql = "INSERT INTO benutzerantwort(antwort_id, benutzer_id, resultat_id) VALUES (?,?,?);";
        $statement = DB::getInstance()->prepare($sql);
        $statement->bind_param("iii", $answer_id,$user_id, $result_id);
        $statement->execute();
        return $statement->insert_id;
    }




}
