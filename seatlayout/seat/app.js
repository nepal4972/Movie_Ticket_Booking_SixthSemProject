let selectedValues = [];

// add click event listener to each box
let boxes = document.querySelectorAll('.seat');
boxes.forEach(seat => {
  seat.addEventListener('click', function() {
    let value = this.getAttribute('data-value');
    let index = selectedValues.indexOf(value);
    
    if (index === -1) {
      // value is not in array, add it
      selectedValues.push(value);
      this.classList.add('selected');
    } else {
      // value is already in array, remove it
      selectedValues.splice(index, 1);
      this.classList.remove('selected');
    }
    
    // update selected values display
    let displayDiv = document.getElementById('selected-values');
    displayDiv.innerHTML = selectedValues.join(', ');
  });
});