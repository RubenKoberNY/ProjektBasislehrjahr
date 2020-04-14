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
            $msg = "Ihr Lerntyp -> Auditiv. Was er an Erklärungen hört, klingt für ihn stimmig und nachvollziehbar. 
            Hörbüchern können auditive Lerntypen sehr gut folgen, selbst zu lesen bedeutet für sie jedoch oft eine echte Konzentrationsleistung.";
        }
        else if ($visuell == $most)
        {
            $msg = "Ihr Lerntyp -> Visuell. Bei mündlichen Erklärungen fällt es ihm schwerer, den Stoff zu verstehen und zu behalten. 
            Visuelle Lerntypen lesen meistens sehr gern, haben aber Probleme, bei einem Hörbuch den Faden nicht zu verlieren. 
            Visuelle Lerntypen erfreuen sich auch an Filmen ganz anders als zum Beispiel die Auditiven.";
        }
        else if ($kinaestetisch == $most)
        {
            $msg = "Ihr Lerntyp -> Kinästhetisch. Der kinästhetische Typ lebt vor allem in seinen Gefühlen. Daher atmet er tief im Bauch und seine Augen sind häufig nach unten gerichtet. 
            Er spricht langsam und mit einer tiefen Stimme. Insgesamt scheint er eher passiv zu sein, da seine Gefühle ihm weniger spontane Reaktionen erlauben.";
        }
        else if ($leseundschreibe == $most)
        {
            $msg = "Ihr Lerntyp -> Lesen und Schreiben.  Er/Sie lernt am besten durch das Lesen und Schreiben von Texten,  ist also auch ein visueller Lerntyp, da er Informationen durch das Sehen aufnimmt. 
            Jedoch liegt der Fokus hier auf Worten und Texten anstatt auf Grafiken wie beim Visuellen. Das zusätzliche Aufschreiben hilft den Stoff zu behalten und zu verstehen.";
        }
        Utils::redirect("/evaluation?hide=1&msg=".urlencode($msg));
    }
}
