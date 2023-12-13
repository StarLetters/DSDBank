import { changeItemsPerPage, updateDetailedDataTable } from "./dataTable.js";
import { getDiscount } from "./fetchData.js";
import { addRedClassToCellIfNegative } from "./utilities.js";

// Constantes pour les éléments HTML réutilisés
let role = document.getElementById("role").textContent;

const itemsPerPageElement = document.getElementById("items-per-page");
const nSirenElement = document.getElementById("nSiren");
const resetButtonElement = document.getElementById("resetButton");
const searchButtonElement = document.getElementById("searchButton");

const paginationElement = document.getElementById("pagination-container");
const closeButtonElement = document.getElementById("details-close");

let email = null;
if (role === "0") {
    email = document.getElementById("profile-email").textContent;
}

// Fonction pour mettre à jour le tableau
async function updateTable() {
    updateDetailedDataTable(await getDiscount(email));
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
    if (role === "1") {
        searchButtonElement.addEventListener("click", updateTable);
        if (nSirenElement) {
            nSirenElement.addEventListener("keyup", function (event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    document.getElementById("searchButton").click();
                }
            });
        }
        resetButtonElement.addEventListener("click", () => {
            if (nSirenElement) {
                nSirenElement.value = "";
            }
        });
    }
}

function initializeDiscount() {
    addListener();
    updateTable();
}

initializeDiscount();