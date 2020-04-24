var questions;
let amountOfQuestions;
var currentQuestion = 0;
var givenAnswer = {};

var databaseValues = [];
var processedValues = [];

$(document).ready(function () {
    //initialize the range-slider on the page
    var array_of_dom_elements = document.querySelectorAll("input[type=range]");
    M.Range.init(array_of_dom_elements);

    //fetch all questions from database
    $.ajax({
        url: "%BASE_URL%api/thebigfive/get",
        method: "GET"
    }).done(function (result) {
        questions = JSON.parse(result);
        amountOfQuestions = questions.length;
        loadQuestion();
    });

});

// this function gets called as soon as the user presses the "Next" button
// it's also called once the page loads in order to get the first question
function loadQuestion() {
    //disable the submit button until the next question is loaded
    //this prevents the creation of empty values in the array, which could happen if the button is pressed too fast
    //and before the question is even loaded (so therefore, null)
    $("#submitBtn").prop('disabled', true);
    //check if there are any questions left
    if (currentQuestion < amountOfQuestions) {
        //when requested, the current question keywords will fade out
        $("#question").fadeOut('fast', function () {
            //while faded out, the next question is set
            $("#question").text(questions[currentQuestion].fragetext);
            //increase the current question counter
            currentQuestion++;
            //set the question count to the current question.
            // since we start counting from 0, we always increase the currentQuestion variable, so that it makes sense.
            $("#questionCount").text(currentQuestion)
            //fade in the new question
            $("#question").fadeIn('slow');
            //since the question is now loaded and only fading in, enable the button again
            $("#submitBtn").prop('disabled', false);
        });
    } else {
        //redirect to page
        prepareAnswers();
        $.ajax({
            type: "POST",
            url: "%BASE_URL%api/thebigfive/post",
            content: "application/json",
            data: JSON.stringify(databaseValues),
        }).done(function (result) {
            window.location = "%BASE_URL%evaluation?chart=radar&data=" + processedValues[0] + "," + processedValues[1] + "," + processedValues[2] + "," + processedValues[3] + "," + processedValues[4];
    });
    }
}

function saveAnswer() {
    // get the value of what the user selected in the slider
    let inputValue = $("#slider").val();
    //create new entry in dictionary, set the key as the current question count
    //set the associated value of the key to the given value of the slider
    givenAnswer[currentQuestion] = parseInt(inputValue);
    console.log(givenAnswer); //debugging
    //when the entry is saved, generate the next question
    loadQuestion();
}

//this function reverses the answers the user gave us for question 2, 4, 6, 8 and 10
//means, value 1 becomes value 7, 2 becomes 6 etc.
//reference -> book PDF
function prepareAnswers() {
    // go through every entry in the dictionary
    var result = 0;
    for (var key in givenAnswer) {
        // if the key is odd, skip it
        if (key % 2 == 1) {
            result += givenAnswer[key];
            continue;
        }
        //if the key is not odd, reverse the int accordingly
        givenAnswer[key] = reverseInt(givenAnswer[key]);
        result += givenAnswer[key];
    }
    console.log("Result full: " + result);
    result /= 2;
    console.log("Result processed: " + result);

    for (var j = 0; j < 5; j++) {
        processedValues[j] = (givenAnswer[j+1] + givenAnswer[j + 6]) / 2;
        if (processedValues[j].length != 1) {
            databaseValues[j] = processedValues[j].toString().replace(".", "");
        }
    }
    console.log(databaseValues);
}

function reverseInt(value) {
    return (8 - value);
}
