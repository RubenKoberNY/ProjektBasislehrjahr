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
            let color1 = "green";
            let color2 = "red";
            if (urlParams.get("color1")) color1 = urlParams.get("color1");
            if (urlParams.get("color2")) color2 = urlParams.get("color2");
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
                            color1,
                            color2
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
            break;
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
            break;
        case "scattered":
            let cordx = urlParams.get("datax");
            let cordy = urlParams.get("datay");

            let title = "Auswertung";
            if (urlParams.get("title")) title = urlParams.get("title");
            let yLabel = "";
            if (urlParams.get("ylabel")) yLabel = urlParams.get("ylabel");
            let xLabel = "";
            if (urlParams.get("xlabel")) xLabel = urlParams.get("xlabel");
            let xMax = 10;
            if (urlParams.get("xmax")) xMax = urlParams.get("xmax");
            let yMax = 10;
            if (urlParams.get("ymax")) yMax = urlParams.get("ymax");
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
                            scaleLabel: {
                                display: true,
                                labelString: xLabel,
                                fontColor: "white",
                                fontSize: 14,
                                fontFamily: "Roboto",
                            },
                            type: 'linear',
                            position: 'bottom',
                            gridLines: {
                                color: 'white',
                                display: true,
                            },
                            ticks: {
                                beginAtZero: true,
                                max: parseInt(xMax),
                                fontColor: 'white',
                                showLabelBackdrop: false
                            },
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: yLabel,
                                fontColor: "white",
                                fontSize: 14,
                                fontFamily: "Roboto",
                            },
                            gridLines: {
                                color: 'white',
                                display: true,
                            },
                            ticks: {
                                beginAtZero: true,
                                max: parseInt(yMax),
                                fontColor: 'white',
                                showLabelBackdrop: false
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
            break;
    }
    if (hide) document.getElementById("canvas-holder").style.display = "none";
}

renderChart();
