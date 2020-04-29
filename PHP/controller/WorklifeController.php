<?php


class WorklifeController
{
    public function __construct()
    {
        $this->WorklifeRepository = new WorklifeRepository();
    }

    public function getQuestionsAndAnswers()
    {
        $questionArray = $this->WorklifeRepository->getAllQuestionsFromWorklife();
        return json_encode($questionArray);
    }

    public function save($arr)
    {
        $idController = new IdController();
        $idController->addRandomId(19);
        if (!isset($_SESSION["uid"]))
            return false;

        $res_id = $this->WorklifeRepository->insertResult($_SESSION["uid"], 19, null);
        $yes = 0;
        $total = count($_POST);
        foreach ($arr as $k => $v) {
            if ($v == "0") {
                $yes++;
            }
            // $this->WorklifeRepository->insertUserAnswer($i, $_SESSION["uid"], $res_id);
        }
        $msg="";
        if ($yes > 3){
            $msg="Sie haben ".$yes." Fragen mit Ja beantwortet. Sie sollten eine Beratung in Erwägung ziehen. *Ja mehr als 3 mal";
        }else{
            $msg="Bei Ihnen ist alles in ordnung *Ja weniger als 3 mal";
        }
        Utils::redirect("/evaluation?hide=1&msg=".urlencode($msg)."&chart=pie&right=".(10-$yes)."&wrong=".$yes);
    }
}
