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
        handleClick(id, qid);
    }
});
$("#answer2").click(function () {
    if (currentIndex < questions.length) {
        let id = questions[currentIndex].answers[1].id_answer;
        let qid = questions[currentIndex].id_frage;
        handleClick(id, qid);
    }
});
$("#answer3").click(function () {
    if (currentIndex < questions.length) {
        let id = questions[currentIndex].answers[2].id_answer;
        let qid = questions[currentIndex].id_frage;
        handleClick(id, qid);
    }
});
$("#answer4").click(function () {
    if (currentIndex < questions.length) {
        let id = questions[currentIndex].answers[3].id_answer;
        let qid = questions[currentIndex].id_frage;
        handleClick(id, qid);
    }
});

function handleClick(id, qid) {
    result.push({qid: qid, id: id});
    sendIfEnded();
    renderNextQuestion();
}

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
    return URLBuilder.buildURL("/evaluation", {
        chart: chart,
        datax: x,
        datay: y,
        title: encodeURI(title),
        xlabel: encodeURI(xlabel),
        ylabel: encodeURI(ylabel),
        xmax: 9,
        ymax: 9
    });
}

const URLBuilder = {
    buildURL: function (url, dict) {
        let out = url;
        Object.entries(dict).forEach((value, index) => {
            out += this.getNextURLParam(value[0], value[1], index);
        });
        return out;

    },
    getNextURLParam: function (key, value, count) {
        if (count == 0)
            return "?" + key + "=" + value;
        else
            return "&" + key + "=" + value;
    }
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