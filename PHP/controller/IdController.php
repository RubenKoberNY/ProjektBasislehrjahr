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

    function login($game_id)
    {
        $res = $this->repository->getQuizFromGameId($game_id);
        if ($res) {
            if (sizeof($res) == 0) {
                Utils::redirect("/login");
            }else {
                $_SESSION["uid"] = "gameid";
                Utils::redirect("/quiz/" . $this->map[$res[0]]);
            }
        }else{
            Utils::redirect("/login");
        }
    }
}