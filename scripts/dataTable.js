// return : Liste comprenant les valeurs de chaque mois
function getStatsFromServer() {
    console.log("Fetch stats from server");
    fetch('../api/statistics.php')
        .then(response => response.json())
        .then(data => {return data;})
        .catch(error => {
            console.error(error);
        });
    }

/* SELECT i.*
FROM Impaye i, Transaction t, Utilisateur u 
WHERE i.idTransaction = t.idTransaction
AND t.idUtilisateur = 34; */

function createTable(data){
    {
        // Créer un tableau HTML
    let table = document.createElement('table');

    // Créer l'en-tête du tableau
    let thead = document.createElement('thead');
    let headerRow = document.createElement('tr');
    
    // Parcourir les clés de la première entrée pour créer les en-têtes de colonnes
    Object.keys(data[0]).forEach(key => {
        let th = document.createElement('th');
        th.textContent = key;
        headerRow.appendChild(th);
    });

    thead.appendChild(headerRow);
    table.appendChild(thead);

    // Créer le corps du tableau
    let tbody = document.createElement('tbody');

    // Parcourir les données JSON et créer les lignes du tableau
    data.forEach(item => {
        let row = document.createElement('tr');

        // Parcourir les valeurs de chaque entrée pour créer les cellules de données
        Object.values(item).forEach(value => {
            let cell = document.createElement('td');
            cell.textContent = value;
            row.appendChild(cell);
        });

        tbody.appendChild(row);
    });

    table.appendChild(tbody);

    // Ajouter le tableau au document
    let tableContainer = document.getElementById('table-container');
    tableContainer.appendChild(table);
{
        // Créer un tableau HTML
    let table = document.createElement('table');

    // Créer l'en-tête du tableau
    let thead = document.createElement('thead');
    let headerRow = document.createElement('tr');
    
    // Parcourir les clés de la première entrée pour créer les en-têtes de colonnes
    Object.keys(data[0]).forEach(key => {
        let th = document.createElement('th');
        th.textContent = key;
        headerRow.appendChild(th);
    });

    thead.appendChild(headerRow);
    table.appendChild(thead);

    // Créer le corps du tableau
    let tbody = document.createElement('tbody');

    // Parcourir les données JSON et créer les lignes du tableau
    data.forEach(item => {
        let row = document.createElement('tr');

        // Parcourir les valeurs de chaque entrée pour créer les cellules de données
        Object.values(item).forEach(value => {
            let cell = document.createElement('td');
            cell.textContent = value;
            row.appendChild(cell);
        });

        tbody.appendChild(row);
    });

    table.appendChild(tbody);

    // Ajouter le tableau au document
    let tableContainer = document.getElementById('table-container');
    tableContainer.appendChild(table);

    }
    }
}


export {getDataFromServer};