$('.dropdown-trigger').dropdown();

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
let chartType = urlParams.get("chart");

function renderChart() {
    let msg = urlParams.get("msg");
    let hide = urlParams.has("hide");
    if (!msg) msg = "Quiz Abgeschlossen!"; //if there is no custom message, go for the default one
    var ctx = document.getElementById('chart-area').getContext('2d');
    var chart;
    //set message
    document.getElementById("msg").innerText = msg;

    switch (chartType) {
        case "pie":
            const right = urlParams.get("right");
            const wrong = urlParams.get("wrong");
            let rt = "Richtig";
            let wt = "Falsch";
            if (urlParams.get("rt")) rt = urlParams.get("rt");
            if (urlParams.get("wt")) wt = urlParams.get("wt");

            let pieConfiguration = {
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
                        rt,
                        wt
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


            chart = new Chart(ctx, pieConfiguration);

        case "radar":
            //default values for quiz The Big Five, overridable
            var maxRange = 7.0;
            var chartLabels = ["Extraversion", "Verträglichkeit", "Gewissenhaftigkeit", "Emotionale Stabilität", "Offenheit für Erfahrung"];
            var data = urlParams.get("data").split(",");
            if (urlParams.get("test")) {
                var test = urlParams.get("test").split(",");
                for (var i = 0; i < test.length; i++) {
                    chartLabels[i] = test[i];
                }

                if (urlParams.has("overrideLabels")) {
                    chartLabels.splice(test.length, chartLabels.length - test.length);
                }
            }
            if (urlParams.get("max")) maxRange = urlParams.get("max");

            let radarConfiguration =
                {
                    type: 'radar',

                    labels: {
                        fontColor: 'rgb(255,255,255)',
                    },
                    data: {
                        labels: chartLabels,
                        datasets: [{
                            label: 'Deine Angaben',
                            backgroundColor: 'rgba(255, 255, 255, 0.1)',
                            borderColor: '#039be5',
                            data: data,
                        },]
                    },

                    options: {
                        legend: {
                            position: 'top',
                            labels: {
                                fontColor: 'white'
                            }
                        },
                        scale: {
                            ticks: {
                                beginAtZero: true,
                                max: maxRange,
                                fontColor: 'white',
                                showLabelBackdrop: false
                            },
                            pointLabels: {
                                fontColor: 'white'
                            },
                            gridLines: {
                                color: 'rgba(255, 255, 255, 0.2)'
                            },
                            angleLines: {
                                color: 'white'
                            }
                        }
                    }
                };
            chart = new Chart(ctx, radarConfiguration);
    }
    if (hide) document.getElementById("canvas-holder").style.display = "none";
}

renderChart();
