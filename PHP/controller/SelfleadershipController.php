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

        $correctAnswers = $this->SelfleadershipRepository->getCorrectAnswers();
        $res_id = $this->SelfleadershipRepository->insertResult($_SESSION["uid"], 17, null);
        $i = 0;
        $correct = 0;
        foreach ($arr as $k => $v) {
            $useranswer_id = $v;

            if ($useranswer_id + 166 == $correctAnswers[$i]["id_antwort"]) $correct++;
            $this->SelfleadershipRepository->insertUserAnswer($useranswer_id, $_SESSION["uid"], $res_id);
            $i++;
        }
        $msg = $this->SelfleadershipRepository->getAnwortText($correct);
        $this->SelfleadershipRepository->updateResultat($correct, $msg[0], $res_id);
        Utils::redirect("/evaluation?chart=pie&right=" . $correct . "&wrong=" . (count($correctAnswers) - $correct)."&msg=".urlencode($msg[1]));
    }
}
