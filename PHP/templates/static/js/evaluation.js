$('.dropdown-trigger').dropdown();

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
let chartType = urlParams.get("chart");

function renderChart() {
    let msg = urlParams.get("msg");
    let hide = urlParams.has("hide");
    if (!msg) msg = "Quiz abgeschlossen!"; //if there is no custom message, go for the default one
    let ctx = document.getElementById('chart-area').getContext('2d');
    let chart;
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
            let maxRange = 7.0;
            let chartLabels = ["Extraversion", "Verträglichkeit", "Gewissenhaftigkeit", "Emotionale Stabilität", "Offenheit für Erfahrung"];
            let data = urlParams.get("data").split(",");
            if (urlParams.get("labels")) {
                var customLabels = urlParams.get("labels").split(",");
                for (var i = 0; i < customLabels.length; i++) {
                    chartLabels[i] = customLabels[i];
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
        case "scattered":
        let cordx = urlParams.get("datax");
        let cordy = urlParams.get("datay");
        let title = urlParams.get("title");
        let scatteredConfiguration = {
            type: 'scatter',
                data: {
            datasets: [{
                label: title,
                backgroundColor: '',
                borderColor: '#039be5',
                borderWidth: 10,
                data: [{
                    x: cordx,
                    y: cordy,
                }],
            }],
        },
            options: {
                scales: {
                    xAxes: [{
                        type: 'linear',
                        position: 'bottom',
                        gridLines: {
                            color: 'white',
                            display: true,
                        },
                    }],
                    yAxes: [{
                        gridLines: {
                            color: 'white',
                            display: true,
                        },
                    }]
                },
                legend: {
                    position: 'top',
                    borderWidth: 3,
                    hidden: true,
                    labels: {
                        fontColor: 'white',
                    }
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
        };
            chart = new Chart(ctx, scatteredConfiguration);
    }
    if (hide) document.getElementById("canvas-holder").style.display = "none";
}

renderChart();
