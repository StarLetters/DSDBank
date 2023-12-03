function exportData(chartId, fileName, format, width, height) {
    const canvas = document.getElementById(chartId);
    const ctx = canvas.getContext('2d');

    // Créer un nouveau canvas avec la taille spécifiée
    const exportCanvas = document.createElement('canvas');
    exportCanvas.width = width;
    exportCanvas.height = height;
    const exportCtx = exportCanvas.getContext('2d');

    // Copier le contenu du graphique original sur le nouveau canvas
    exportCtx.drawImage(canvas, 0, 0, width, height);

    if (format === 'pdf') {
        // Exporter en PDF
        const element = document.createElement('div');
        element.appendChild(exportCanvas);
        html2pdf().from(element).save(fileName + '.pdf');
    } else if (format === 'xls') {
        // Exporter en XLS
        const wb = XLSX.utils.table_to_book(document.getElementById(chartId));
        const wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'array' });
        saveAs(new Blob([wbout], { type: 'application/octet-stream' }), fileName + '.xlsx');
    } else if (format === 'csv') {
        // Exporter en CSV
        const table = document.getElementById(chartId);
        let csv = '';
        const rows = table.querySelectorAll('tr');

        rows.forEach((row) => {
            const cells = row.querySelectorAll('th, td');
            const rowData = Array.from(cells).map((cell) => cell.innerText);
            csv += rowData.join(',') + '\n';
        });

        const csvData = new Blob([csv], { type: 'text/csv;charset=utf-8' });
        saveAs(csvData, fileName + '.csv');
    }
}