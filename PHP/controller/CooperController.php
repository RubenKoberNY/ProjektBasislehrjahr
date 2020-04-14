<?php


class CooperController
{
    public function __construct()
    {
        $this->CooperRepository = new CooperRepository();
    }

    public function getQuestionsAndAnswers()
    {
        $result = $this->CooperRepository->getQuestionsAndAnswersForCooper();
        for ($i = 0; $i < count($result); $i++) {
            unset($result[$i]["richtigeantwort"]);
            unset($result[$i]["punktezahl"]);
        }
        $result = array_values($result);
        return json_encode($result);
    }
}
