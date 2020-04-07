<?php


class EinbuergerungRepository
{
    public function __construct()
    {



    }

    public function getAllQuestionsFromEinbuergerung()
    {
        $query = "SELECT fragetext FROM frage WHERE quiz_id = 22";
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


}


