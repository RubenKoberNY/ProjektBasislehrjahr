<?php


class LerntypController
{
    public function __construct()
    {
        $this->LerntypRepository = new LerntypRepository();
    }

    public function getQuestionsAndAnswers()
    {
        $questionArray = $this->LerntypRepository->getAllQuestionsFromLerntyp();
        return json_encode($questionArray);
    }

    public function save($arr)
    {

        $correctAnswers = $this->LerntypRepository->getCorrectAnswers();
        $res_id = $this->LerntypRepository->insertResult($_SESSION["uid"], 16, null);
        $i = 0;
        $auditiv = $visuell = $leseundschreibe = $kinaestetisch = 0;
        $msg = "";
        foreach ($arr as $k => $v) {
            switch($v[0])
            {
                case "A":
                    $auditiv++;
                    break;
                case "V":
                    $visuell++;
                    break;
                case "R":
                    $leseundschreibe++;
                    break;
                case "K":
                    $kinaestetisch++;
                    break;
            }
            $this->LerntypRepository->insertUserAnswer($this->LerntypRepository->getFrageByAntworttext($v), $_SESSION["uid"], $res_id);
            $i++;
        }
        $most = max($auditiv, $visuell, $leseundschreibe, $kinaestetisch);
        if ($auditiv == $most)
        {
            $msg = "Sie sind ein auditiver Typ!";
        }
        else if ($visuell == $most)
        {
            $msg = "Sie sind ein visueller Typ!";
        }
        else if ($kinaestetisch == $most)
        {
            $msg = "Sie sind ein kinästetischer Typ!";
        }
        else if ($leseundschreibe == $most)
        {
            $msg = "Sie sind ein lese und schreibe Typ!";
        }
        Utils::redirect("/evaluation?hide=1&msg=".urlencode($msg));
    }
}
