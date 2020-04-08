<?php

class MaximisierungController
{
    private $MaximisierungRepository;
    public function __construct()
    {
        $this->MaximisierungRepository = new MaximisierungRepository();
    }

    public function save($arr)
    {
        if (!isset($_SESSION["uid"])) {
            return false;
        }

        $res_id = $this->MaximisierungRepository->insertResult($_SESSION["uid"], 15, null);
        $total = 0;
        foreach ($arr as $qid => $rid) {
            $this->MaximisierungRepository->insertUserAnswer($rid, $_SESSION["uid"], $res_id);
            $total += $rid;

        }
        $msg = $this->MaximisierungRepository->getAntwortText($total / 6);
        $this->MaximisierungRepository->updateResultat($total / 6, $msg[0], $res_id);

        return $msg[1];
    }


}
