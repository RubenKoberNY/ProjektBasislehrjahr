var questions;
var result = [];

var currentIndex = 0;

function renderNextQuestion() {
    currentIndex++;
    if (currentIndex < questions.length) {
        renderCurrentQuestion();
    }
}
$("#answer1").click(function () {
    let id = questions[currentIndex].answers[0].id_answer;
    result.push(id);
    sendIfEnded();
    renderNextQuestion();
});
$("#answer2").click(function () {
    let id = questions[currentIndex].answers[1].id_answer;
    result.push(id);
    sendIfEnded();
    renderNextQuestion();
});
$("#answer3").click(function () {
    let id = questions[currentIndex].answers[2].id_answer;
    result.push(id);
    sendIfEnded();
    renderNextQuestion();
});
$("#answer4").click(function () {
    let id = questions[currentIndex].answers[3].id_answer;
    result.push(id);
    sendIfEnded();
    renderNextQuestion();
});
//region Prototypes
HTMLElement.prototype.replaceHTML = function (search, replacement) {
    this.innerHTML = this.innerHTML.replace(search, replacement);
}
//endregion

//getAllQuestions();
getAllQuestions();

//region Questions
function getAllQuestions() {
    $.ajax({
        url: "/api/risiko/get",
        method: "GET"
    }).done(function (result) {
        questions = JSON.parse(result);
        renderCurrentQuestion();
    });
}

function sendQuestions() {
    $.ajax({
        url: "/api/risiko/post",
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
    document.getElementById("questionTitle").innerHTML = "Frage " + (currentIndex + 1);
    document.getElementById("questionText").innerHTML = questions[currentIndex].question;
    for (let i = 0; i < answers.length; i++) {
        document.getElementById("ans" + (i + 1)).innerText = answers[i].value;
    }
}


function sendIfEnded() {
    console.log("Result Length " + result.length);
    console.log("Questions Length " + questions.length);
    if (result.length >= questions.length) {
        sendQuestions();
    }
}