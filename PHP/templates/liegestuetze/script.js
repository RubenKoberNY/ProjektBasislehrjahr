var dictionary = {
    maleage1: [">55","45-55","32-44","20-31","0-19"],
    maleage2: [">45","35-45","22-34","15-21","0-14"],
    maleage3: [">40","30-40","19-29","14-18","0-13"],
    maleage4: [">35","25-35","13-24","9-12","0-8"],
    maleage5: [">30","20-30","10-19","7-9","0-6"],
    femaleage1: [">50","35-50","16-34","8-15","0-7"],
    femaleage2: [">40","25-40","13-24","6-12","0-5"],
    femaleage3: [">35","20-35","10-19","5-9","0-4"],
    femaleage4: [">30","15-30","7-14","4-6","0-3"],
    femaleage5: [">20","6-20","4-5","2-3","0-1"]
};
var ageSelection = 0;
var genderSelection = "";
$(document).ready(function () {
    ageSelection = $('input[name=age]:checked').val();
    genderSelection = $('input[name=gender]:checked').val();
    updateLabels();
    $('input:radio[name="gender"]').change(
        function () {
            if (this.checked) {
                genderSelection = this.value;
                updateLabels();
            }
        }
    );
    $('input:radio[name="age"]').change(
        function () {
            if (this.checked) {
                ageSelection = this.value;
                updateLabels();
            }
        }
    )
});

function updateLabels() {
    let lengths = dictionary[genderSelection + ageSelection.toString()];
    console.log(lengths);
    console.log(ageSelection)
    var i = 1;
    lengths.forEach(function (item) {
        console.log(item);
        $("#lengthLabel" + i).text(item);
        i++;
    });
}

function submit() {
    let value = $('input[name=length]:checked').val();
    let result = "";
    switch (value) {
        case "vgood":
            result = "Sehr gut!";
            break;
        case "good":
            result = "Gut!";
            break;
        case "average":
            result = "Durchschnittlich";
            break;
        case "bad":
            result = "Schlecht";
            break;
        case "vbad":
            result = "Sehr schlecht!";
            break;
    }
    window.location = "/evaluation?hide&msg=" + result;

}