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
        if (!isset($_SESSION["uid"])) {
            return false;
        }

        $res_id = $this->werWirdMillionaerRepository->insertResult($_SESSION["uid"], 23, null);
        foreach ($arr as $qid => $rid) {
            $this->werWirdMillionaerRepository->insertUserAnswer($rid, $_SESSION["uid"], $res_id);
        }
        //$this->risikoRepository->insertResult($_SESSION["uid"]);
        return true;
    }

}
