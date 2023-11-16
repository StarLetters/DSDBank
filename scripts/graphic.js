// fonction generateFixedData pour générer des mois triés par année jusqu'à aujourd'hui
function generateFixedData(year) {
    const data = [];
    for (let month = 0; month < 12; month++) {
        data.push(`${month + 1}/${year}`);
    }
    return data;
}

// fonction createBarChart pour utiliser les données générées
function createBarChart(data, year) {
    const ctx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data,
            datasets: [{
                label: 'Valeurs fixes',
                data: generateFixedData(year).map(() => 50),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
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

// Fonction pour générer des données pour le graphique de courbes
function generateLineData(numMonths) {
    const data = [];
    for (let i = numMonths; i >= 0; i--) {
        const date = new Date();
        date.setMonth(date.getMonth() - i);
        data.push(Math.floor(Math.random() * 100));
    }
    return data;
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
    } else if (selectedChart === 'line') {
        barChartSection.style.display = 'none';
        lineChartSection.style.display = 'block';

        // Ajout de l'appel à createLineChart lorsque vous choisissez le graphique à courbes
        const numMonths = parseInt(document.getElementById('monthsLine').value, 10);
        const labels = [];
        for (let i = numMonths; i >= 0; i--) {
            const date = new Date();
            date.setMonth(date.getMonth() - i);
            labels.push(date.toLocaleDateString('fr-FR', { month: 'long' }));
        }
        const lineData = generateLineData(numMonths);
        createLineChart(labels, lineData);
    }
}

const lineChartSection = document.getElementById('lineChartSection');
lineChartSection.style.display = 'none';


document.getElementById('chartType').addEventListener('change', function () {
    const selectedChart = this.value;
    toggleCharts(selectedChart);
});

// Initialisation avec le graphique à barres par défaut
document.getElementById('chartType').value = 'bar';

// Appele la fonction createBarChart avec les données générées pour l'année actuelle
const currentYear = new Date().getFullYear();
createBarChart(generateFixedData(currentYear), currentYear);
