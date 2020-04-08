document.getElementById("button").onclick = () => {
  GetSliderValue();
}

function GetSliderValue(){
var s = document.getElementById("slide").value;
var s1 = document.getElementById("slide1").value;
var s2 = document.getElementById("slide2").value;
var s3 = document.getElementById("slide3").value;
var s4 = document.getElementById("slide4").value;
var s5 = document.getElementById("slide5").value;
var s6 = document.getElementById("slide6").value;
var s7 = document.getElementById("slide7").value;
var s8 = document.getElementById("slide8").value;
var sliders = parseInt(s)+parseInt(s1)+parseInt(s2)+parseInt(s3)+parseInt(s4)+parseInt(s5)+parseInt(s6)+parseInt(s7)+parseInt(s8);
console.log (sliders)
} 