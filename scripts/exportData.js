function exportTableToPDF(chartId, fileName, format, width, height) {
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

    if (format === 'pdf') {
        // Exporte en PDF 
        const element = document.createElement('div');
        element.appendChild(exportCanvas);
        html2pdf().from(element).save(fileName + '.pdf');
    }
}

function exportTableToCSV(data) {
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

    updateDataTable(data);
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

const exportButton = document.getElementById('export-button');
exportButton.addEventListener('click', () => {
    exportTableToCSV(data);
    exportTableToXLS(data);
});


