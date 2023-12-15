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
            var nSiren = ;
        }
        exportTableToPDF(nSiren);
    } 
}
/*
const exportButton = document.getElementById('export-button');
exportButton.addEventListener('click', () => {
    exportTableToCSV(data);
    exportTableToXLS(data);
});
*/

