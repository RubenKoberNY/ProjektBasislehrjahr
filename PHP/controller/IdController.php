<?php


class IdController
{
    var $map = array(
        "Big-Five" => "thebigfive",
        "Risiko" => "risiko",
        "Liegestütze" => "liegestuetze",
        "Cooper" => "cooper",
        "Ayurveda" => "ayurveda",
        "Maximisierung" => "maximisierung",
        "Lerntyp" => "lerntyp",
        "self-leadership" => "selfleadership",
        "Work-Life" => "worklife",
        "Social Media Süchtig" => "socialmedia",
        "Bekanntheitstest" => "bekanntheitstest",
        "Einbürgerung" => "einbuergerung",
        "Wer wird Millionär" => "werwirdmillionaer");
    var $repository;

    function __construct()
    {
        $this->repository = new IdRepository();
    }

    function addRandomId($quiz_id)
    {
        addId($quiz_id, Utils::getNewValidId());
    }

    private function addId($quiz_id, $gamecode)
    {
        $sql = "INSERT INTO gameid(quiz_id, gamecode) VALUES (?, ?)";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bind_param("is", $quiz_id, $gamecode);
        return $stmt->execute();
    }

    function login($game_id)
    {
        $res = $this->repository->getQuizFromGameId($game_id);
        if ($res) {
            if (sizeof($res) == 0) {
                Utils::redirect("/login");
            } else {
                $_SESSION["uid"] = "gameid";
                Utils::redirect("/quiz/" . $this->map[$res[0]]);
            }
        } else {
            Utils::redirect("/login");
        }
    }
}