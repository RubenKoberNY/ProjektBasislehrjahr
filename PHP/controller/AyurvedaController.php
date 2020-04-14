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

        $correctAnswers = $this->AyurvedaRepository->getCorrectAnswers();
        $res_id = $this->AyurvedaRepository->insertResult($_SESSION["uid"], 14, null);
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
            $msg = "Vata - Du bist Lebhaft, gewandt, fröhlich und beliebt. Aber auch fahrig, sprunghaft und schnell gelangweilt. Du schläfst schlecht, neigst zu Atemwegserkrankungen und Gelenkbeschwerden. Du hast einen schmalen, leichten Körperbau.";
        } else if ($pitta == $most) {
            $msg = "Pitta - Du verfügst über einen grossen Appetit und einen scharfen Intellekt mit leichtem hang zu überkritischem Denken. Du bist enthusiastisch und leidenschaftlich. Du neigst zu nervösen Magenbeschwerden.";
        } else if ($kapha == $most) {
            $msg = "Kapha - Du bist ausgeglichen und entspannt. Deine langsame Auffassungsgabe kontrastiert ein gutes Langzeitgedächtnis. Dein Körperbau ist kräftig, das Haar dicht. Du bist ein guter Schläfer. Du neigst zu Gewichtsproblemen.";
        }
        Utils::redirect("/evaluation?hide=1&msg=" . urlencode($msg));
    }
}