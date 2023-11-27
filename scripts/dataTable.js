import { getUnpaidsForEach } from "./fetchData.js";

let itemsPerPage = 3;
let currentPage = 1;
let startDate = document.getElementById("startDate").value;
let endDate = document.getElementById("endDate").value;
let order = document.getElementById("order-by").value;
let data = await getUnpaidsForEach(startDate, endDate, order);
let nImp = document.getElementById("nImp").value;
let raisonSociale = document.getElementById("raisonSociale") ? document.getElementById("raisonSociale").value : "";
let nSIREN = document.getElementById("nSIREN") ? document.getElementById("nSIREN").value : "";

function changeItemsPerPage() {
    const selectElement = document.getElementById('items-per-page');
    itemsPerPage = parseInt(selectElement.value);

    const paginatedData = paginateTable(data, itemsPerPage, currentPage);
    createTable(paginatedData);
    renderPagination(data, itemsPerPage, currentPage);
}

function paginateTable(data, itemsPerPage, currentPage) {
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedData = data.slice(startIndex, endIndex);
    return paginatedData;
}

function renderPagination(data, itemsPerPage, currentPage) {
    const paginationContainer = document.getElementById('pagination-container');
    paginationContainer.innerHTML = '';

    const totalPages = Math.ceil(data.length / itemsPerPage);

    for (let i = 1; i <= totalPages; i++) {
        const button = document.createElement('button');
        button.textContent = i;
        button.classList.add('pagination-button');
        if (i === currentPage) {
            button.disabled = true;
        }
        button.addEventListener('click', () => {
            currentPage = i;
            const paginatedData = paginateTable(data, itemsPerPage, currentPage);
            createTable(paginatedData);
            renderPagination(data, itemsPerPage, currentPage);
        });
        paginationContainer.appendChild(button);
    }
}


function createTable(data) {

    let tableContainer = document.getElementById('table-container');
    tableContainer.innerHTML = '';

    // Créer un tableau HTML
    let table = document.createElement('table');

    // Créer l'en-tête du tableau
    let thead = document.createElement('thead');
    let headerRow = document.createElement('tr');

    // Parcourir les clés de la première entrée pour créer les en-têtes de colonnes
    Object.keys(data[0]).forEach(key => {
        if (!/^\d+$/.test(key)) {
            let th = document.createElement('th');
            th.textContent = key.toString(); // Convertir la clé en chaîne de caractères
            headerRow.appendChild(th);
        }
    });

    thead.appendChild(headerRow);
    table.appendChild(thead);

    // Créer le corps du tableau
    let tbody = document.createElement('tbody');

    // Parcourir les données JSON et créer les lignes du tableau
    data.forEach(item => {
        let row = document.createElement('tr');

        // Parcourir les valeurs de chaque entrée pour créer les cellules de données
        Object.entries(item).forEach(([key, value]) => {
            if (!/^\d+$/.test(key)) {
                let cell = document.createElement('td');
                cell.textContent = value;
                cell.setAttribute('data-label', key); // Ajouter l'attribut data-th pour la correspondance avec les en-têtes de colonnes
                row.appendChild(cell);
            }
        });

        tbody.appendChild(row);
    });

    table.appendChild(tbody);

    // Ajouter le tableau au document

    tableContainer.appendChild(table);
}

function showResult() {
    let result = document.getElementById("results-container");
    result.innerHTML = "Nombre d'impayés : " + data.length;
}

// Fonction pour mettre à jour le tableau et les graphiques
async function updateTable() {
    startDate = document.getElementById("startDate").value;
    endDate = document.getElementById("endDate").value;
    order = document.getElementById("order-by").value;
    data = await getUnpaidsForEach(startDate, endDate, order, nImp, nSIREN, raisonSociale);

    updateDataTable(data);
}

async function updateDataTable(data) {
    showResult();
    const paginatedData = paginateTable(data, itemsPerPage, currentPage);
    createTable(paginatedData);
    renderPagination(data, itemsPerPage, currentPage);
}

async function search() {
    startDate = document.getElementById("startDate").value;
    endDate = document.getElementById("endDate").value;
    order = document.getElementById("order-by").value;
    nImp = document.getElementById("nImp").value;
    nSIREN = document.getElementById("nSIREN") ? document.getElementById("nSIREN").value : "";
    raisonSociale = document.getElementById("raisonSociale") ? document.getElementById("raisonSociale").value : "";

    if (nSIREN != "" || raisonSociale != "") {
        document.getElementById("graphics").style.display = "block";
        document.getElementById("datevente").style.display = "block";
        document.getElementById("orderSiren").style.display = "none";
    }else if (document.getElementById("nSIREN")){
        document.getElementById("graphics").style.display = "none";
        document.getElementById("datevente").style.display = "none";
        document.getElementById("orderSiren").style.display = "block";
    }
    data = await getUnpaidsForEach(startDate, endDate, order, nImp, nSIREN, raisonSociale);
    console.log(data);
    updateTable(data);
}

export { updateTable, changeItemsPerPage, search };