let itemsPerPage = 3;
let currentPage = 1;
let data;


function changeItemsPerPage() {
    const selectElement = document.getElementById('items-per-page');
    itemsPerPage = parseInt(selectElement.value);

    const paginatedData = paginateTable(data, itemsPerPage);
    createTable(paginatedData);
    renderPagination(data, itemsPerPage);
    showResult();
}

function paginateTable(data, itemsPerPage) {
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedData = data.slice(startIndex, endIndex);
    return paginatedData;
}

function renderPagination(data, itemsPerPage) {
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
            const paginatedData = paginateTable(data, itemsPerPage);
            createTable(paginatedData);
            renderPagination(data, itemsPerPage);
            showResult();
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
    let nbResult = data.length - (currentPage * itemsPerPage) < 0 ? data.length - (currentPage - 1) * itemsPerPage : itemsPerPage;
    result.innerHTML = "Affichage de "+ nbResult +" sur "+ data.length+" résultats";
}



async function updateDataTable(externdata) {
    data = externdata 
    showResult();
    const paginatedData = paginateTable(data, itemsPerPage);
    createTable(paginatedData);
    renderPagination(data, itemsPerPage);
}



export { updateDataTable, changeItemsPerPage};