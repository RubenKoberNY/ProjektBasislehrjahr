<?php


class WerWirdMillionaerRepository
{
    public function __construct()
    {
    }

    public function getQuestionsAndAnswersForWerWirdMillionaer()
    {
        $sql = "call corona_prototype.getFrageAndAntwortFromQuizId(23);";
        $stmt = DB::getInstance()->prepare($sql);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows) {
                return $result->fetch_all(1);
            }
        }
        return null;
    }

    public function insertResult($uid, $quiz_id, $gamecode_id)
    {
        $sql = "INSERT INTO resultat(benutzer_id, quiz_id, gameid_id, punktzahlantwort_id) VALUES(?, ?, ?, 12);";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("iii", $uid, $quiz_id, $gamecode_id);
        if ($stmt->execute()) {
            return $stmt->insert_id;
        }
        return null;
    }

    public function updateGesamtPunktzahl($points, $iid){
        $sql = "UPDATE resultat SET gesamtPunktzahl = ? WHERE id_resulte = ?;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("ii", $points, $iid);
        return $stmt->execute();
    }

    public function insertUserAnswer($answer_id, $user_id, $result_id)
    {
        $sql = "INSERT INTO benutzerantwort(antwort_id, benutzer_id, resultat_id) VALUES(?, ?, ?)";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("iii", $answer_id, $user_id, $result_id);
        if ($stmt->execute()) {
            return $stmt->insert_id;

        }
        return null;
    }

    public function getCorrectAnswers()
    {
        $sql = "SELECT antwort.id_antwort FROM frage LEFT JOIN antwortfrage ON id_frage = antwortfrage.frage_id LEFT JOIN antwort ON antwortfrage.antwort_id = antwort.id_antwort WHERE antwort.richtigeantwort = 1 AND frage.quiz_id = 23;";
        $stmt = DB::getInstance()->prepare($sql);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows) {
                return $result->fetch_all(1);
            }
        }
        return null;
    }
}
