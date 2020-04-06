<?php


class SocialmediaController
{
    public function __construct()
    {
        $this->SocialmediaRepository = new SocialmediaRepository();
    }

    public function getQuestionsAndAnswers()
    {
        $result = $this->SocialmediaRepository->getQuestionsAndAnswersForSocialMedia();
        for ($i = 0; $i < count($result); $i++) {
            unset($result[$i]["richtigeantwort"]);
            unset($result[$i]["punktzahl"]);
        }
        return json_encode($result);
    }
}
