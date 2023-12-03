function displayElements(elements, displayValue) {
    for (let i = 0; i < elements.length; i++) {
      elements[i].style.display = displayValue;
    }
  }


export { displayElements };