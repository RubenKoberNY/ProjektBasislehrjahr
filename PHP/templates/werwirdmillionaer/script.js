let xml = new XMLHttpRequest();
let qna;
function loadQnA() {
    xml.open("GET", "/api/werwirdmillionaer/get");
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            qna = JSON.parse(xml.responseText);
            for(let row of qna){
                row["solved"] = false;
            }
            renderQuestion();
        }
    };
    xml.send();
}

function renderQuestion(){
    for(let row of qna){
        let qid = getUnsolvedQuestion();
        if(qid){
            let questions = getQuestionsByQuestionId(qid);
        }else{

        }
    }
}

function getUnsolvedQuestion(){
    for(let row of qna){
        if(!row["solved"]){
            return row["frage_id"];
        }

    }
    return false;
}

function getQuestionsByQuestionId(id){
    let questions = [];
    for(let row of qna){
        if(row["frage_id"] == id){
            questions.push(row);
        }
    }
    return questions;
}

loadQnA();
