var questions;
var result = [];

var currentIndex = 0;

$("#answer1").click(function () {
    result.push(0);
    sendIfEnded();
});
$("#answer2").click(function () {
    result.push(1);
    sendIfEnded();
});
$("#answer3").click(function () {
    result.push(2);
    sendIfEnded();
});
$("#answer4").click(function () {
    result.push(3);
    sendIfEnded();
});
//region Prototypes
HTMLElement.prototype.replaceHTML = function (search, replacement) {
    this.innerHTML = this.innerHTML.replace(search, replacement);
}
//endregion

//getAllQuestions();
questions = [{
    question: "Angenommen, Sie können 20000 € anlegen: Welche Stragetie wählen Sie?",
    answers: [{
        "id": "ans1",
        "value": "Zu je 50% Wahrscheinlichkeit haben Sie nach 5 Jahren 20000 oder 22000"
    }, {"id": "ans2", "value": "Zu je 50% Wahrscheinlichkeit haben Sie nach 5 Jahren 19000 oder 23000"}, {
        "id": "ans3",
        "value": "Zu je 50% Wahrscheinlichkeit haben Sie nach 5 Jahren 18000 oder 24000"
    }, {"id": "ans4", "value": "Zu je 50% Wahrscheinlichkeit haben Sie nach 5 Jahren 12000 oder 30000"}]
}];
renderCurrentQuestion();

//region Questions
function getAllQuestions() {
    $.ajax({
        url: "/api/quiz/risiko/get",
        method: "GET"
    }).done(function (result) {
        questions = JSON.parse(result);
    });
}

function sendQuestions() {
    $.ajax({
        url: "/api/quiz/risiko/post",
        method: "POST",
        data: result
    }).done(function (result) {
        console.log(result);
    });
    //ToDo: redirect to result
}

//endregion

function renderCurrentQuestion() {
    let answers = questions[currentIndex].answers;
    document.getElementById("questionHeader").replaceHTML("%%question_no%%", currentIndex + 1);
    document.getElementById("questionHeader").replaceHTML("%%question%%", questions[currentIndex].question);
    for (let i = 0; i < answers.length; i++) {
        document.getElementById(answers[i].id).replaceHTML("%%" + answers[i].id + "%%", answers[i].value);
    }
}


function sendIfEnded() {
    if (result.length = questions.length) {
        sendQuestions();
    }
}