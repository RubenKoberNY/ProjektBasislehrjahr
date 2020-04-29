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
        $idController = new IdController();
        $idController->addRandomId(16);
        $correctAnswers = $this->LerntypRepository->getCorrectAnswers();
        $res_id = $this->LerntypRepository->insertResult($_SESSION["uid"], 16, null);
        $i = 0;
        $au = $vi = $le = $ki = 0;
        $msg = "";
        foreach ($arr as $k => $v) {
            switch ($v[0]) {
                case "A":
                    $au++;
                    break;
                case "V":
                    $vi++;
                case "R":
                    $le++;
                    break;
                case "K":
                    $ki++;
                    break;
            }
            $this->LerntypRepository->insertUserAnswer($this->LerntypRepository->getFrageByAntworttext($v), $_SESSION["uid"], $res_id);
            $i++;
        }
        $most = max($au, $vi, $le, $ki);

        /* Auditiver Typ
             66%       */
        if ($au == $most)
        {
            $msg = "Sie sind zu 66% ein auditiver Lerntyp!.
            Sie lernen durch Zuhören. Stellen Sie Fragen. Diskutieren Sie mit anderen die Themen, die Sie sich merken müssen,
            oder tragen Sie Ihr Thema wie ein Mini-Referat laut vor.";
        }

        /* Visueller Typ
              66%     */
        else if ($vi == $most)
        {
            $msg = "Sie sind zu 66% ein visueller Lerntyp!.
            Sie lernen durch Beobachtungen. Benutzen Sie Diagramme und Modelle, um Ihre Ideen zu visualisieren.
            Ersetzen Sie Schlüsselwörter durch Symbole. Benutzen Sie Farbmarker.";
        }
        /* Kinästetischer Typ
             66%       */
        else if ($ki == $most)
        {
            $msg = "Sie sind zu 66% ein kinästhetischer Lerntyp!.
            Sie lernen durch Ausprobieren.
            Benutzen Sie Beispiele, um Ihre Konzepte zu erklären.
            Versuchen Sie, sich nicht an Fakten zu erinnern, sondern an Erlebnisse.";
        }
        /* Lese und Schreibe Typ
                 66%     */
        else if ($le == $most)
        {
            $msg = "Sie sind zu 66% ein lese und schreibe Lerntyp!.
            Sie lernen durch Texte. Sie schaffen Klarheit im Denken, indem Sie schreiben.
            Erweitern Sie Ihre Notizen beim Abschreiben. Formulieren Sie wichtige Stellen neu.";
        }
        Utils::redirect("/evaluation?hide=1&msg=".urlencode($msg));
    }
}
