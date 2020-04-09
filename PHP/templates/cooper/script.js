/*let qna;

function loadQnA() {
    let xml = new XMLHttpRequest();
    xml.open("GET", "/api/cooper/get");
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            qna = JSON.parse(xml.responseText);
            noq = qna.length / 4;
            createQuestions();
        }
    };
    xml.send();
}*/