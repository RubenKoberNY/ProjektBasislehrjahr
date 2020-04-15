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
    if (currentIndex < questions.length) {
        let id = questions[currentIndex].answers[0].id_answer;
        let qid = questions[currentIndex].id_frage;
        result.push({qid: qid, id: id});
        sendIfEnded();
        renderNextQuestion();
    }
});
$("#answer2").click(function () {
    if (currentIndex < questions.length) {
        let id = questions[currentIndex].answers[1].id_answer;
        let qid = questions[currentIndex].id_frage;
        result.push({qid: qid, id: id});
        sendIfEnded();
        renderNextQuestion();
    }
});
$("#answer3").click(function () {
    if (currentIndex < questions.length) {
        let id = questions[currentIndex].answers[2].id_answer;
        let qid = questions[currentIndex].id_frage;
        result.push({qid: qid, id: id});
        sendIfEnded();
        renderNextQuestion();
    }
});
$("#answer4").click(function () {
    if (currentIndex < questions.length) {
        let id = questions[currentIndex].answers[3].id_answer;
        let qid = questions[currentIndex].id_frage;
        result.push({qid: qid, id: id});
        sendIfEnded();
        renderNextQuestion();
    }
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
        contentType: "application/json",
        data: JSON.stringify(result)
    }).done(function (res) {
        let resObj = JSON.parse(res);
        window.location = buildEvaluationURL("scattered", resObj[0], resObj[1], "Auswertung Risiko", "Risikobereitschaft", "Risikofähigkeit");
    });
}

//endregion

function buildEvaluationURL(chart, x, y, title, xlabel, ylabel) {
    return "/evaluation?chart=" + chart + "&datax=" + x + "&datay=" + y + "&title=" + encodeURI(title) + "&xlabel=" + encodeURI(xlabel) + "&ylabel=" + ylabel;
}

function renderCurrentQuestion() {
    let answers = questions[currentIndex].answers;
    document.getElementById("questionTitle").innerHTML = "Frage " + (currentIndex + 1);
    document.getElementById("questionText").innerHTML = questions[currentIndex].fragetext;
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