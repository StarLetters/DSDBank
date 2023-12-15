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
    exportCanvas.width = exportWidth;
    exportCanvas.height = exportHeight;
    const exportCtx = exportCanvas.getContext('2d');

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

        // for (let i = 0; i < data.length; i += 4) {
        //     // Vérifie si le pixel est transparent (transparence = 0)
        //     if (data[i + 3] !== 0) {
        //         // Met à jour la couleur en noir (0, 0, 0)
        //         data[i] = 0; // Rouge
        //         data[i + 1] = 0; // Vert
        //         data[i + 2] = 0; // Bleu
        //     }
        // }

        exportCtx.putImageData(imageData, 0, titleHeight + dateHeight);

        // Exporte en PDF avec les couleurs mises à jour
        const element = document.createElement('div');
        element.appendChild(exportCanvas);
        html2pdf().from(element).save(fileName + '.pdf');
    }
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

function exportTableToXLS() {
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

function exportTableToPDF(tableId) {
    const title = "Mon tableau";
    const date = "Date : 01/03/2023";
    
    const element = document.getElementById(tableId);
    const options = {
      filename: 'mon-tableau.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'pt', format: 'a4', orientation: 'landscape' }
    };
  
    const content = `
    <style>
      #table-container {
        filter: grayscale(1);
      }

      td{
        color : black!important;
      }
    </style>
      <h1>${title}</h1>
      <p>${date}</p>
      ${element.innerHTML}
    `;
  
    html2pdf().set(options).from(content).save();
  }

function exportTable() {
    var selectElement = document.getElementById("export-select");
    var selectedValue = selectElement.value;

    if (selectedValue === "csv") {
        exportTableToCSV('table-container');
    } else if (selectedValue === "xls") {
        exportTableToXLS('table-container');
    } else if (selectedValue === "pdf") {
        exportTableToPDF("table-container");
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