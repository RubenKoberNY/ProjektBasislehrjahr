<?php


class EinbuergerungController
{
    public function __construct()
    {
        $this->EinbuergerungRepository = new EinbuergerungRepository();
    }
    public function getAllQuestions() {
        $questionArray = $this->EinbuergerungRepository->getAllQuestionsFromEinbuergerung();
        return json_encode($questionArray);
    }
}
