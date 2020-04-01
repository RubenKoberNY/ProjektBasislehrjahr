<?php


class IdController
{
    var $repository;
    function __construct()
    {
        $this->repository = new IdRepository();
    }

    function login($game_id){
        $res = $this->repository->getQuizFromGameId($game_id);
        if($res){
            if(sizeof($res)==0){
                Utils::redirect("/login");
            }else{
                echo $res[0];
            }
        }else{
            Utils::redirect("/login");
        }
    }
}