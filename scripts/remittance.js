import { changeItemsPerPage, updateDetailedDataTable } from "./dataTable.js";
import { getDiscount } from "./fetchData.js";
import { addRedClassToCellIfNegative } from "./utilities.js";

// Constantes pour les éléments HTML réutilisés
const itemsPerPageElement = document.getElementById("items-per-page");
const nSirenElement = document.getElementById("nSiren");
const resetButtonElement = document.getElementById("resetButton");
const searchButtonElement = document.getElementById("searchButton");

const paginationElement = document.getElementById("pagination-container");
const closeButtonElement = document.getElementById("details-close");


// Fonction pour mettre à jour le tableau
async function updateTable() {
    updateDetailedDataTable(await getDiscount());
    addRedClassToCellIfNegative(document.querySelectorAll("#table-container tbody tr"));
}

// Fonction pour ajouter des écouteurs d'évènements
async function addListener() {
    itemsPerPageElement.addEventListener("change", () => {
        changeItemsPerPage();
        addRedClassToCellIfNegative(document.querySelectorAll("#table-container tbody tr"));
    });
    paginationElement.addEventListener("click", () => {
        addRedClassToCellIfNegative(document.querySelectorAll("#table-container tbody tr"));
    });
    if (nSirenElement) {
        searchButtonElement.addEventListener("click", updateTable);
        nSirenElement.addEventListener("keyup", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("searchButton").click();
            }
        });
        resetButtonElement.addEventListener("click", () => {
            nSirenElement.value = "";
        });
    }
}

function initializeDiscount() {
    addListener();
    updateTable();
}

initializeDiscount();