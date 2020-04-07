/*function showPage(){
    document.getElementById("first").classList.add("hide");
    document.getElementById("second").classList.remove("hide");
}*/

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

function getValueFromSelectedRadioButtonFromQuestionTwo()
{
    var questionTwo = document.getElementsByName("frage2");
    for (var radioButtonQuestionTwo of questionTwo)
    {
        if (radioButtonQuestionTwo.checked)
        {
            return(radioButtonQuestionTwo.value);
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
            alert("Sie haben keine Antwort ausgewählt!")
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
            alert("Sie haben keine Antwort ausgewählt!")
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
            alert("Sie haben keine Antwort ausgewählt!")
        }
    }
}


function testfrage2()
{
    alert(getValueFromSelectedRadioButtonFromQuestionOne());
 /*   alert(getValueFromSelectedRadioButtonFromQuestionTwo());
    alert(getValueFromSelectedRadioButtonFromQuestionThree());
    alert(getValueFromSelectedRadioButtonFromQuestionFour());
    alert(getValueFromSelectedRadioButtonFromQuestionFive());
    alert(getValueFromSelectedRadioButtonFromQuestionSix());*/
}