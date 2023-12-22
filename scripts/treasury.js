import { updateDataTable, changeItemsPerPage } from "./dataTable.js";
import { getTreasury } from "./fetchData.js";
import { toggleTreasury } from "./graphic.js";
import { addRedClassToCellIfNegative } from "./utilities.js";

// Constantes pour les éléments HTML réutilisés
const itemsPerPageElement = document.getElementById("items-per-page");
const nSIRENElement = document.getElementById("nSIREN");
const resetButtonElement = document.getElementById("resetButton");
const searchButtonElement = document.getElementById("searchButton");
const orderByElement = document.getElementById("order-by");
const chartTitle = document.getElementById("chartTitle");
const lineChart = document.getElementById("lineChart");
const dateValue = document.getElementById("dateValeur");
const socialReason = document.getElementById("raisonSociale");

// Fonction pour mettre à jour le tableau
async function updateTable() {
  const fetchedData = await getTreasury();
  updateDataTable(fetchedData);

  if ( fetchedData.length === 1 ) {
    toggleTreasury(dateValue.value);
    chartTitle.style.display = "block";
    lineChart.style.display = "block";
  } else {
    chartTitle.style.display = "none";
    lineChart.style.display = "none";
  }
  addRedClassToCellIfNegative(
    document.querySelectorAll("#table-container tbody tr")
  );
}

// Fonction pour ajouter des écouteurs d'évènements
async function addListener() {
  itemsPerPageElement.addEventListener("change", () => {
    changeItemsPerPage();
    addRedClassToCellIfNegative();
  });
  searchButtonElement.addEventListener("click", updateTable);
  if (nSIRENElement) {
    nSIRENElement.addEventListener("keyup", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("searchButton").click();
      }
    });
  }
  resetButtonElement.addEventListener("click", () => {
    if (nSIRENElement) {
      nSIRENElement.value = "";
      socialReason.value = "";
    }
    dateValue.value = "";
    updateDataTable();
  });
  orderByElement.addEventListener("change", updateTable);
}

function initializeTreasury() {
  addListener();
  updateTable();
  chartTitle.style.display = "none";
}

initializeTreasury();
