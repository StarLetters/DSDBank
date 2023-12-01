window.jsPDF = window.jspdf.jsPDF;

function exportChartToPDF(chartId, fileName) {
const canvas = document.getElementById(chartId);
const ctx = canvas.getContext('2d');

// Créer un nouvel objet jsPDF
const pdf = new jsPDF();

// Obtenir les dimensions du canvas
const canvasWidth = canvas.width;
const canvasHeight = canvas.height;

// Dimensions
const pdfWidth = 180; // Largeur du graphique dans le PDF
const pdfHeight = (canvasHeight / canvasWidth) * pdfWidth; // Hauteur du graphique dans le PDF

// Créer une image à partir des données du canvas avec les dimensions souhaitées
const imgData = canvas.toDataURL('image/png', 1.0);

// Ajoute l'image au PDF avec les dimensions souhaitées
pdf.addImage(imgData, 'PNG', 10, 10, pdfWidth, pdfHeight);

// Enregistre le PDF
pdf.save(fileName + '.pdf');
}