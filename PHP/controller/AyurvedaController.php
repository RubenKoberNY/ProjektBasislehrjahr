<?php


class AyurvedaController
{
    public function __construct()
    {
        $this->AyurvedaRepository = new AyurvedaRepository();
    }

    public function getQuestionsAndAnswers()
    {
        $questionArray = $this->AyurvedaRepository->getAllQuestionsFromAyurveda();
        return json_encode($questionArray);
    }

    public function save($arr)
    {

        $correctAnswers = $this->AryuvedaRepository->getCorrectAnswers();
        $res_id = $this->AryuvedaRepository->insertResult($_SESSION["uid"], 14, null);
        $i = 0;
        $vata = $pitta = $kapha = 0;
        $msg = "";
        foreach ($arr as $k => $v) {
            switch ($v[0]) {
                case "A":
                    $vata++;
                    break;
                case "B":
                    $pitta++;
                    break;
                case "C":
                    $kapha++;
                    break;
            }
            $this->AyurvedaRepository->insertUserAnswer($this->AyurvedaRepository->getFrageByAntworttext($v), $_SESSION["uid"], $res_id);
            $i++;
        }
        $most = max($vata, $pitta, $kapha);
        if ($vata == $most) {
            $msg = "Vata";
        } else if ($pitta == $most) {
            $msg = "Pitta";
        } else if ($kapha == $most) {
            $msg = "Kapha";
        }
        Utils::redirect("/evaluation?hide=1&msg=" . urlencode($msg));
    }
}