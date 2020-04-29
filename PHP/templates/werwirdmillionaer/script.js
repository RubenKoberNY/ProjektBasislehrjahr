let qna;
let questionnr = document.getElementById("questionnr");
let question = document.getElementById("question");
let pos1 = document.getElementById("pos1");
let pos2 = document.getElementById("pos2");
let pos3 = document.getElementById("pos3");
let pos4 = document.getElementById("pos4");
let progress = document.getElementById("progress");
let noq;
let soq = 0;
let currentQuestionId;
let answers = {};

function loadQnA() {
    let xml = new XMLHttpRequest();
    xml.open("GET", "%BASE_URL%api/werwirdmillionaer/get");
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            qna = JSON.parse(xml.responseText);
            noq = qna.length / 4;
            for (let row of qna) {
                row["solved"] = false;
            }
            renderQuestion();
        }
    };
    xml.send();
}

function renderQuestion() {
    if (soq < noq) {
        let qid = getUnsolvedQuestion();
        if (qid) {
            let questions = getQuestionsByQuestionId(qid);
            soq += 1;
            currentQuestionId = questions[0]["id_frage"];
            questionnr.innerText = "Frage " + soq;
            progress.style.width = 100 / noq * soq + "%";
            question.innerText = questions[0]["fragetext"];
            pos1.innerText = questions[0]["antwortmöglichkeiten"];
            pos2.innerText = questions[1]["antwortmöglichkeiten"];
            pos3.innerText = questions[2]["antwortmöglichkeiten"];
            pos4.innerText = questions[3]["antwortmöglichkeiten"];
            pos1.onclick = () => {
                choose(questions[0]["id_antwort"])
            };
            pos2.onclick = () => {
                choose(questions[1]["id_antwort"])
            };
            pos3.onclick = () => {
                choose(questions[2]["id_antwort"])
            };
            pos4.onclick = () => {
                choose(questions[3]["id_antwort"])
            };
        }
    }
}


function getUnsolvedQuestion() {
    for (let row of qna) {
        if (!row["solved"]) {
            return row["id_frage"];
        }
    }
    return false;
}

function getQuestionsByQuestionId(id) {
    let questions = [];
    for (let row of qna) {
        if (row["id_frage"] == id) {
            row["solved"] = true;
            questions.push(row);
        }
    }
    return questions;
}

function choose(aid) {
    answers[currentQuestionId] = aid;
    if (soq < noq) {
        renderQuestion();
    } else {
        sendQuestions();
    }
}

function sendQuestions() {
    $.ajax({
        url: "%BASE_URL%api/werwirdmillionaer/post",
        method: "POST",
        contentType: "application/json",
        data: JSON.stringify(answers)
    }).done(function (res) {
        let result = res.split("/");
        window.location = "%BASE_URL%evaluation?right=" + result[0] + "&wrong=" + result[1] + "&chart=pie";
    });
}

loadQnA();
