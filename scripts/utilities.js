function displayElements(elements, displayValue) {
  for (let i = 0; i < elements.length; i++) {
    elements[i].style.display = displayValue;
  }
}

function addRedClassToCellIfNegative(tableRows) {
  for (let i = 0; i < tableRows.length; i++) {
    const row = tableRows[i];
    const lastCellValue = parseFloat(row.lastElementChild.textContent);
    if (lastCellValue < 0) {
      row.lastElementChild.classList.add("red");
    } else if (tableRows[i].lastElementChild.classList.contains("red")) {
      tableRows[i].lastElementChild.classList.remove("red");
    }
  }
}

export { displayElements, addRedClassToCellIfNegative };