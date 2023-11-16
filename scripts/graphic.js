import { getDataFromServer } from './dataTable.js';


// fonction generateFixedData pour générer des mois triés par année jusqu'à aujourd'hui
function generateFixedData(year) {
    const data = [];
    for (let month = 0; month < 12; month++) {
        data.push(`${month + 1}/${year}`); // +1 car getMonth() renvoie 0 pour janvier, 1 pour février, etc.
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
                data: generateFixedData(year).map(() => 50), // à changer pour les valeurs
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
        data.push(Math.floor(Math.random() * 100)); // on mettra nos vraies données
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


getDataFromServer();

// Ajoute un événement de changement de sélection de mois pour le graphique de courbes
document.getElementById('monthsLine').addEventListener('change', function () {
    const numMonths = parseInt(this.value, 10);
    const labels = [];
    for (let i = numMonths; i >= 0; i--) {
        const date = new Date();
        date.setMonth(date.getMonth() - i);
        labels.push(date.toLocaleDateString('fr-FR', { month: 'long' }));
    }
    const lineData = generateLineData(numMonths);
    createLineChart(labels, lineData);
});

// Initialise le graphique de courbes avec une sélection de 6 mois par défaut
document.getElementById('monthsLine').value = '6';
const labels2 = [];
for (let i = 6; i >= 0; i--) {
    const date = new Date();
    date.setMonth(date.getMonth() - i);
    labels2.push(date.toLocaleDateString('fr-FR', { month: 'long' }));
}
const lineData2 = generateLineData(6);
createLineChart(labels2, lineData2);


// Ajoute un événement de changement de sélection d'année
document.getElementById('year').addEventListener('change', function () {
    const selectedYear = parseInt(this.value, 10);
    createBarChart(generateFixedData(selectedYear), selectedYear);
});

// Appele la fonction createBarChart avec les données générées pour l'année actuelle
const currentYear = new Date().getFullYear();
createBarChart(generateFixedData(currentYear), currentYear);