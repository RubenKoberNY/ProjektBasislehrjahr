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
        if (isset($_SESSION["uid"])) {
            $res_id = $this->BekanntheitRepository->insertResult($_SESSION["uid"], 4, null);
            for ($i = 0; $i < sizeof($arr); $i++) {
                $this->BekanntheitRepository->insertUserAnswer($arr[$i]->id, $_SESSION["uid"], $res_id);
            }
        }
        $scores = array(0, 0);
        for ($i = 0; $i < sizeof($arr); $i++) {
            if ($i < 3) {
                $scores[0] += $this->BekanntheitRepository->getScoreFromAnswerId($arr[$i]->id);
            } else {
                $scores[1] += $this->BekanntheitRepository->getScoreFromAnswerId($arr[$i]->id);
            }
        }
        return $scores;
    }
}
