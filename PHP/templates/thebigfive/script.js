let types = [
    "extravertiert, offen",
    "optimistisch"
];
let amountOfQuestions = types.length;
var currentQuestion = 0;

$( document ).ready(function() {
    requestQuestion();
});

// this function gets called as soon as the user presses the "Next" button
// it's also called once the page loads in order to get the first question
function requestQuestion(){
    //check if there are any questions left
    if(currentQuestion < amountOfQuestions) {
        //when requested, the current question keywords will fade out
        $("#question").fadeOut('fast', function() {
            //while faded out, the next question is set
            $("#question").text(types[currentQuestion]);
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