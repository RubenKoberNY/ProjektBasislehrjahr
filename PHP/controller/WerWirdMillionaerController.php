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

}
