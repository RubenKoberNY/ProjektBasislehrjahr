//region Prototypes
HTMLElement.prototype.replaceHTML = function (search, replacement) {
    this.innerHTML = this.innerHTML.replace(search, replacement);
}
//endregion

//region Questions
function getAllQuestions(){
    //ToDo: get all questions
}
//endregion

//region Questions Test Object
var questions = [
    {
        question:"Angenommen, Sie können 20000 € anlegen: Welche Stragetie wählen Sie?",
        answers: [
            {
                "id": "ans1",
                "value": "Zu je 50% Wahrscheinlichkeit haben Sie nach 5 Jahren 20000 oder 22000"
            }, {
                "id": "ans2",
                "value": "Zu je 50% Wahrscheinlichkeit haben Sie nach 5 Jahren 19000 oder 23000"
            }, {
                "id": "ans3",
                "value": "Zu je 50% Wahrscheinlichkeit haben Sie nach 5 Jahren 18000 oder 24000"
            }, {
                "id": "ans4",
                "value": "Zu je 50% Wahrscheinlichkeit haben Sie nach 5 Jahren 12000 oder 30000"
            }
        ]
    }
];
//endregion


//region Rendering
var currentIndex = 0;

function renderCurrentQuestion() {
    let answers = questions[currentIndex].answers;
    document.getElementById("questionHeader").replaceHTML("%%question_no%%", currentIndex + 1);
    document.getElementById("questionHeader").replaceHTML("%%question%%", questions[currentIndex].question);
    for (let i = 0; i < answers.length; i++) {
        document.getElementById(answers[i].id).replaceHTML("%%" + answers[i].id + "%%", answers[i].value);
    }
}

renderCurrentQuestion();
//endregion