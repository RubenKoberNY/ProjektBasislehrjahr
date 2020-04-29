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
        $idController = new IdController();
        $idController->addRandomId(4);
        if (isset($_SESSION["uid"])) {
            $res_id = $this->risikoRepository->insertResult($_SESSION["uid"], 4, null);
            for ($i = 0; $i < sizeof($arr); $i++) {
                $this->risikoRepository->insertUserAnswer($arr[$i]->id, $_SESSION["uid"], $res_id);
            }
        }
        $scores = array(0, 0);
        for ($i = 0; $i < sizeof($arr); $i++) {
            if ($i < 3) {
                $scores[0] += $this->risikoRepository->getScoreFromAnswerId($arr[$i]->id);
            } else {
                $scores[1] += $this->risikoRepository->getScoreFromAnswerId($arr[$i]->id);
            }
        }
        return $scores;
    }
}
