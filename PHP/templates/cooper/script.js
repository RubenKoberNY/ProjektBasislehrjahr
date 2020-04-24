var dictionary = {
    maleage1: ["> 2800m", "2401 – 2800m", "2201 – 2400m", "1600 – 2200m", "< 1600m"],
    maleage2: ["> 2700m", "2301 – 2700m", "1901 – 2300m", "1500 – 1900m", "< 1500m"],
    maleage3: ["> 2500m", "2101 – 2500m", "1701 – 2100m", "1400 – 1700m", "< 1400m"],
    maleage4: ["> 2400m", "2001 – 2500m", "1601 – 2000m", "1300 – 1600m", "< 1300m"],
    femaleage1: ["> 2700m", "2201 – 2700m", "1801 – 2200m", "1500 – 1800m", "< 1500m"],
    femaleage2: ["> 2500m", "2001 – 2500m", "1701 – 2000m", "1400 – 1700m", "< 1400m"],
    femaleage3: ["> 2300m", "1901 – 2300m", "1501 – 1900m", "1200 – 1500m", "< 1200m"],
    femaleage4: ["> 2700m", "170 – 2200m", "1401 – 1700m", "1100 – 1400m", "< 1100m"]
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
    console.log(ageSelection);
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
    window.location = "%BASE_URL%evaluation?hide&msg=" + result;

}
