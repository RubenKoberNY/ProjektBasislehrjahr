<?php


class WerWirdMillionaerController
{
    private $werWirdMillionaerRepository;
    public function __construct()
    {
        $this->werWirdMillionaerRepository = new WerWirdMillionaerRepository();
    }

    public function getQuestionsAndAnswers(){
        return json_encode($this->werWirdMillionaerRepository->getQuestionsAndAnswersForWerWirdMillionaer());
    }

}
