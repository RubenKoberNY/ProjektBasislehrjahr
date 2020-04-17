<?php


class SelfleadershipController
{
    public function __construct()
    {
        $this->SelfleadershipRepository = new SelfleadershipRepository();
    }

    public function getQuestionsAndAnswers()
    {
        $questionArray = $this->SelfleadershipRepository->getAllQuestionsFromSelfleadership();
        return json_encode($questionArray);
    }

    public function save($arr)
    {
        if (!isset($_SESSION["uid"])) {
            return false;
        }

        $res_id = $this->SelfleadershipRepository->insertResult($_SESSION["uid"], 17, null);
        $total = 0;
        foreach ($arr as $qid => $rid) {
            $this->SelfleadershipRepository->insertUserAnswer($rid, $_SESSION["uid"], $res_id);
            $total += $rid;
        }
        $msg = $this->SelfleadershipRepository->getAntwortText($total);
        $this->SelfleadershipRepository->updateResultat($total, $msg[0], $res_id);

        return $msg[1];
    }
}
