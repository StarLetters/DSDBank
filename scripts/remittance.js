import { changeItemsPerPage, updateDetailedDataTable } from "./dataTable.js";
import { getDiscount } from "./fetchData.js";
import { addRedClassToCellIfNegative } from "./utilities.js";

// Constantes pour les éléments HTML réutilisés
const itemsPerPageElement = document.getElementById("items-per-page");
const nSirenElement = document.getElementById("nSIREN");
const raisonElement = document.getElementById("raisonSociale");
const nRemiseElement = document.getElementById("nRemise");

const resetButtonElement = document.getElementById("resetButton");
const searchButtonElement = document.getElementById("searchButton");

const orderByElement = document.getElementById("order-by");
const startDateElement = document.getElementById("startDate");
const endDateElement = document.getElementById("endDate");
const paginationElement = document.getElementById("pagination-container");


// Fonction pour mettre à jour le tableau
async function updateTable() {
    let startDate = startDateElement.value;
    let endDate = endDateElement.value;
    let order = orderByElement.value
    updateDetailedDataTable(await getDiscount(startDate, endDate, order));
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
    searchButtonElement.addEventListener("click", updateTable);
    resetButtonElement.addEventListener("click", () => {
        if (nSirenElement) {
            nSirenElement.value = "";
        }
        if (raisonElement) {
          raisonElement.value = "";
        }
        if (nRemiseElement) {
            nRemiseElement.value = "";
        }
        searchButtonElement.click();
      });
    if (nSirenElement) {
        nSirenElement.addEventListener("keyup", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                searchButtonElement.click();
            }
        });
    }
    if (raisonElement) {
        raisonElement.addEventListener("keyup", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                searchButtonElement.click();
            }
        });
    }
    nRemiseElement.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            searchButtonElement.click();
        }
    });
    orderByElement.addEventListener("change", updateTable);
    startDateElement.addEventListener("change", updateTable);
    endDateElement.addEventListener("change", updateTable);
}

function initializeDiscount() {
    addListener();
    updateTable();
}

initializeDiscount();