<?php


class BekanntheitController
{
    var $repository;

    public function __construct()
    {
        $this->repository = new BekanntheitRepository();
    }

    public function get()
    {
        header("Content-Type: application/json");
        return json_encode($this->repository->getAllQuestions());
    }

    public function save($arr)
    {
        $idController = new IdController();
        $idController->addRandomId(21);
        header("Content-Type: application/json");
        $res_id = null;
        if (isset($_SESSION['uid']))
            $res_id = $this->repository->insertResult($_SESSION["uid"], 21, null);
        $score = 0;

        foreach ($arr as $v) {
            $ans = $this->repository->getAnswerFromAnswerTextAndQuestionId($v->text, $v->id);
            if ($res_id != null)
                $this->repository->insertUserAnswer($ans[0], $_SESSION['uid'], $res_id);
            if ($ans[1] == 0) {
                $score += $ans[2];
            }
        }
        echo json_encode(array("score" => $score));
    }
    /*public function save($arr)
    {
        $correctAnswers = $this->repository->getCorrectAnswers();
        $res_id = $this->repository->insertResult($_SESSION["uid"], 21, null);
        $i = 0;
        $correct = 0;
        foreach ($arr as $k => $v) {
            $useranswer_id = $v;

            if ($useranswer_id + 166 == $correctAnswers[$i]["id_antwort"]) $correct++;
            $this->repository->insertUserAnswer($useranswer_id, $_SESSION["uid"], $res_id);
            $i++;
        }
        $msg = $this->repository->getAnwortText($correct);
        $this->repository->updateResultat($correct, $msg[0], $res_id);
        //Utils::redirect("/evaluation?chart=pie&right=" . $correct . "&wrong=" . (count($correctAnswers) - $correct) . "&msg=" . urlencode($msg[1]));
        //$this->repository = new BekanntheitRepository();
    }*/
}
