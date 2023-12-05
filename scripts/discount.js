import { updateDataTable, changeItemsPerPage } from "./dataTable.js";
import { getDiscount } from "./fetchData.js";

// Constantes pour les éléments HTML réutilisés
const itemsPerPageElement = document.getElementById("items-per-page");
const nSIRENElement = document.getElementById("nSIREN");
const resetButtonElement = document.getElementById("resetButton");
const searchButtonElement = document.getElementById("searchButton");


// Fonction pour mettre à jour le tableau
async function updateTable() {
    updateDataTable(await getDiscount());
    addRedClassToLastRowIfNegative();
}
function addRedClassToLastRowIfNegative() {
    const tableRows = document.querySelectorAll("#table-container tbody tr");
    const lastRow = tableRows[tableRows.length - 1];
    const lastCellValue = parseFloat(lastRow.lastElementChild.textContent);

    if (lastCellValue < 0) {
        lastRow.classList.add("red");
    }
}


// Fonction pour ajouter des écouteurs d'évènements
async function addListener(){
itemsPerPageElement.addEventListener("change", ()=>{changeItemsPerPage(); addRedClassToLastRowIfNegative();});
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
    }
});
}

function initializeDiscount(){
    addListener();
    updateTable();
}

initializeDiscount();