function exportTableToPDF(chartId, fileName, format, width, height) {
    const canvas = document.getElementById(chartId);
    const ctx = canvas.getContext('2d');

    // Ajoute de l'espace pour le titre et la date
    const titleHeight = 40; // Hauteur du titre
    const dateHeight = 20; // Hauteur de la date
    const exportWidth = width * 6;
    const exportHeight = (height + titleHeight + dateHeight) * 2; // Double la hauteur pour une meilleure résolution

    // Détermine les dimensions du canvas exporté avec une légère réduction de taille
    const exportCanvasWidth = exportWidth * 0.30; // Réduit la largeur 
    const exportCanvasHeight = exportHeight;

    // Créer un nouveau canvas avec les dimensions réduites
    const exportCanvas = document.createElement('canvas');
    exportCanvas.width = exportCanvasWidth;
    exportCanvas.height = exportCanvasHeight;
    const exportCtx = exportCanvas.getContext('2d');

    // Dessine le titre et la date
    exportCtx.font = 'bold 16px Arial';
    exportCtx.fillText('Titre: ' + fileName, 10, titleHeight - 20);
    const currentDate = new Date().toLocaleDateString();
    exportCtx.font = '12px Arial';
    exportCtx.fillText('Date: ' + currentDate, 10, titleHeight);

    // Dézoome légèrement le graphique en ajustant les coordonnées de la fonction drawImage()
    const zoomFactor = 3.3; // Facteur de dézoom
    const zoomedWidth = width * zoomFactor;
    const zoomedHeight = height * zoomFactor;
    const xOffset = 0; // Décalage de 0 pour l'axe des x
    const yOffset = (height - zoomedHeight) / 2;

    exportCtx.drawImage(canvas, xOffset, titleHeight + dateHeight + yOffset, zoomedWidth, zoomedHeight, 0, titleHeight + dateHeight, exportCanvasWidth, exportCanvasHeight);

    if (chartId === 'pieChart') {
        if (format ==='pdf') {
            // Exporte en PDF 
            const element = document.createElement('div');
            element.appendChild(exportCanvas);
            html2pdf().from(element).save(fileName + '.pdf');
        }
    } else {
        const imageData = exportCtx.getImageData(0, 0, exportCanvasWidth, exportCanvasHeight);
        const data = imageData.data;

        for (let i = 0; i < data.length; i += 4) {
            // Met à jour la couleur en noir (0, 0, 0)
            data[i] = 0; // Rouge
            data[i + 1] = 0; // Vert
            data[i + 2] = 0; // Bleu
        }

        exportCtx.putImageData(imageData, 0, 0);

        if (format === 'pdf') {
            // Exporte en PDF 
            const element = document.createElement('div');
            element.appendChild(exportCanvas);
            html2pdf().from(element).save(fileName + '.pdf');
        }
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

function exportTable() {
    var selectElement = document.getElementById("export-select");
    var selectedValue = selectElement.value;
    
    if (selectedValue === "csv") {
      exportTableToCSV('table-container');
    } else if (selectedValue === "xls") {
      exportTableToXLS('table-container');
    }
}

const exportButton = document.getElementById('export-button');
exportButton.addEventListener('click', () => {
    exportTableToCSV(data);
    exportTableToXLS(data);
});


