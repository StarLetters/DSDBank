import { getDiscountDetails } from "./fetchData.js";

let itemsPerPage = 3;
let currentPage = 1;
let details = false;
let data;
let nRemise = null;


function changeItemsPerPage() {
    const selectElement = document.getElementById('items-per-page');
    itemsPerPage = parseInt(selectElement.value);

    details ? updateDetailedDataTable(data) : updateDataTable(data);
}

function paginateTable(data, itemsPerPage) {
    if (itemsPerPage * (currentPage - 1) >= data.length) {
        currentPage = 1;
    }
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedData = data.slice(startIndex, endIndex);
    return paginatedData;
}

function renderPagination(data, itemsPerPage) {
    const paginationContainer = document.getElementById('pagination-container');
    paginationContainer.innerHTML = '';

    const totalPages = Math.ceil(data.length / itemsPerPage);
    // Ajoute des boutons numérotés avec flèches
    for (let i = 1; i <= totalPages; i++) {
        const button = document.createElement('button');

        if (i === 1) {
            button.innerHTML = '&larr;'; // Flèche gauche pour le premier bouton
        } else if (i === totalPages) {
            button.innerHTML = '&rarr;'; // Flèche droite pour le dernier bouton
        } else {
            button.textContent = i;
        }

        button.classList.add('pagination-button');
        if (i === currentPage) {
            button.disabled = true;
        }

        button.addEventListener('click', () => {
            currentPage = i;
            details ? updateDetailedDataTable(data) : updateDataTable(data, 'table-container');
        });
        paginationContainer.appendChild(button);
    }
}

function createTable(data, tableId) {
    const tableContainer = document.getElementById(tableId);
    tableContainer.innerHTML = '';

    // Créer un tableau HTML
    const table = document.createElement('table');

    // Créer l'en-tête du tableau
    const thead = document.createElement('thead');
    const headerRow = document.createElement('tr');

    // Parcourir les clés de la première entrée pour créer les en-têtes de colonnes
    Object.keys(data[0]).forEach(key => {
        if (!/^\d+$/.test(key)) {
            const th = document.createElement('th');
            th.textContent = key.toString(); // Convertir la clé en chaîne de caractères
            headerRow.appendChild(th);
        }
    });

    thead.appendChild(headerRow);
    table.appendChild(thead);

    // Créer le corps du tableau
    const tbody = document.createElement('tbody');

    // Parcourir les données JSON et créer les lignes du tableau
    data.forEach(item => {
        const row = document.createElement('tr');

        // Parcourir les valeurs de chaque entrée pour créer les cellules de données
        Object.entries(item).forEach(([key, value]) => {
            if (!/^\d+$/.test(key)) {
                const cell = document.createElement('td');

                // Ajoute une classe en fonction du montant
                if (key === 'montant') {
                    if (parseFloat(value) > 0) {
                        cell.classList.add('positive-amount');
                    } else if (parseFloat(value) < 0) {
                        cell.classList.add('negative-amount');
                    }
                }

                cell.textContent = value;
                if (key === 'N° Remise') {
                    row.setAttribute('id', value); // Ajouter l'attribut id pour la correspondance avec les détails de la remise
                }
                cell.setAttribute('data-label', key); // Ajoute l'attribut data-th pour la correspondance avec les en-têtes de colonnes
                row.appendChild(cell);
            }
        });

        tbody.appendChild(row);
    });

    table.appendChild(tbody);

    // Ajoute le tableau au document
    tableContainer.appendChild(table);
}

async function updateDetails(data) {
    for (let i = 0; i < data.length; i++) {
        nRemise = data[i]['N° Remise'];
        let row = document.getElementById(nRemise);
        if (row === null) {
            continue;
        }
        let nbCol = row.getElementsByTagName('td').length;
        row.setAttribute('data-target', "#details".concat(nRemise));
        row.setAttribute('data-toggle', "collapse");
        row.setAttribute('aria-expanded', "false");
        row.setAttribute('aria-controls', "details".concat(nRemise));
        const newRow = await createRowWithDetails(nRemise, nbCol)
        row.insertAdjacentElement('afterend', newRow);
        createTableWithDetails(nRemise);
    }
}

async function createRowWithDetails(nRemise, nbCol) {
    const newRow = document.createElement('tr');
    newRow.setAttribute('class', 'detailsRow');
    newRow.setAttribute('id', 'detailsRow'.concat(nRemise));
    const cell = newRow.insertCell(0);
    cell.setAttribute('colspan', nbCol);
    const div = document.createElement('div');
    div.setAttribute('id', 'details'.concat(nRemise));
    div.setAttribute('class', 'collapse');
    cell.appendChild(div);
    return newRow;
}

async function createTableWithDetails(nRemise) {
    createTable(await getDiscountDetails(nRemise), 'details'.concat(nRemise));
}


function showResult() {
    const result = document.getElementById("results-container");
    let nbResult = data.length - (currentPage * itemsPerPage) < 0 ? data.length - (currentPage - 1) * itemsPerPage : itemsPerPage;
    result.innerHTML = "Affichage de " + nbResult + " sur " + data.length + " résultats";
}

async function updateDataTable(externdata) {
    data = externdata;
    const paginatedData = paginateTable(data, itemsPerPage);
    createTable(paginatedData, 'table-container');
    renderPagination(data, itemsPerPage);
    showResult();
}

async function updateDetailedDataTable(externdata) {
    details = true;
    updateDataTable(externdata);
    updateDetails(externdata);
}

export { updateDataTable, changeItemsPerPage, updateDetailedDataTable };