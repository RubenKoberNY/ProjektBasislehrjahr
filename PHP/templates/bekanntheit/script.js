const URLBuilder = {
    buildURL: function (url, dict) {
        let out = url;
        Object.entries(dict).forEach((value, index) => {
            out += this.getNextURLParam(value[0], value[1], index);
        });
        return out;

    },
    getNextURLParam: function (key, value, count) {
        if (count == 0)
            return "?" + key + "=" + value;
        else
            return "&" + key + "=" + value;
    }
}

var questions;
var result = [];

var currentIndex = 0;


$("#answer1").click(() => {
    if (currentIndex < questions.length) {

    }
});
$("#answer2").click(() => {
    if (currentIndex < questions.length) {

    }
});
$("#answer3").click(() => {
    if (currentIndex < questions.length) {


    }
});