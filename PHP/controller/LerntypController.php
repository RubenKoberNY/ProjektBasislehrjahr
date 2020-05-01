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
        $vi = $au = $le = $ki = 0;
        $msg = "";
        foreach ($arr as $k => $v) {
            switch ($v[0]) {
                case "A":
                    $au++;
                    $most = max($au || $vi || $le || $ki);
                    if ($au == 3) {
                        $msg = "Sie sind zu 100% ein auditiver Lerntyp!.
                        Sie lernen durch Zuhören. Stellen Sie Fragen. Diskutieren Sie mit anderen die Themen, die Sie sich merken müssen,
                        oder tragen Sie Ihr Thema wie ein Mini-Referat laut vor.";
                    }
                    break;
                case "V":
                    $vi++;
                    if ($vi == 3) {
                        $msg = "Sie sind zu 100% ein visueller Lerntyp!.
                        Sie lernen durch Beobachtungen. Benutzen Sie Diagramme und Modelle, um Ihre Ideen zu visualisieren.
                        Ersetzen Sie Schlüsselwörter durch Symbole. Benutzen Sie Farbmarker.";
                    }
                case "R":
                    $le++;
                    if ($le == 3) {
                        $msg = "Sie sind zu 100% ein lese und schreibe Lerntyp!.
                        Sie lernen durch Texte. Sie schaffen Klarheit im Denken, indem Sie schreiben.
                        Erweitern Sie Ihre Notizen beim Abschreiben. Formulieren Sie wichtige Stellen neu.";
                    }
                    break;
                case "K":
                    $ki++;
                    if ($ki == 3) {
                        $msg = "Sie sind zu 100% ein kinästhetischer Lerntyp!.
                        Sie lernen durch Ausprobieren.
                        Benutzen Sie Beispiele, um Ihre Konzepte zu erklären.
                        Versuchen Sie, sich nicht an Fakten zu erinnern, sondern an Erlebnisse.";
                    }
                    break;
            }
            if ($most = 2) {
                $msg = "Hallo, 66%";
            } else if ($most == 1)
            {
                $msg = "Hallo, 33%";
            }


            $this->LerntypRepository->insertUserAnswer($this->LerntypRepository->getFrageByAntworttext($v), $_SESSION["uid"], $res_id);
            $i++;
        }
        Utils::redirect("/evaluation?hide=1&msg=".urlencode($msg));
    }
}
