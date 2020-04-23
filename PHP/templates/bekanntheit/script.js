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

var questions;
var result = [];

var currentIndex = 0;

getAllQuestions();

function getAllQuestions() {
    $.ajax({
        url: "/api/bekanntheit/get",
        method: "GET"
    }).done(function (result) {
        questions = JSON.parse(result);
        renderCurrentQuestion();
    });
}

function renderCurrentQuestion() {
    if (currentIndex < questions.length)
        document.getElementById("questionText").innerHTML = questions[currentIndex].fragetext;
}

const texts = ["Kenne ich sicher nicht", "Kenne ich vielleicht", "Kenne ich sicher"];
$("#answer1").click(() => {
    saveResult(texts[0]);
});
$("#answer2").click(() => {
    saveResult(texts[1]);
});
$("#answer3").click(() => {
    saveResult(texts[2]);
});

function saveResult(text) {
    if (currentIndex < questions.length) {
        result.push({text: text, id: questions[currentIndex].id_frage});
        currentIndex++;
        renderCurrentQuestion();
    }
    sendIfEnded();
}

function sendIfEnded() {
    if (currentIndex == questions.length) {
        currentIndex++;
        $.ajax({
            url: "/api/bekanntheit/post",
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify(result)
        }).done(function (res) {
            let resObj = JSON.parse(res);
            window.location = URLBuilder.buildURL("/evaluation", {
                msg: "Der folgende Wert ist die Summe aller Personen, " +
                    "welche Sie mit \"Kenne ich vielleicht\" oder \"Kenne ich sicher\" bewertet haben, " +
                    "die jedoch nicht existieren: " + resObj["score"]
            });
        });
    }
}