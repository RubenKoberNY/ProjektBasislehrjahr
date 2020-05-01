<?php


class LerntypController
{
    public function __construct()
    {
        $this->LerntypRepository = new LerntypRepository();
    }

    public function getQuestionsAndAnswers()
    {
        $questionArray = $this->LerntypRepository->getAllQuestionsFromLerntyp();
        return json_encode($questionArray);
    }

    /*   Überprüft, wie viele Antworten von welchem Typ ausgewählt wurden und gibt den ensprechenden Text zurück   */
    public function save($arr)
    {
        $correctAnswers = $this->LerntypRepository->getCorrectAnswers();
        $res_id = $this->LerntypRepository->insertResult($_SESSION["uid"], 16, null);
        $i = 0;
        $vi = $au = $le = $ki = 0;
        $msg = "";
        foreach ($arr as $k => $v) {
            switch ($v[0]) {
                case "A":
                    $au++;
                    break;
                case "V":
                    $vi++;
                case "R":
                    $le++;
                    break;
                case "K":
                    $ki++;
                    break;
            }
            if ($au == 3)
                {
                    $msg = "Auditiver Typ";
                }
            else if ($le == 3)
            {
                $msg = "Lesen und Schreibe Typ";
            }
            else if ($ki == 3)
            {
                $msg = "Kinästethischer Typ";
            }
            else if ($vi == 3)
            {
                $msg = "Visueller Typ";
            }
            else if ($au == 2)
            {
                $msg = "Auditiver Typ";
            }
            else if ($le == 2)
            {
                $msg = "Lesen und Schreibe Typ";
            }
            else if ($ki == 2)
            {
                $msg = "Kinästethischer Typ";
            }
            else if ($vi == 2)
            {
                $msg = "Visueller Typ";
            }
            $this->LerntypRepository->insertUserAnswer($this->LerntypRepository->getFrageByAntworttext($v), $_SESSION["uid"], $res_id);
            $i++;
        }
        Utils::redirect("/evaluation?hide=1&msg=".urlencode($msg));
    }
}
