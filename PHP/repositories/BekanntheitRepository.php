<?php


class BekanntheitRepository
{
    const QUIZ_ID = 21;

    public function __construct()
    {
    }

    public function getAllQuestions()
    {
        $sql = "CALL getFrageFromQuizId(" . self::QUIZ_ID . ")";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAnswerFromAnswerTextAndQuestionId($answer_text, $id)
    {
        $sql = "SELECT 
                    id_antwort, richtigeantwort, punktezahl
                FROM
                    antwort
                WHERE
                    antwortmöglichkeiten = ?
                        AND id_antwort IN (SELECT 
                            antwort_id
                        FROM
                            antwortfrage
                        WHERE
                            frage_id = ?)";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("si", $answer_text, $id);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows)
            return $res->fetch_row();
        return false;
    }

    public function insertResult($uid, $quiz_id, $gamecode_id)
    {
        $sql = "INSERT INTO resultat(benutzer_id, quiz_id, gameid_id, punktzahlantwort_id) VALUES(?, ?, ?, 12);";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("iii", $uid, $quiz_id, $gamecode_id);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function insertUserAnswer($answer_id, $user_id, $result_id)
    {
        $sql = "INSERT INTO benutzerantwort(antwort_id, benutzer_id, resultat_id) VALUES(?, ?, ?)";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("iii", $answer_id, $user_id, $result_id);
        $stmt->execute();
        return $stmt->insert_id;
    }
}
