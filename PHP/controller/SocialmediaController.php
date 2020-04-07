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
        for ($i = 0; $i < 16; $i++) {
            unset($result[$i]["richtigeantwort"]);
            if ($result[$i]["punktezahl"] == 0) unset($result[$i]);
        }
        $result = array_values($result);
        return json_encode($result);
    }
}
