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

    /*   Überprüft, wie viele Antworten von welchem Typ ausgewählt wurden und gibt den ensprechenden Text zurück   */
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

        /* Auditiver Typ */
        if ($auditiv == $most)
        {
            $msg = "Sie lernen durch Zuhören. Stellen Sie Fragen. Diskutieren Sie mit anderen die Themen, die Sie sich merken müssen,
        oder tragen Sie Ihr Thema wie ein Mini-Referat laut vor.";
        }

        /* Visueller Typ */
        else if ($visuell == $most)
        {
            $msg = "Sie lernen durch Beobachtungen. Benutzen Sie Diagramme und Modelle, um Ihre Ideen zu visualisieren.
        Ersetzen Sie Schlüsselwörter durch Symbole. Benutzen Sie Farbmarker.";
        }

        /* Kinästetischer Typ */
        else if ($kinaestetisch == $most)
        {
            $msg = "Sie lernen durch Ausprobieren.
        Benutzen Sie Beispiele, um Ihre Konzepte zu erklären.
        Versuchen Sie, sich nicht an Fakten zu erinnern, sondern an Erlebnisse.";
        }

        /* Lese und Schreibe Typ */
        else if ($leseundschreibe == $most)
        {
            $msg = "Sie lernen durch Texte. Sie schaffen Klarheit im Denken, indem Sie schreiben.
        Erweitern Sie Ihre Notizen beim Abschreiben. Formulieren Sie wichtige Stellen neu.";
        }
        Utils::redirect("/evaluation?hide=1&msg=".urlencode($msg));
    }
}
