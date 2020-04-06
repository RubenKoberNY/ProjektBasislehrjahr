let questions = 8;

function createQuestions(){
    for (let i = 1; i <= questions; i++){

        let fragedivid = "frage" + i;
        let fragetext = "frage" + i + "frage";
        let radio1id = i + "radio1";
        let radio2id = i + "radio2";
        let span1id = "spn" + i + "radio1";
        let span2id = "spn" + i + "radio2";

        let frage1 = document.getElementById(fragetext);
        frage1.innerHTML = "[PLACEHOLDER FÜR FRAGE " + i + "]"

        let rdo1 = document.getElementById(radio1id);
        rdo1.setAttribute("name", fragedivid);
        rdo1.setAttribute("value", "Ja");

        let spn1 = document.getElementById(span1id);
        spn1.innerHTML = "Ja";

        let rdo2 = document.getElementById(radio2id);
        rdo2.setAttribute("name", fragedivid);
        rdo2.setAttribute("value", "Nein");


        let spn2 = document.getElementById(span2id);
        spn2.innerHTML = "Nein";
    }
}
createQuestions();

