import { getUnpaid } from "./fetchData.js";
import { convertToCumulativeBalance } from "./dataConverter.js";

// Fonction pour générer des données pour le graphique à barres
function generateBarData(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    const labels = [];
    const data = [];
    let currentDate = new Date(start);

    while (currentDate <= end) {
        const month = currentDate.toLocaleString('default', { month: 'short' });
        const year = currentDate.getFullYear();
        labels.push(`${month} ${year}`);
        data.push(50);
        currentDate.setMonth(currentDate.getMonth() + 1);
    }

    return { labels, data };
}

// fonction createBarChart pour utiliser les données générées
function createBarChart(data, startDate, endDate) {
    const ctx = document.getElementById('barChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Data',
                data: data.data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                annotation: {
                    annotations: [
                        {
                            type: 'box',
                            xScaleID: 'x',
                            yScaleID: 'y',
                            xMin: -0.5,
                            xMax: -0.5,
                            yMin: 0,
                            yMax: 100,
                            backgroundColor: 'rgba(0, 0, 0, 0)',
                            borderColor: 'rgba(0, 0, 0, 0)',
                            label: {
                                content: startDate,
                                enabled: true,
                                position: 'left'
                            }
                        },
                        {
                            type: 'box',
                            xScaleID: 'x',
                            yScaleID: 'y',
                            xMin: data.labels.length - 0.5,
                            xMax: data.labels.length - 0.5,
                            yMin: 0,
                            yMax: 100,
                            backgroundColor: 'rgba(0, 0, 0, 0)',
                            borderColor: 'rgba(0, 0, 0, 0)',
                            label: {
                                content: endDate,
                                enabled: true,
                                position: 'right'
                            }
                        }
                    ]
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
// Fonction pour générer des données pour le graphique de courbes
function generateLineData(startDate, endDate) {

    return convertToCumulativeBalance(getUnpaid(startDate, endDate), startDate, endDate).then(convertRes => {
    const data = [];

    const fetchedData = convertRes.cumulativeBalanceC;

    for (let key in fetchedData){
        const maxIndex = fetchedData[key];
        for (let i = 0; i < maxIndex; i++){
            data.push(key);
        }
    }
    return {data, startDate:convertRes.startDate, endDate:convertRes.endDate};
});
}

// graphique de courbes
function createLineChart(labels, data) {
    const ctx = document.getElementById('lineChart').getContext('2d');
    const lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Données de ligne',
                data: data,
                fill: false,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}

// Fonction pour basculer entre les graphiques
function toggleCharts(selectedChart) {
    const barChartSection = document.getElementById('barChartSection');
    const lineChartSection = document.getElementById('lineChartSection');

    if (selectedChart === 'bar') {
        barChartSection.style.display = 'block';
        lineChartSection.style.display = 'none';

        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const barData = generateBarData(startDate, endDate);
        createBarChart(barData);
    } else if (selectedChart === 'line') {
        barChartSection.style.display = 'none';
        lineChartSection.style.display = 'block';

        const startDateLine = document.getElementById('startDateLine').value;
        const endDateLine = document.getElementById('endDateLine').value;
        generateLineData(startDateLine, endDateLine).then(fetchedData => {

            const { data, startDate, endDate } = fetchedData;
            console.log(
                data
            );

            const labels = generateLabels(startDate, endDate);

            console.log(data);
            console.log(labels);

            createLineChart(labels, data);
        });
    }
}

const lineChartSection = document.getElementById('lineChartSection');
lineChartSection.style.display = 'none';

document.getElementById('startDate').addEventListener('change', updateCharts);
document.getElementById('endDate').addEventListener('change', updateCharts);
document.getElementById('startDateLine').addEventListener('change', updateCharts);
document.getElementById('endDateLine').addEventListener('change', updateCharts);

document.getElementById('chartType').addEventListener('change', function () {
    toggleCharts(this.value);
    updateCharts();
});

function generateLabels(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    const labels = [];
    console.log(startDate, endDate);
    while (start <= end) {
        labels.push(`${start.getMonth() + 1}/${start.getDate()}`);
        start.setDate(start.getDate() + 1);
    }
    return labels;
}

function updateCharts() {
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    const startDateLine = document.getElementById('startDateLine').value;
    const endDateLine = document.getElementById('endDateLine').value;
    const selectedChart = document.getElementById('chartType').value;

    if (selectedChart === 'bar') {
        const data = generateBarData(startDate, endDate);
        createBarChart(data);
    } else if (selectedChart === 'line') {
        const lineData = generateLineData(startDateLine, endDateLine);
        const labels = generateLabels(startDateLine, endDateLine);
        createLineChart(labels, lineData);
    }
}


document.getElementById('chartType').value = 'bar';
toggleCharts('bar');

const currentYear = new Date().getFullYear();