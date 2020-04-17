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
        return json_encode($this->repository->getAllQuestions());
    }

    public function save($arr)
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
        Utils::redirect("/evaluation?chart=pie&right=" . $correct . "&wrong=" . (count($correctAnswers) - $correct) . "&msg=" . urlencode($msg[1]));
        $this->repository = new BekanntheitRepository();
    }
}
