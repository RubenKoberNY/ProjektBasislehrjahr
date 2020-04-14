<?php
if (!defined( "MYSQLI_ASSOC"))
define("MYSQLI_ASSOC", 1);

class SelfleadershipRepository
{
    public function __construct()
    {

    }

    public function insertUserAnswer($answer_id, $user_id, $result_id)
    {
        $sql = "INSERT INTO benutzerantwort(antwort_id, benutzer_id, resultat_id) VALUES(?,?,?)";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("iii", $answer_id, $user_id, $result_id);
        if ($stmt->execute())
        {
            return $stmt->insert_id;
        }
        return null;
    }

    public function getAnwortText($points)
    {
        $sql = "SELECT id_punktzahlantwort, antworttext FROM punktzahlantwort WHERE ? between punktezahlvon AND puntzahlbis AND quiz_id = 39;";
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
