<?php


class SocialmediaController
{
    public function __construct()
    {
        $this->SocialmediaRepository = new SocialmediaRepository();
    }

    public function getQuestionsAndAnswers()
    {
        $result = $this->SocialmediaRepository->getQuestionsAndAnswersForSocialMedia();
        for ($i = 0; $i < 16; $i++) {
            unset($result[$i]["richtigeantwort"]);
            if ($result[$i]["punktezahl"] == 0) unset($result[$i]);
        }
        $result = array_values($result);
        return json_encode($result);
    }

    public function save($arr)
    {
        if (!isset($_SESSION["uid"]))
            return false;

        $res_id = $this->SocialmediaRepository->insertResult($_SESSION["uid"], 20, null);
        $i = 67;
        $yes = 0;
        $total = count($_POST);
        foreach ($arr as $k => $v) {
            if ($v == "Ja") {
                $yes++;
            }
            $this->SocialmediaRepository->insertUserAnswer($i, $_SESSION["uid"], $res_id);
            $i++;
        }
        $antworttext = $this->SocialmediaRepository->getAnwortText($yes);
        $this->SocialmediaRepository->updateResultat($yes, $antworttext[0], $res_id);
        Utils::redirect("/evaluation?chart=pie&right=" . $yes . "&wrong=" . ($total - $yes) . "&rt=Ja&wt=Nein&msg=" . urlencode($antworttext[1]));
    }
}
