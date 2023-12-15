function exportChartToPDF(chartId, fileName, format, width, height) {
    const canvas = document.getElementById(chartId);
    const ctx = canvas.getContext('2d');

    // Ajoute de l'espace pour le titre et la date
    const titleHeight = 40; // Hauteur du titre
    const dateHeight = 20; // Hauteur de la date
    const exportWidth = width;
    const exportHeight = height + titleHeight + dateHeight;

    // Créer un nouveau canvas avec la taille spécifiée
    const exportCanvas = document.createElement('canvas');

    const exportCtx = exportCanvas.getContext('2d');

    const ratio = window.devicePixelRatio || 1;
    exportCanvas.width = exportWidth * ratio;
    exportCanvas.height = exportHeight * ratio;

    // Assurez-vous que le CSS taille est correct
    exportCanvas.style.width = exportWidth + 'px';
    exportCanvas.style.height = exportHeight + 'px';

    // Mettre à l'échelle le contexte du canvas pour correspondre à la densité de pixels de l'écran
    exportCtx.scale(ratio, ratio);

    // Dessine le titre et la date
    exportCtx.font = 'bold 16px Arial';
    exportCtx.fillText('Titre: ' + fileName, 10, titleHeight - 20);
    const currentDate = new Date().toLocaleDateString();
    exportCtx.font = '12px Arial';
    exportCtx.fillText('Date: ' + currentDate, 10, titleHeight);

    // Copie le contenu du graphique original sur le nouveau canvas
    exportCtx.drawImage(canvas, 0, titleHeight + dateHeight, width, height);

    if ((chartId === 'pieChart') && format === 'pdf') {
        // Exporte en PDF avec les couleurs du pie chart
        const element = document.createElement('div');
        element.appendChild(exportCanvas);
        html2pdf().from(element).save(fileName + '.pdf');
    } else if (format === 'pdf') {
        // Convertit le reste en noir pour les autres types de graphiques
        const imageData = exportCtx.getImageData(0, titleHeight + dateHeight, width, height);
        const data = imageData.data;

        exportCtx.putImageData(imageData, 0, titleHeight + dateHeight);

        // Exporte en PDF avec les couleurs mises à jour
        const element = document.createElement('div');
        element.appendChild(exportCanvas);
        html2pdf().from(element).save(fileName + '.pdf');
    }
}

function getTitle(startTitle) {
    let title = startTitle;
    if (document.getElementById("raisonSociale")) {
        const raisonSociale = document.getElementById("raisonSociale");
        if (raisonSociale.value !== "") {
            title += " DE L\'ENTREPRISE " + raisonSociale.value.toUpperCase();
        }
    }
    if (document.getElementById("nSIREN")) {
        const nSiren = document.getElementById("nSIREN");
        if (nSiren.value !== "") {
            title += " N°SIREN " + nSiren.value;
        }
    }
    if (document.getElementById("nImp")) {
        const nImp = document.getElementById("nImp");
        if (nImp.value !== "") {
            title += " DU DOSSIER IMPAYES " + nImp.value;
        }
    }
    if (title === startTitle) {
        title += " DE TOUS LES UTILISATEURS";
    }
    return title;
}

function exportChartToPDFWithTitle(chartId, startTitle, format, width, height) {
    exportChartToPDF(chartId, getTitle(startTitle), format, width, height);
}

function exportTableToCSV() {
    let csvContent = "data:text/csv;charset=utf-8,";

    // le titre et la date
    const fileName = 'tableau';
    const currentDate = new Date().toLocaleDateString();
    csvContent += 'Titre: ' + fileName + '\n';
    csvContent += 'Date: ' + currentDate + '\n';

    // Ajoute les en-têtes de colonnes au CSV
    const headers = Array.from(document.querySelectorAll('#table-container thead th')).map(th => th.textContent);
    csvContent += headers.join(',') + '\n';

    // Ajoute les données du tableau au CSV
    const rows = Array.from(document.querySelectorAll('#table-container tbody tr'));
    rows.forEach(row => {
        const cells = Array.from(row.querySelectorAll('td')).map(td => td.textContent);
        csvContent += cells.join(',') + '\n';
    });

    // Créer un lien de téléchargement pour le fichier CSV
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement('a');
    link.setAttribute('href', encodedUri);
    link.setAttribute('download', fileName + '.csv');
    document.body.appendChild(link);
    link.click();

}

function exportTableToXLS(data) {
    const workbook = XLSX.utils.book_new();
    const worksheet = XLSX.utils.table_to_sheet(document.getElementById('table-container'));

    // le titre et la date
    const fileName = 'tableau';
    const currentDate = new Date().toLocaleDateString();
    XLSX.utils.sheet_add_aoa(worksheet, [['Titre: ' + fileName], ['Date: ' + currentDate]], { origin: -1 });

    XLSX.utils.book_append_sheet(workbook, worksheet, 'Tableau');

    const xlsContent = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });

    const blob = new Blob([xlsContent], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
    const url = URL.createObjectURL(blob);

    const link = document.createElement('a');
    link.href = url;
    link.download = fileName + '.xlsx';
    document.body.appendChild(link);
    link.click();

    updateDataTable(data);
}

function exportDetailledTableToCSV(tableId) {
    let csvContent = "data:text/csv;charset=utf-8,";

    // le titre et la date
    const fileName = 'tableau';
    const currentDate = new Date().toLocaleDateString();
    csvContent += 'Titre: ' + fileName + '\n';
    csvContent += 'Date: ' + currentDate + '\n';

    const table = document.getElementById(tableId);
    // Ajoute les en-têtes de colonnes au CSV
    const headers = Array.from(table.getElementsByTagName('thead')[0].getElementsByTagName('th')).map(th => th.textContent);
    csvContent += headers.join(',') + '\n';

    // Ajoute les données du tableau au CSV
    const rows = Array.from(table.getElementsByTagName('tbody')[0].rows);
    const excludedRows = Array.from(document.querySelectorAll('.detailsRow'));
    rows.forEach(row => {
        if (!excludedRows.includes(row)) {
            console.log(row);
            const cells = Array.from(row.querySelectorAll('td')).map(td => td.textContent);
            csvContent += cells.join(',') + '\n';
        }
    });
    const selectedTable = Array.from(document.querySelectorAll('.collapse.show table'));
    selectedTable.forEach(subtable => {
        csvContent += '\n';
        const subHeaders = Array.from(subtable.querySelectorAll('thead th')).map(th => th.textContent);
        csvContent += subHeaders.join(',');
        const rows = Array.from(subtable.querySelectorAll('tbody tr'));
        rows.forEach(row => {
            const subcells = Array.from(row.querySelectorAll('td')).map(td => td.textContent);
            csvContent += subcells.join(',') + '\n';
        });
    });

    // Créer un lien de téléchargement pour le fichier CSV
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement('a');
    link.setAttribute('href', encodedUri);
    link.setAttribute('download', fileName + '.csv');
    document.body.appendChild(link);
    link.click();
}

function exportDetailledTableToXLS(tableId) {
    const tableData = getMainTableData(tableId);

    const workbook = XLSX.utils.book_new();
    const worksheet = XLSX.utils.aoa_to_sheet(tableData);

    // le titre et la date
    const fileName = 'tableau';
    const currentDate = new Date().toLocaleDateString();
    XLSX.utils.sheet_add_aoa(worksheet, [['Titre: ' + fileName], ['Date: ' + currentDate]], { origin: -1 });
    XLSX.utils.book_append_sheet(workbook, worksheet, 'Tableau');

    const selectedRows = Array.from(document.querySelectorAll('.collapse.show'));
    for (let i = 0; i < selectedRows.length; i++) {
        const row = selectedRows[i];
        const sheet = XLSX.utils.table_to_sheet(row.children[0]);
        XLSX.utils.book_append_sheet(workbook, sheet, row.id);
    }

    const xlsContent = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });

    const blob = new Blob([xlsContent], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
    const url = URL.createObjectURL(blob);

    const link = document.createElement('a');
    link.href = url;
    link.download = fileName + '.xlsx';
    document.body.appendChild(link);
    link.click();
}

function getMainTableData(tableId) {
    const table = document.getElementById(tableId);
    const thead = table.getElementsByTagName("thead")[0];
    const tbody = table.getElementsByTagName("tbody")[0];

    const excludedRows = Array.from(document.querySelectorAll('.detailsRow'));
    // Créer un tableau de données
    const tableData = [];

    tableData.push(getRowData(thead.rows[0]));

    // Parcourir les lignes du corps
    for (let i = 0; i < tbody.rows.length; i++) {
        const row = tbody.rows[i];
        if (!excludedRows.includes(row)) {
            tableData.push(getRowData(row));
        }
    }
}

function getRowData(row) {
    const rowData = [];
    for (let j = 0; j < row.cells.length; j++) {
        const cell = row.cells[j];
        rowData.push(cell.innerText);
    }
    return rowData;
}

function exportTableToPDF(nSiren) {
    // Ajoute de l'espace pour le titre et la date
    const titleHeight = 40; // Hauteur du titre
    const dateHeight = 20; // Hauteur de la date
    const exportWidth = 750;
    const exportHeight = 400 + titleHeight + dateHeight;
    // Dessine le titre et la date
    exportCtx.font = 'bold 16px Arial';
    exportCtx.fillText('Titre: ' + fileName, 10, titleHeight - 20);
    const currentDate = new Date().toLocaleDateString();
    exportCtx.font = '12px Arial';
    exportCtx.fillText('Date: ' + currentDate, 10, titleHeight);

}

function exportTable() {
    var selectElement = document.getElementById("export-select");
    var selectedValue = selectElement.value;


    if (selectedValue === "csv") {
        exportTableToCSV();
    } else if (selectedValue === "xls") {
        exportTableToXLS();
    } else if (selectedValue === "pdf") {
        const nSirenElement = document.getElementById("nSiren");
        if (nSirenElement && nSirenElement.value !== "") {
            var nSiren = nSirenElement.value;
        } else if (document.getElementById("numSiren")) {
            var nSiren = "";
        }
        exportTableToPDF(nSiren);
    }
}

function exportDetailledTable() {
    var selectElement = document.getElementById("export-select");
    var selectedValue = selectElement.value;

    if (selectedValue === "csv") {
        exportDetailledTableToCSV('table-container');
    } else if (selectedValue === "xls") {
        exportDetailledTableToXLS('table-container');
    }
}
