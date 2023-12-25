function displayElements(elements, displayValue) {
  for (let i = 0; i < elements.length; i++) {
    elements[i].style.display = displayValue;
  }
}

async function addRedClassToCellIfNegative(tableRows, details = false) {
  for (let i = 0; i < tableRows.length; i++) {
    const row = tableRows[i];
    if (details && row.classList.contains("detailsRow")) {
      continue;
    }
    let lastCell = details ? row.lastElementChild.previousElementSibling : row.lastElementChild;

    let lastCellValue = parseFloat(lastCell.textContent);
    if (isNaN(lastCellValue)) {
      lastCell = row.lastElementChild;
      lastCellValue = parseFloat(lastCell.textContent);
    }
    if (lastCellValue < 0) {
      lastCell.classList.add("red");
    } else if (lastCell.classList.contains("red")) {
      lastCell.classList.remove("red");
    }
  }
}

function addColorToCells(tableRows) {

  for (let i = 0; i < tableRows.length; i++) {
    const row = tableRows[i];
    const lastCellValue = parseFloat(row.lastElementChild.textContent);

    const roundedValue = Math.round(lastCellValue / 100) * 100;
    row.lastElementChild.classList.add("amount" + roundedValue);
  }
}

export { displayElements, addRedClassToCellIfNegative, addColorToCells };