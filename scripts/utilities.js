function displayElements(elements, displayValue) {
  for (let i = 0; i < elements.length; i++) {
    elements[i].style.display = displayValue;
  }
}

function addRedClassToRowIfNegative(tableRows) {
  for (let i = 0; i < tableRows.length; i++) {
    const row = tableRows[i];
    const lastCellValue = parseFloat(row.lastElementChild.textContent);
    if (lastCellValue < 0) {
      row.classList.add("red");
    } else if (tableRows[i].classList.contains("red")) {
      tableRows[i].classList.remove("red");
    }
  }
}

export { displayElements, addRedClassToRowIfNegative };