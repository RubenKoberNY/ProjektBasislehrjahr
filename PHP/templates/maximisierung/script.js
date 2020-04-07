/*function showPage(){
    document.getElementById("first").classList.add("hide");
    document.getElementById("second").classList.remove("hide");
}*/

 function displayRadioButtonValue()
{
    var frage1Nummer1 = document.getElementById("frage1Nummer1").value;
    var frage1Nummer2 = document.getElementById("frage1Nummer2").value;
    var frage1Nummer3 = document.getElementById("frage1Nummer3").value;
    var frage1Nummer4 = document.getElementById("frage1Nummer4").value;
    var frage1Nummer5 = document.getElementById("frage1Nummer5").value;
    var frage1Nummer6 = document.getElementById("frage1Nummer6").value;
    var frage1Nummer7 = document.getElementById("frage1Nummer7").value;

    /*if (frage1Nummer1.checked == true) {
        frage1Nummer1 = 1;
        return; frage1Nummer1
    } else if (frage1Nummer2.checked == true) {
        frage1Nummer2 = 2;
        return; frage1Nummer2
    }  else if (frage1Nummer3.checked == true) {
        frage1Nummer3 = 3;
        return; frage1Nummer3
    }  else if (frage1Nummer4.checked == true) {
        frage1Nummer4 = 4;
        return; frage1Nummer4
    }  else if (frage1Nummer5.checked == true) {
        frage1Nummer5 = 5;
        return; frage1Nummer5
    }  else if (frage1Nummer6.checked == true) {
        frage1Nummer6 = 6;
        return; frage1Nummer6
    }  else if (frage1Nummer7.checked == true) {
        frage1Nummer7 = 7;
        return; frage1Nummer7
    }*/

    alert(frage1Nummer1 || frage1Nummer2 || frage1Nummer3 || frage1Nummer4 | frage1Nummer5 || frage1Nummer6 ||
            frage1Nummer7)
}

function getValueFromSelectedRadioButtonFromQuestionOne()
{
    var questionOne = document.getElementsByName("frage1");
    for (var radioButtonQuestionOne of questionOne)
    {
        if (radioButtonQuestionOne.checked)
        {
            return(radioButtonQuestionOne.value);
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
        }
    }
}






/*FUNKTIONIERT! Frage zwei VALUES*/
function displayRadioButtonValuefrage2()
{
    var frage2Nummer = document.getElementsByName("frage2");
    for (var radioFrage2Nummer of frage2Nummer) {
        if (radioFrage2Nummer.checked) {
            return(radioFrage2Nummer.value);
        }
    }
}

function testfrage2()
{
    alert(displayRadioButtonValuefrage2());
}
