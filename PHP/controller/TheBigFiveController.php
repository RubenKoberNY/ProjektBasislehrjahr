<?php


class TheBigFiveController
{
    public function __construct()
    {
        $this->bigFiveRepository = new TheBigFiveRepository();
    }
    public function getAllQuestions() {
        $questionArray = $this->bigFiveRepository->getAllQuestionsFromBigFive();
        return json_encode($questionArray);
    }
}
