<?php


class BekanntheitController
{
    public function __construct()
    {

    }
    public function save($arr)
    {

        $correctAnswers = $this->BekanntheitRepository->getCorrectAnswers();
        $res_id = $this->BekanntheitRepository->insertResult($_SESSION["uid"], 21, null);
        $i = 0;
        $correct = 0;
        foreach ($arr as $k => $v) {
            $useranswer_id = $v;

            if ($useranswer_id + 166 == $correctAnswers[$i]["id_antwort"]) $correct++;
            $this->BekanntheitRepository->insertUserAnswer($useranswer_id, $_SESSION["uid"], $res_id);
            $i++;
        }
        $msg = $this->BekanntheitRepository->getAnwortText($correct);
        $this->BekanntheitRepository->updateResultat($correct, $msg[0], $res_id);
        Utils::redirect("/evaluation?chart=pie&right=" . $correct . "&wrong=" . (count($correctAnswers) - $correct)."&msg=".urlencode($msg[1]));
    }
}
