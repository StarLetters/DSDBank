import { changeItemsPerPage, updateDetailedDataTable } from "./dataTable.js";
import { getDiscount, getDiscountDetails } from "./fetchData.js";
import { addRedClassToRowIfNegative, displayElements } from "./utilities.js";

// Constantes pour les éléments HTML réutilisés
const itemsPerPageElement = document.getElementById("items-per-page");
const nRemiseElement = document.getElementById("nRemise");
const resetButtonElement = document.getElementById("resetButton");
const searchButtonElement = document.getElementById("searchButton");


// Fonction pour mettre à jour le tableau
async function updateTable() {
    updateDetailedDataTable(await getDiscount(), await getDiscountDetails());
    addRedClassToRowIfNegative(document.querySelectorAll("#table-container tbody tr"));
}

// Fonction pour ajouter des écouteurs d'évènements
async function addListener() {
    itemsPerPageElement.addEventListener("change", () => {
        changeItemsPerPage();
        addRedClassToRowIfNegative(document.querySelectorAll("#table-container tbody tr")); });
    searchButtonElement.addEventListener("click", updateTable);
    if (nRemiseElement) {
        nRemiseElement.addEventListener("keyup", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("searchButton").click();
            }
        });
    }
    resetButtonElement.addEventListener("click", () => {
        if (nRemiseElement) {
            nRemiseElement.value = "";
        }
    });
}

function initializeDiscount() {
    addListener();
    updateTable();
}

initializeDiscount();