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
    let tooMuch = false;
    if (totalPages > 5) {
        tooMuch = true;
    }
    // Ajoute des boutons numérotés sans flèches
    for (let i = 1; i <= totalPages; i++) {
        if (tooMuch && i < totalPages-2 && i>2) {
            const dots = document.createElement('span');
            dots.textContent = '...';
            dots.setAttribute('class', 'pagination-dots');
            paginationContainer.appendChild(dots);
            i += totalPages - 4;
        }
        const button = document.createElement('button');
        button.textContent = i;

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

function createTable(data, tableId, AreCellsColored = false) {
    const tableContainer = document.getElementById(tableId);
    tableContainer.innerHTML = '';

 
    // Créer un tableau HTML
    const table = document.createElement('table');

    // Créer l'en-tête du tableau
    const thead = document.createElement('thead');
    const headerRow = document.createElement('tr');

    // Parcourir les clés de la première entrée pour créer les en-têtes de colonnes
    if (data.length !== 0){
        Object.keys(data[0]).forEach(key => {
            if (!/^\d+$/.test(key)) {
                const th = document.createElement('th');
                th.textContent = key.toString(); // Convertir la clé en chaîne de caractères
                headerRow.appendChild(th);
            }
        });
    }

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
                if (AreCellsColored && (key === 'montant' || key === 'Somme Impayés') ) {
                    const cellValue = parseFloat(value);
                    const roundedValue = Math.max(Math.round(cellValue / 100) * 100, -800); // Set maximum value to 800
                    cell.classList.add("amount"+roundedValue);
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
        let nbCol = row.getElementsByTagName('td').length+1;
        row.setAttribute('data-target', "#details".concat(nRemise));
        row.setAttribute('data-toggle', "collapse");
        row.setAttribute('aria-expanded', "false");
        row.setAttribute('aria-controls', "details".concat(nRemise));
        let detailCell = document.createElement('td');
        let detailButton = document.createElement('i');
        detailButton.setAttribute('class', 'fas fa-plus');
        detailCell.appendChild(detailButton);
        row.appendChild(detailCell);
        const newRow = await createRowWithDetails(nRemise, nbCol)
        row.insertAdjacentElement('afterend', newRow);
        createTableWithDetails(nRemise);
    }
    let headCell = document.createElement('th');
    const newText = document.createTextNode("DETAILS");
    headCell.appendChild(newText);
    document.getElementsByTagName('thead')[0].getElementsByTagName('tr')[0].appendChild(headCell);
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

async function updateDataTable(externdata, AreCellsColored = false) {
    data = externdata;
    const paginatedData = paginateTable(data, itemsPerPage);
    createTable(paginatedData, 'table-container', AreCellsColored);
    renderPagination(data, itemsPerPage);
    showResult();
    
}

async function updateDetailedDataTable(externdata) {
    details = true;
    updateDataTable(externdata);
    updateDetails(externdata);
}

export { updateDataTable, changeItemsPerPage, updateDetailedDataTable };