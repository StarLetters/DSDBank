import { getUnpaidsPerMonth, getUnpaidReasons, getTreasuryPerMonth, getDiscount } from "./fetchData.js";
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
          backgroundColor: "#7393B3",
          borderColor: "#7393B3",
          borderWidth: 1,
          color: "black",
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
              backgroundColor: "rgba(0, 0, 0)",
              borderColor: "rgba(0, 0, 0)",
              label: {
                content: labels[0],
                enabled: true,
                position: "left",
                fontSize: "20px",
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
                fontSize: "20px",
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

function createStackedBarChart(config) {
  if (myChart) {
    myChart.destroy();
  }
  const ctx = document.getElementById("barChart").getContext("2d");
  myChart = new Chart(ctx, config);
}

function createStackedLineChart(config) {
  if (myChart) {
    myChart.destroy();
  }
  const ctx = document.getElementById("lineChart").getContext("2d");
  myChart = new Chart(ctx, config);
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
function createLineChart(title, labels, data) {
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
          label: title,
          data: data,
          fill: false,
          borderColor: "#7393B3",
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        x: {
          stacked: true,
        },
        y: {
          stacked: true
        }
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
  const screenWidth = window.innerWidth;
  
  pieChart = new Chart(ctx, {
    type: "pie",
    data: data,
    options: {
      responsive: true,
      maintainAspectRatio: screenWidth < 480 ? false : true,
      plugins: {
        legend: {
          position: "bottom",
        },
      },
      
    },
  });
  console.log(pieChart);
};

// Fonction pour basculer entre les graphiques
async function toggleUnpaidCharts(selectedChart) {
  const barChartSection = document.getElementById("barChartSection");
  const lineChartSection = document.getElementById("lineChartSection");

  const startDate = document.getElementById("startDate").value;
  const endDate = document.getElementById("endDate").value;

  try {
    const fetchedData = await getUnpaidsPerMonth(startDate, endDate);
    const { montants, dates } = dataForChart(fetchedData);

    const fetchedReasons = await getUnpaidReasons(startDate, endDate);
    const { reasonCount, reasons } = dataForPieChart(fetchedReasons);

    const treasuryPerMonthFetched = await getTreasuryPerMonth(startDate, endDate);

    let turnoverPerMonth = [];
    for (let i = 0; i < montants.length; i++) {
      turnoverPerMonth[i] = 0;
      for (let j = 0; j < treasuryPerMonthFetched.length; j++) {
        if (parseInt(treasuryPerMonthFetched[j].mois.split("-")[1]) === parseInt(dates[i].split("/")[0]) && treasuryPerMonthFetched[j].mois.split("-")[0] === dates[i].split("/")[1]) {
          turnoverPerMonth[i] = parseInt(treasuryPerMonthFetched[j].totalmontant) + parseInt(montants[i]);
        }
      }
    }
    const data = {
      labels: dates,
      datasets: [
        {
          label: "Montant des impayés",
          data: montants,
          backgroundColor: '#FFB1B1',
        },

        {
          label: "Chiffre d'affaires global",
          data: turnoverPerMonth,
          backgroundColor: '#C6B1FF',
        },
      ]
    };


    const config = {
      type: selectedChart,
      data: data,
      options: {
        plugins: {
          title: {
            display: true,
            text: 'Impayés'
          },
        },
        responsive: true,
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true
          }
        }
      }
    };

    makePieChart(reasonCount, reasons, nHarmoniousColors("blue", reasons.length));

    if (selectedChart === "bar") {
      barChartSection.style.display = "block";
      lineChartSection.style.display = "none";

      createStackedBarChart(config);

    } else if (selectedChart === "line") {
      barChartSection.style.display = "none";
      lineChartSection.style.display = "block";

      createStackedLineChart(config);
    }
  } catch (error) {
    console.error(error);
  }
}

function dataForChart2(data) {
  const montants = data.map((item) => item.totalmontant);
  const dates = data.map((item) => `${item.mois}`);

  return { montants, dates };
}

async function toggleTreasury(date) {
  const fetchedData = await getTreasuryPerMonth("", date);
  const { montants, dates } = dataForChart2(fetchedData);
  createLineChart("Evolution de la trésorerie", dates, montants);
}

export { toggleUnpaidCharts, toggleTreasury };