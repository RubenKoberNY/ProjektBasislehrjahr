<?php


class TheBigFiveController
{
    public function __construct()
    {
        $this->bigFiveRepository = new TheBigFiveRepository();
    }
    public function getAllQuestions() {
        $questionArray = $this->bigFiveRepository->getAllQuestionsFromBigFive();
        return json_encode($questionArray);
    }
    public function save($array) {
        $idController = new IdController();
        $idController->addRandomId(2);
        if (!isset($_SESSION["uid"])) {
            return false;
        }

        $result_id = $this->bigFiveRepository->createResult($_SESSION["uid"], 2, null);

        foreach ($array as $item) {
            $this->bigFiveRepository->insertUserResult($item, $_SESSION["uid"], $result_id);
        }

    }
}
