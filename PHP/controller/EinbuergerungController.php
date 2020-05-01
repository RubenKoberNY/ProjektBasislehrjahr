<?php


class EinbuergerungController
{
    public function __construct()
    {
        $this->EinbuergerungRepository = new EinbuergerungRepository();
    }

    public function getQuestionsAndAnswers()
    {
        $questionArray = $this->EinbuergerungRepository->getAllQuestionsFromEinbuergerung();
        return json_encode($questionArray);
    }

    public function save($arr)
    {
        $correctAnswers = $this->EinbuergerungRepository->getCorrectAnswers();
        $res_id = $this->EinbuergerungRepository->insertResult($_SESSION["uid"], 22, null);
        $i = 0;
        $correct = 0;
        foreach ($arr as $k => $v) {
            $useranswer_id = $v;

            if ($useranswer_id + 166 == $correctAnswers[$i]["id_antwort"]) $correct++;
            $this->EinbuergerungRepository->insertUserAnswer($useranswer_id, $_SESSION["uid"], $res_id);
            $i++;
        }
        $msg = $this->EinbuergerungRepository->getAnwortText($correct);
        $this->EinbuergerungRepository->updateResultat($correct, $msg[0], $res_id);
        Utils::redirect("/evaluation?chart=pie&right=" . $correct . "&wrong=" . (count($correctAnswers) - $correct)."&msg=".urlencode($msg[1]));
    }
}
