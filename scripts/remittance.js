import { changeItemsPerPage, updateDetailedDataTable } from "./dataTable.js";
import { getDiscount } from "./fetchData.js";
import { addRedClassToCellIfNegative } from "./utilities.js";

// Constantes pour les éléments HTML réutilisés
const itemsPerPageElement = document.getElementById("items-per-page");
const nSirenElement = document.getElementById("nSiren");
const raisonElement = document.getElementById("raison");
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
      });
    if (nSirenElement) {
        nSirenElement.addEventListener("click", () => {
            nRemiseElement.value = "";
            raisonElement.value = "";
        });
        nSirenElement.addEventListener("keyup", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("searchButton").click();
            }
        });
    }
    if (raisonElement) {
        raisonElement.addEventListener("click", () => {
            nSirenElement.value = "";
            nRemiseElement.value = "";
        });
        raisonElement.addEventListener("keyup", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("searchButton").click();
            }
        });
    }
    if (raisonElement && nSirenElement) {
        nSirenElement.addEventListener("click", () => {
            nRemiseElement.value = "";
            raisonElement.value = "";
        });
        nSirenElement.addEventListener("keyup", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("searchButton").click();
            }
        });
        raisonElement.addEventListener("click", () => {
            nSirenElement.value = "";
            nRemiseElement.value = "";
        });
        raisonElement.addEventListener("keyup", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("searchButton").click();
            }
        });
        nRemiseElement.addEventListener("click", () => {
            nSirenElement.value = "";
            raisonElement.value="";
        });
    }
    nRemiseElement.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("searchButton").click();
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