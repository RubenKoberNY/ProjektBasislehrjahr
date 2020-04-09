<?php


class EinbuergerungRepository
{
    public function __construct()
    {



    }

    public function getAllQuestionsFromEinbuergerung()
    {
        //$query = "SELECT fragetext FROM frage WHERE quiz_id = 22";
        $query = "call corona_prototype.getFrageAndAntwortFromQuizId(22)";
        $stmt = DB::getInstance()->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        return $result;
    }

    public function getAllAnswersFromEinbuergerung()
    {
        $query = "SELECT frage.id_frage, antwortmöglichkeiten FROM antwort LEFT JOIN antwortfrage ON antwort.id_antwort = antwortfrage.antwort_id LEFT JOIN frage ON frage.id_frage = antwortfrage.frage_id WHERE frage.quiz_id = 22";
        $stmt = DB::getInstance()->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        return $result;
    }

    public function getCorrectAnswers()
    {
        $sql = "SELECT antwort.id_antwort FROM frage LEFT JOIN antwortfrage ON id_frage = antwortfrage.frage_id LEFT JOIN antwort ON antwortfrage.antwort_id = antwort.id_antwort WHERE antwort.richtigeantwort = 1 AND frage.quiz_id = 22;";
        $stmt = DB::getInstance()->prepare($sql);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows) {
                return $result->fetch_all(1);
            }
        }
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

    public function getAnwortText($points)
    {
        $sql = "SELECT id_punktzahlantwort, antworttext FROM punktzahlantwort WHERE ? between punktezahlvon AND puntzahlbis AND quiz_id = 22;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("i", $points);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_row();
    }

    public function updateResultat($points, $antworttext, $iid)
    {
        $sql = "UPDATE resultat SET gesamtPunktzahl = ? AND punktzahlantwort_id = ? WHERE id_resulte = ?;";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("iii", $points, $antworttext ,$iid);
        return $stmt->execute();
    }

}


