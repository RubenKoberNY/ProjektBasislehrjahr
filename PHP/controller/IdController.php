<?php


class IdController
{

    var $repository;

    function __construct()
    {
        $this->repository = new IdRepository();
    }

    function addRandomId($quiz_id)
    {
        $this->addId($quiz_id, Utils::getNewValidId());
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
        if ($res != false) {
            if (sizeof($res) == 0) {
                Utils::redirect("/login");
            } else {
                $_SESSION["uid"] = "gameid";
                Utils::redirect("/quiz/" . Utils::$map[$res[0]]);
            }
        } else {
            Utils::redirect("/login");
        }
    }
}