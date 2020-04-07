$('.dropdown-trigger').dropdown();

function renderChart() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const right = urlParams.get("right");
    const wrong = urlParams.get("wrong");
    let msg = urlParams.get("msg");
    let hide = urlParams.has("hide");
    let rt = "Richtig";
    let wt = "Falsch";
    if(urlParams.get("rt")) rt = urlParams.get("rt");
    if(urlParams.get("wt")) rt = urlParams.get("wt");
    if(!msg) msg = "Quiz Abgeschlossen!";
    document.getElementById("msg").innerText = msg;
    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    right,
                    wrong
                ],
                backgroundColor: [
                    "green",
                    "red"
                ],
                label: 'Dataset 1'
            }],
            labels: [
                'Richtig',
                'Falsch'
            ]
        },
        options: {
            legend: {
                labels: {
                    fontColor: "white",
                    fontSize: 18
                }
            },
            responsive: true
        }
    };
    var ctx = document.getElementById('chart-area').getContext('2d');
    if(hide) document.getElementById("canvas-holder").style.display = "none";
    window.myPie = new Chart(ctx, config);
}
renderChart();
