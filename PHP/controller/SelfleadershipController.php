<?php


class SelfleadershipController
{
    private $selfleadershipRepository;

    public function __construct()
    {
        $this->selfleadershipRepository = new SelfleadershipRepository();
    }

    public function getQuestionsAndAnswers()
    {
        $result = $this->selfleadershipRepository->getQuestionsAndAnswers();
        echo json_encode($result);
    }

    public function save($arr)
    {
        $points = array_sum($arr);
        $msg = 'Deine Gesamtpunktzahl beträgt ' . $points . ' Punkte. ';
        if ($points < 19) {
            $msg = $msg . "Raum für Verbesserungen. Geh im Kopf Situationen durch, in denen du deine Ziele nicht erfülltest. Woran lag es? Welche Rolle spielte fehlende Selbstführung.";
        } else if ($points >= 19 && $points <= 36) {
            $msg = $msg . "Mittlere Selbstführungsfähigkeiten. Lies noch einmal die Selbstführungsstrategien. Frag dich: Wie kann ich mich in diesen Punkten verbessern?";
        } else if ($points > 36) {
            $msg = $msg . "Sehr starke Selbstführungsfähigkeiten. Du bist in der Lage, dein Verhalten und deine Gedanken positiv zu lenken.";
        }
        Utils::redirect("/evaluation?hide=1&msg=" . urlencode($msg));
    }
}
