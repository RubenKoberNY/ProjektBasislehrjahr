<?php


class RisikoController
{
    var $risikoRepository;

    public function __construct()
    {
        $this->risikoRepository = new RisikoRepository();
    }

    public function get()
    {
        header("Content-Type: application/json");
        $questions = $this->risikoRepository->getAllQuestions();
        for ($i = 0; $i < sizeof($questions); $i++) {
            $answers = $this->risikoRepository->getAnswersFromQuestionId($questions[$i]["id_frage"]);
            $questions[$i]["answers"] = $answers;
        }
        echo json_encode($questions);
    }

    public function save($arr)
    {

    }


}
