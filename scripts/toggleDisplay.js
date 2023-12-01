import { toggleCharts } from "./graphic.js";
import { updateTable, changeItemsPerPage, search } from "./dataTable.js";

function updateAll() {
  search();
  toggleCharts(document.getElementById("chartType").value);
}



// Par défaut, cacher le graphique à courbe
const lineChartSection = document.getElementById("lineChartSection");
lineChartSection.style.display = "none";

// Ajouter des écouteurs d'événements
document.getElementById("startDate").addEventListener("change", updateAll);
document.getElementById("endDate").addEventListener("change", updateAll);
document.getElementById("chartType").addEventListener("change", function () {
  toggleCharts(this.value);
});
document.getElementById("items-per-page").addEventListener("change", changeItemsPerPage);
document.getElementById("order-by").addEventListener("change", updateTable);
document.getElementById("searchButton").addEventListener("click", updateAll);
document.getElementById("nImp").addEventListener("keyup", function (event) {
  if (event.key === "Enter") {
    event.preventDefault();
    document.getElementById("searchButton").click();
  }
});
document.getElementById("resetButton").addEventListener("click", function () {
  document.getElementById("nImp").value = "";
  const nSIRENElement = document.getElementById("nSIREN");
  const raisonSocialeElement = document.getElementById("raisonSociale");
  if (nSIRENElement) {
    nSIRENElement.value = "";
  }
  if (raisonSocialeElement) {
    raisonSocialeElement.value = "";
  }
  search();
}
);
document.getElementById("nSIREN") ? document.getElementById("nSIREN").addEventListener("keyup", function (event) {
  if (event.key === "Enter") {
    event.preventDefault();
    document.getElementById("searchButton").click();
  }
}) : null;

document.getElementById("raisonSociale") ? document.getElementById("raisonSociale").addEventListener("keyup", function (event) {
  if (event.key === "Enter") {
    event.preventDefault();
    document.getElementById("searchButton").click();
  }
}) : null;

document.getElementById("nSIREN") ? console.log("nSIREN") : console.log("pas nSIREN");
document.getElementById("nSIREN") ? document.getElementById("graphics").style.display = "none" : document.getElementById("graphics").style.display = "block";
document.getElementById("nSIREN") ? document.getElementById("datevente").style.display = "none" : document.getElementById("datevente").style.display = "block";

// Par défaut, afficher le graphique à barres
document.getElementById("chartType").value = "bar";
toggleCharts("bar");

search();