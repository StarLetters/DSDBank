import { changeItemsPerPage, updateDetailedDataTable } from "./dataTable.js";
import { getDiscount } from "./fetchData.js";
import { addRedClassToCellIfNegative } from "./utilities.js";

// Constantes pour les éléments HTML réutilisés
const itemsPerPageElement = document.getElementById("items-per-page");
const nSirenElement = document.getElementById("nSiren");
const nRemiseElement = document.getElementById("nRemise");
const resetButtonSirenElement = document.getElementById("resetButton-siren");
const resetButtonRemiseElement = document.getElementById("resetButton-remise");
const searchButtonSirenElement = document.getElementById("searchButton-siren");
const searchButtonRemiseElement = document.getElementById("searchButton-remise");
const orderByElement = document.getElementById("order-by");
const startDateElement = document.getElementById("startDate");
const endDateElement = document.getElementById("endDate");
const paginationElement = document.getElementById("pagination-container");

let startDate = startDateElement.value;
let endDate = endDateElement.value;


// Fonction pour mettre à jour le tableau
async function updateTable() {
    startDate = document.getElementById("startDate").value;
    endDate = document.getElementById("endDate").value;
    updateDetailedDataTable(await getDiscount(startDate, endDate));
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
        searchButtonSirenElement.addEventListener("click", () => {
            nRemiseElement.value = "";
            updateTable();
        });
        nSirenElement.addEventListener("keyup", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("searchButton-siren").click();
            }
        });
        resetButtonSirenElement.addEventListener("click", () => {
            nSirenElement.value = "";
        });
    }
    searchButtonRemiseElement.addEventListener("click", () => {
        if (nSirenElement) {
            nSirenElement.value = "";
        }
        updateTable();
    });
    nRemiseElement.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("searchButton-remise").click();
        }
    });
    resetButtonRemiseElement.addEventListener("click", () => {
        nRemiseElement.value = "";
    });
    orderByElement.addEventListener("change", updateTable);
    orderByElement.selectedIndex = 0;
    startDateElement.addEventListener("change", updateTable);
    endDateElement.addEventListener("change", updateTable);
}

function initializeDiscount() {
    addListener();
    updateTable();
}

initializeDiscount();