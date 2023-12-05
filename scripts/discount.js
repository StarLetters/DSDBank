import { updateDataTable, changeItemsPerPage } from "./dataTable.js";
import { getDiscount } from "./fetchData.js";
import { addRedClassToRowIfNegative } from "./utilities.js";
import { updateIfChangingPage } from "./utilities.js";

// Constantes pour les éléments HTML réutilisés
const itemsPerPageElement = document.getElementById("items-per-page");
const nRemiseElement = document.getElementById("nRemise");
const resetButtonElement = document.getElementById("resetButton");
const searchButtonElement = document.getElementById("searchButton");


// Fonction pour mettre à jour le tableau
async function updateTable() {
    updateDataTable(await getDiscount());
    addRedClassToRowIfNegative(document.querySelectorAll("#table-container tbody tr"));
}

// Fonction pour ajouter des écouteurs d'évènements
async function addListener() {
    itemsPerPageElement.addEventListener("change", () => { changeItemsPerPage(); addRedClassToRowIfNegative(document.querySelectorAll("#table-container tbody tr")); });
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

function initializeDiscount() {
    addListener();
    updateTable();
    updateIfChangingPage();
}

initializeDiscount();