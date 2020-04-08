// Get the modal
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Get message
var modal_message = document.getElementById("modal_message");

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
//==========================================================================

var questions = ["frage1", "frage2", "frage3", "frage4", "frage5", "frage6"];

// check if an all answers were selected
function CheckIfAnswersSelectedAndGetValues() {
    var q = 0;
    answers = [];

    for (; q < questions.length;) {
        var values = document.getElementsByName(questions[q]);
        var answered = false;

        for (var v of values) {
            if (v.checked) {
                answers += v.value;
                answered = true;
            }
        }

        if (! answered) {
            modal_message.innerHTML = "Frage " + (q + 1 ) + " nicht beantwortet";
            modal.style.display = "block";

            return [];
        }

        q++;
    }

    return answers;
}

function meanValue() {
    var values = CheckIfAnswersSelectedAndGetValues();
    var i = 0;
    var sum = 0;

    for (; i < values.length;)   {
        // console.log("values[" + i + "] = " + values[i]);
        sum += parseInt(values[i]); i++;
    }

    // console.log("sum = " + sum);
    // console.log("length = " + values.length);

    var meanvalue = Math.round(sum / values.length);

    console.log("mean value = " + meanvalue);
}
//==========================================================================

function getValueFromSelectedRadioButtonFromQuestionOne()
{
    var questionOne = document.getElementsByName("frage1");
    for (var radioButtonQuestionOne of questionOne)
    {
        if (radioButtonQuestionOne.checked)
        {
            return(radioButtonQuestionOne.value);
        } else {

        }

    }
}

function getValueFromSelectedRadioButtonFromQuestionTwo() {
    var questionTwo = document.getElementsByName("frage2");
    for (var radioButtonQuestionTwo of questionTwo) {
        if (radioButtonQuestionTwo.checked) {
            return (radioButtonQuestionTwo.value);
        } else {

        }
    }
}

function getValueFromSelectedRadioButtonFromQuestionThree()
{
    var questionThree = document.getElementsByName("frage3");
    for (var radioButtonQuestionThree of questionThree)
    {
        if (radioButtonQuestionThree.checked)
        {
            return(radioButtonQuestionThree.value);
        } else {

        }
    }
}

function getValueFromSelectedRadioButtonFromQuestionFour()
{
    var questionFour = document.getElementsByName("frage4");
    for (var radioButtonQuestionFour of questionFour)
    {
        if (radioButtonQuestionFour.checked)
        {
            return(radioButtonQuestionFour.value);
        } else {

        }
    }
}

function getValueFromSelectedRadioButtonFromQuestionFive()
{
    var questionFive = document.getElementsByName("frage5");
    for (var radioButtonQuestionFive of questionFive)
    {
        if (radioButtonQuestionFive.checked)
        {
            return(radioButtonQuestionFive.value);
        } else {

        }
    }
}

function getValueFromSelectedRadioButtonFromQuestionSix()
{
    var questionSix = document.getElementsByName("frage6");
    for (var radioButtonQuestionSix of questionSix)
    {
        if (radioButtonQuestionSix.checked)
        {
            return(radioButtonQuestionSix.value);
        } else {

        }
    }
}


function createDictionary()
{
    let dict = {};
    for (let i = 1; i < 5; i++) {
        let rv = 0;
        for (let radioButton of document.getElementsByName("frage"+i)) {
            if (radioButton.checked) rv = radioButton.value;
        }
        dict[81+i] = rv
    }
    return dict;
}

function sendQuestions() {
    if (CheckIfAnswersSelectedAndGetValues().length) {
        $.ajax({
            url: "/api/maximisierung/post",
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify(createDictionary())
        }).done(function (res) {
            window.location = "/evaluation?hide=1&msg=" + res;
        });
    }
}

/*TODO
*  Value INSERT INTO DB*/