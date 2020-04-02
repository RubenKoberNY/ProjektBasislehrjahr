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
        if (!isset($_SESSION["uid"]))
            return false;

        $res_id = $this->risikoRepository->insertResult($_SESSION["uid"], 4, null);
        foreach ($arr as $v) {
            $this->risikoRepository->insertUserAnswer($v->id, $_SESSION["uid"], $res_id);
        }
        //$this->risikoRepository->insertResult($_SESSION["uid"]);
        return true;
    }


}
