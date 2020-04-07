var fragen;
$(document).ready(function() {
    getAllQuestions();
});
    function getAllQuestions() {
        $.ajax({
            url: "/api/einbuergerung/get",
            method: "GET"
        }).done(function (result) {
            fragen = JSON.parse(result);
            for (var i = 0; i < fragen.length; i++) {
                console.log(fragen[i].fragetext);

            }
        });
    }

