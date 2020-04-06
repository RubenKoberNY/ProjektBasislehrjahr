$('.dropdown-trigger').dropdown();

function renderChart() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const right = urlParams.get("right");
    const wrong = urlParams.get("wrong");
    let msg = urlParams.get("msg");
    let hide = urlParams.has("hide");
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
                    "red",
                    "green"
                ],
                label: 'Dataset 1'
            }],
            labels: [
                'Richtig',
                'Falsch'
            ]
        },
        options: {
            responsive: true
        }
    };
    var ctx = document.getElementById('chart-area').getContext('2d');
    if(hide) document.getElementById("canvas-holder").style.display = "none";
    window.myPie = new Chart(ctx, config);
}
renderChart();
