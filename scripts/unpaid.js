import { toggleUnpaidCharts } from "./graphic.js";
import { updateDataTable, changeItemsPerPage} from "./dataTable.js";
import { displayElements } from "./utilities.js";
import { getUnpaidsForEach } from "./fetchData.js";


// Constantes pour les éléments HTML réutilisés
const startDateElement = document.getElementById("startDate");
const endDateElement = document.getElementById("endDate");
const chartTypeElement = document.getElementById("chartType");
const itemsPerPageElement = document.getElementById("items-per-page");
const orderByElement = document.getElementById("order-by");
const searchButtonElement = document.getElementById("searchButton");
const nImpElement = document.getElementById("nImp");
const resetButtonElement = document.getElementById("resetButton");
const nSIRENElement = document.getElementById("nSIREN");
const raisonSocialeElement = document.getElementById("raisonSociale");
const choiceDateImpElement = document.getElementById("choiceDateImp");
const lineChartSection = document.getElementById("lineChartSection");

let startDate = document.getElementById("startDate").value;
let endDate = document.getElementById("endDate").value;
let order = document.getElementById("order-by").value;
let data = await getUnpaidsForEach(startDate, endDate, order);

let nImp = document.getElementById("nImp").value;
let raisonSociale = document.getElementById("raisonSociale") ? document.getElementById("raisonSociale").value : "";
let nSIREN = document.getElementById("nSIREN") ? document.getElementById("nSIREN").value : "";


function updateAll() {
  displayOrderBy();
  search();
  toggleUnpaidCharts(document.getElementById("chartType").value);
}

// Fonction pour mettre à jour le tableau et les graphiques
async function updateTable() {
  startDate = document.getElementById("startDate").value;
  endDate = document.getElementById("endDate").value;
  order = document.getElementById("order-by").value;
  data = await getUnpaidsForEach(startDate, endDate, order, nImp, nSIREN, raisonSociale);

  updateDataTable(data);
}

function displayOrderBy() {
  const hidePOElements = document.getElementsByClassName("hidePO");
  const selectDateElement = document.getElementById("selectDate");

  if (document.getElementById("nSIREN")) {
    if (document.getElementById("raisonSociale").value == "" && document.getElementById("nSIREN").value == "" && document.getElementById("nImp").value == "") {
      displayElements(hidePOElements, "none");
      selectDateElement.classList.remove("d-block");
      selectDateElement.classList.add("d-none");
    } else {
      displayElements(hidePOElements, "block");
      selectDateElement.classList.remove("d-none");
      selectDateElement.classList.add("d-block");
    }
  }
}

function addListener() {
  // Ajouter des écouteurs d'événements
  startDateElement.addEventListener("change", () => {
    choiceDateImpElement.value = "custom";
    updateAll();
  });
  endDateElement.addEventListener("change", () => {
    choiceDateImpElement.value = "custom";
    updateAll();
  });
  chartTypeElement.addEventListener("change", () => {
    toggleUnpaidCharts(chartTypeElement.value);
  });
  itemsPerPageElement.addEventListener("change", changeItemsPerPage);
  orderByElement.addEventListener("change", updateTable);
  searchButtonElement.addEventListener("click", updateAll);
  nImpElement.addEventListener("keyup", (event) => {
    if (event.key === "Enter") {
      event.preventDefault();
      searchButtonElement.click();
    }
  });
  resetButtonElement.addEventListener("click", () => {
    nImpElement.value = "";
    if (nSIRENElement) {
      nSIRENElement.value = "";
    }
    if (raisonSocialeElement) {
      raisonSocialeElement.value = "";
    }
    orderByElement.selectedIndex = 0;
    displayOrderBy();
    search();
  });
  if (nSIRENElement) {
    nSIRENElement.addEventListener("keyup", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("searchButton").click();
      }
    });
  }

  if (raisonSocialeElement) {
    raisonSocialeElement.addEventListener("keyup", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("searchButton").click();
      }
    });
  }


  choiceDateImpElement.addEventListener("change", function (event) {
    if (event.target.value == "4months") {
      startDateElement.value = new Date(new Date().setMonth(new Date().getMonth() - 4)).toISOString().split("T")[0];
      endDateElement.value = new Date().toISOString().split("T")[0];
    } else if (event.target.value == "12months") {
      startDateElement.value = new Date(new Date().setMonth(new Date().getMonth() - 12)).toISOString().split("T")[0];
      endDateElement.value = new Date().toISOString().split("T")[0];
    }
    updateAll();
  });
}

async function search() {
  startDate = startDateElement.value;
  endDate = endDateElement.value;
  order = orderByElement.value;
  nImp = nImpElement.value;
  nSIREN = nSIRENElement ? nSIRENElement.value : "";
  raisonSociale = raisonSocialeElement ? raisonSocialeElement.value : "";

  displayOrderBy();
  data = await getUnpaidsForEach(startDate, endDate, order, nImp, nSIREN, raisonSociale);
  console.log(data);
  updateTable(data);
}

function initializeImp() {
  // Par défaut, afficher le graphique à barres
  lineChartSection.style.display = "none";
  chartTypeElement.value = "bar";
  toggleUnpaidCharts("bar");

  addListener();
  displayOrderBy();

  search();
}

initializeImp();

