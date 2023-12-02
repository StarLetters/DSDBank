import { getUnpaidsPerMonth, getUnpaidReasons } from "./fetchData.js";
import { nHarmoniousColors } from "./colors.js";

let myChart;
let pieChart;
// fonction createBarChart pour utiliser les données générées
function createBarChart(labels, data) {
  if (myChart) {
    myChart.destroy();
  }
  const ctx = document.getElementById("barChart").getContext("2d");
  myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Montant des impayés",
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

function dataForChart(data) {
  const montants = data.map((item) => item.montant);
  const dates = data.map((item) => `${item.mois}/${item.annee}`);

  return { montants, dates };
}

function dataForPieChart(data) {
  const reasonCount = data.map((item) => item.count);
  const reasons = data.map((item) => item.libelle);

  return { reasonCount, reasons };
}



// graphique de courbes
function createLineChart(labels, data) {
  if (myChart) {
    myChart.destroy();
  }
  const ctx = document.getElementById("lineChart").getContext("2d");
  myChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Montant des impayés",
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

const makePieChart = (fetchedData, labels, colors) => {
  if (pieChart) {
    pieChart.destroy();
  }
  const data = {
    labels: labels,
    datasets: [
      {
        label: "Motifs d'impayés",
        data: fetchedData,
        backgroundColor: colors,
        hoverOffset: 4,
      },
    ],
  };

  const ctx = document.getElementById("pieChart").getContext("2d");
  pieChart = new Chart(ctx, {
    type: "pie",
    data: data,
    options: {
      plugins: {
        legend: {
          position: "bottom",
        },
      },
    },
  });
};

// Fonction pour basculer entre les graphiques
async function toggleCharts(selectedChart) {
  const barChartSection = document.getElementById("barChartSection");
  const lineChartSection = document.getElementById("lineChartSection");

  const startDate = document.getElementById("startDate").value;
  const endDate = document.getElementById("endDate").value;

  console.log(startDate);
  console.log(endDate);

  try {
    const fetchedData = await getUnpaidsPerMonth(startDate, endDate);
    const { montants, dates } = dataForChart(fetchedData);

    const fetchedReasons = await getUnpaidReasons(startDate, endDate);

    const { reasonCount, reasons} = dataForPieChart(fetchedReasons);

    console.log(reasonCount);
    console.log(reasons);


    makePieChart(reasonCount, reasons, nHarmoniousColors("blue",reasons.length));

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



export { toggleCharts };