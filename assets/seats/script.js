const container = document.querySelector(".container");
const seats = document.querySelectorAll(".row .seat:not(.sold)");
const count = document.getElementById("count");
const total = document.getElementById("total");
const movieSelect = document.getElementById("movie");
let selectedValues = [];

populateUI();

let ticketPrice = +movieSelect.value;

// Save selected movie index and price
function setMovieData(movieIndex, moviePrice) {
  localStorage.setItem("selectedMovieIndex", movieIndex);
  localStorage.setItem("selectedMoviePrice", moviePrice);
}

// Update total and count
function updateSelectedCount() {
  const selectedSeats = document.querySelectorAll(".row .seat.selected:not(.booked)");

  // Check if the selectedSeats count exceeds the limit (5)
  if (selectedSeats.length > 5) {
    // Deselect the last selected seat
    selectedSeats[selectedSeats.length - 1].classList.remove("selected");
  }

  const validSelectedSeats = document.querySelectorAll(".row .seat.selected:not(.booked)");
  const seatsIndex = [...validSelectedSeats].map((seat) => [...seats].indexOf(seat));

  localStorage.setItem("selectedSeats", JSON.stringify(seatsIndex));

  const selectedSeatsCount = validSelectedSeats.length;

  count.innerText = selectedSeatsCount;
  total.innerText = selectedSeatsCount * ticketPrice;

  setMovieData(movieSelect.selectedIndex, movieSelect.value);

  // Update selected values
  selectedValues = [];
  validSelectedSeats.forEach((seat) => {
    const value = seat.getAttribute("data-value");
    selectedValues.push(value);
  });

  // Update selected values display
  let displayDiv = document.getElementById("selected-values");
  displayDiv.innerHTML = selectedValues.join(", ");
}

// Get data from local storage and populate UI
function populateUI() {
  let selectedSeats = JSON.parse(localStorage.getItem("selectedSeats"));

  // Clear selected seats by emptying the selectedSeats array
  selectedSeats = [];

  if (selectedSeats !== null && selectedSeats.length > 0) {
    selectedSeats.forEach((seatIndex) => {
      seats[seatIndex].classList.add("selected");
    });
  }

  const selectedMovieIndex = localStorage.getItem("selectedMovieIndex");

  if (selectedMovieIndex !== null) {
    movieSelect.selectedIndex = selectedMovieIndex;
  }
}

// Movie select event
movieSelect.addEventListener("change", (e) => {
  ticketPrice = +e.target.value;
  setMovieData(e.target.selectedIndex, e.target.value);
  updateSelectedCount();
});

// Seat click event
container.addEventListener("click", (e) => {
  if (
    e.target.classList.contains("seat") &&
    !e.target.classList.contains("sold") &&
    !e.target.classList.contains("booked")
  ) {
    const selectedSeats = document.querySelectorAll(".row .seat.selected:not(.booked)");

    if (selectedSeats.length >= 5 && !e.target.classList.contains("selected")) {
      // Show an alert
      iziToast.warning({
        iconUrl: '../img/alerticons/warning.png',
        message: 'You can only book up to 5 seats.',
        position: 'topRight',
      });
      return;
    }
    
    e.target.classList.toggle("selected");
    updateSelectedCount();
  }
});
