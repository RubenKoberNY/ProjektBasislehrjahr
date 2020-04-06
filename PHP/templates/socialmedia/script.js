let questions = 8;

function createQuestions(){
    for (let i = 1; i <= questions; i++){

        let fragedivid = "frage" + i;
        let radio1id = i + "radio1";
        let radio2id = i + "radio2";
        let label1id = "lbl" + i + "radio1";
        let label2id = "lbl" + i + "radio2";

        let rdo1 = document.getElementById(radio1id);
        rdo1.setAttribute("name", fragedivid);
        rdo1.setAttribute("value", "Ja");

        let lbl1 = document.getElementById(label1id);
        lbl1.innerHTML = "Ja";

        let rdo2 = document.getElementById(radio2id);
        rdo2.setAttribute("name", fragedivid);
        rdo2.setAttribute("value", "Nein");


        let lbl2 = document.getElementById(label2id);
        lbl2.innerHTML = "Nein";
    }
}
createQuestions();

