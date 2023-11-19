import { getUnpaid } from "./fetchData.js";
import { createTable } from "./dataTable.js";

// Fonction pour générer des données pour le graphique à barres
function generateBarData(startDate, endDate) {
  const start = new Date(startDate);
  const end = new Date(endDate);
  const labels = [];
  const data = [];
  let currentDate = new Date(start);

  while (currentDate <= end) {
    const month = currentDate.toLocaleString("default", { month: "short" });
    const year = currentDate.getFullYear();
    labels.push(`${month} ${year}`);
    data.push(50);
    currentDate.setMonth(currentDate.getMonth() + 1);
  }

  return { labels, data };
}

// fonction createBarChart pour utiliser les données générées
function createBarChart(labels, data) {
  const ctx = document.getElementById("barChart").getContext("2d");
  new Chart(ctx, {
    type: "bar",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Data",
          data: data,
          backgroundColor: "rgba(75, 192, 192, 0.2)",
          borderColor: "rgba(75, 192, 192, 1)",
          borderWidth: 1,
        },
      ],
    },
    options: {
      plugins: {
        annotation: {
          annotations: [
            {
              type: "box",
              xScaleID: "x",
              yScaleID: "y",
              xMin: -0.5,
              xMax: -0.5,
              yMin: 0,
              yMax: 100,
              backgroundColor: "rgba(0, 0, 0, 0)",
              borderColor: "rgba(0, 0, 0, 0)",
              label: {
                content: labels[0],
                enabled: true,
                position: "left",
              },
            },
            {
              type: "box",
              xScaleID: "x",
              yScaleID: "y",
              xMin: labels.length - 0.5,
              xMax: labels.length - 0.5,
              yMin: 0,
              yMax: 100,
              backgroundColor: "rgba(0, 0, 0, 0)",
              borderColor: "rgba(0, 0, 0, 0)",
              label: {
                content: labels[labels.length - 1],
                enabled: true,
                position: "right",
              },
            },
          ],
        },
      },
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}
// Fonction pour générer des données pour le graphique de courbes
async function fetchData(startDate, endDate) {
  console.log(startDate);
  console.log(endDate);

  try {
    const data = await getUnpaid(startDate, endDate);

    return data;
  } catch (error) {
    console.error(error);
    throw new Error("Erreur lors de la récupération des données");
  }
}

function dataForChart(data) {
  const montants = data.map((item) => item.montant);
  const dates = data.map((item) => `${item.mois}/${item.annee}`);

  return { montants, dates };
}

// graphique de courbes
function createLineChart(labels, data) {
  const ctx = document.getElementById("lineChart").getContext("2d");
  const lineChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Données de ligne",
          data: data,
          fill: false,
          borderColor: "rgba(75, 192, 192, 1)",
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        yAxes: [
          {
            ticks: {
              beginAtZero: true,
            },
          },
        ],
      },
    },
  });
}

// Fonction pour basculer entre les graphiques
async function toggleCharts(selectedChart) {
  const barChartSection = document.getElementById("barChartSection");
  const lineChartSection = document.getElementById("lineChartSection");

  const startDate = document.getElementById("startDate").value;
  const endDate = document.getElementById("endDate").value;

  console.log(startDate);
  console.log(endDate);

  try {
    const fetchedData = await fetchData(startDate, endDate);
    createTable(fetchedData);
    const { montants, dates } = dataForChart(fetchedData);

    if (selectedChart === "bar") {
      barChartSection.style.display = "block";
      lineChartSection.style.display = "none";

      createBarChart(dates, montants);
    } else if (selectedChart === "line") {
      barChartSection.style.display = "none";
      lineChartSection.style.display = "block";

      createLineChart(dates, montants);
    }
  } catch (error) {
    console.error(error);
  }
}

function updateCharts() {
  toggleCharts(document.getElementById("chartType").value);
}

// Par défaut, cacher le graphique à courbe
const lineChartSection = document.getElementById("lineChartSection");
lineChartSection.style.display = "none";

// Ajouter des écouteurs d'événements
document.getElementById("startDate").addEventListener("change", updateCharts);
document.getElementById("endDate").addEventListener("change", updateCharts);
document.getElementById("chartType").addEventListener("change", function () {
  toggleCharts(this.value);
});

// Par défaut, afficher le graphique à barres
document.getElementById("chartType").value = "bar";
toggleCharts("bar");
