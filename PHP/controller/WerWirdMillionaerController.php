<?php


class WerWirdMillionaerController
{
    private $werWirdMillionaerRepository;

    public function __construct()
    {
        $this->werWirdMillionaerRepository = new WerWirdMillionaerRepository();
    }

    public function getQuestionsAndAnswers()
    {
        $result = $this->werWirdMillionaerRepository->getQuestionsAndAnswersForWerWirdMillionaer();
        for ($i = 0; $i < count($result); $i++) {
            unset($result[$i]["richtigeantwort"]);
            unset($result[$i]["punktzahl"]);
        }
        return json_encode($result);
    }

    public function save($arr)
    {
        $idController = new IdController();
        $idController->addRandomId(23);
        if (!isset($_SESSION["uid"])) {
            return false;
        }

        $res_id = $this->werWirdMillionaerRepository->insertResult($_SESSION["uid"], 23, null);
        $total = count($arr);
        $correct = 0;
        $correctAnswers = $this->werWirdMillionaerRepository->getCorrectAnswers();
        //print_r($correctAnswers);
        $i = 0;
        foreach ($arr as $qid => $rid) {
            $this->werWirdMillionaerRepository->insertUserAnswer($rid, $_SESSION["uid"], $res_id);
            if ($correctAnswers[$i]["id_antwort"] === $rid) {
                $correct++;
            }
            $i++;
        }
        $false = $total - $correct;
        $this->werWirdMillionaerRepository->updateGesamtPunktzahl($correct, $res_id);
        return $correct . "/" . $false;
    }

}
