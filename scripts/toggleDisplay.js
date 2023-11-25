import { toggleCharts } from "./graphic.js";
import { updateTable, changeItemsPerPage, search } from "./dataTable.js";

function updateAll() {
  updateTable();
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
document.getElementById("searchButton").addEventListener("click", search);
document.getElementById("nImp").addEventListener("keyup", function (event) {
  if (event.key === "Enter") {
    event.preventDefault();
    document.getElementById("searchButton").click();
  }
});
document.getElementById("resetButton").addEventListener("click", function () {
  document.getElementById("nImp").value = "";
  search();
}
);


// Par défaut, afficher le graphique à barres
document.getElementById("chartType").value = "bar";
toggleCharts("bar");

updateTable();