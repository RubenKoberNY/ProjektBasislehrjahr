// Get the modal
var modal = document.getElementById("modal_error");

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

//==============================================================================================

// Array with the
var questions = ["question1", "question2", "question3", "question4", "question5", "question6"];

// check if an all answers were selected
function CheckIfAnswersSelectedAndGetValues() {
    var q = 0;
    answers = [];

    // get radio buttons by name
    for (; q < questions.length;) {
        var values = document.getElementsByName(questions[q]);
        var answered = false;

        // check if an radio button is checked
        for (var v of values) {
            if (v.checked) {
                answers += v.value;
                answered = true;
            }
        }

        // if an radio button is not checked -> Display the error modal
        if (! answered) {
            modal_message.innerHTML = "Frage " + (q + 1 ) + " nicht beantwortet";
            modal.style.display = "block";

            // Return nothing because an radio button was not checked
            return [];
        }

        q++;
    }

    // return the values from all the checked radio buttons
    return answers;
}

// Old function DO NOT USE ANYMORE
/*function meanValue() {
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
}*/

//===============================================================================================


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