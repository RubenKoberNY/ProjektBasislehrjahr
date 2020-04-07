var questions;
let amountOfQuestions;
var currentQuestion = 0;
var givenAnswers = new Object();

$( document ).ready(function() {
    //initialize the range-slider on the page
    var array_of_dom_elements = document.querySelectorAll("input[type=range]");
    M.Range.init(array_of_dom_elements);

    //fetch all questions from database
    $.ajax({
        url: "/api/thebigfive/get",
        method: "GET"
    }).done(function (result) {
        questions = JSON.parse(result);
        amountOfQuestions = questions.length;
        console.log(questions);
        loadQuestion();
    });

});

// this function gets called as soon as the user presses the "Next" button
// it's also called once the page loads in order to get the first question
function loadQuestion(){
    //check if there are any questions left
    if(currentQuestion < amountOfQuestions) {
        //when requested, the current question keywords will fade out
        $("#question").fadeOut('fast', function() {
            //while faded out, the next question is set
            $("#question").text(questions[currentQuestion].fragetext);
            //increase the current question counter
            currentQuestion++;
            //set the question count to the current question.
            // since we start counting from 0, we always increase the currentQuestion variable, so that it makes sense.
            $("#questionCount").text(currentQuestion)
            //fade in the new question
            $("#question").fadeIn('slow');
        });
    } else {
        //redirect to page
        console.log("quiz has ended"); //placeholder code, for debugging
    }

}
