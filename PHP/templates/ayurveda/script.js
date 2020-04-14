let qna;
let quiz = document.getElementById("quiz");


function loadQnA() {
    let xml = new XMLHttpRequest();
    xml.open("GET", "/api/ayurveda/get");
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            qna = JSON.parse(xml.responseText);
            createQuestions();
        }
    };
    xml.send();
}


function createQuestions() {
    for (let i = 0; i < qna.length; i += 3) {
        let question = document.createElement("div");
        let heading = document.createElement("h4");
        heading.innerText = qna[i]["fragetext"];
        question.appendChild(heading);
        for (let a = 0; a < 3; a++) {
            let possibility = document.createElement("label");
            let radio = document.createElement("input");
            let span = document.createElement("span");
            let br = document.createElement("br");
            if (a == 0) radio.checked = "checked";
            radio.value = qna[a + i]["antwortmöglichkeiten"];
            radio.name = "radio" + i;
            radio.classList.add("with-gap");
            span.innerText = qna[a + i]["antwortmöglichkeiten"];
            radio.type = "radio";
            possibility.appendChild(radio);
            possibility.appendChild(span);
            possibility.appendChild(br);
            question.appendChild(possibility);
        }
        quiz.appendChild(question);
    }
    let input = document.createElement("input");
    let br = document.createElement("br");
    input.type = "submit";
    input.value = "Auswertung";
    input.classList.add("btn");
    quiz.appendChild(br);
    quiz.appendChild(input);
}

loadQnA();