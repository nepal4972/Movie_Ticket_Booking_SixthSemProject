const menuLinks = document.querySelectorAll('.side-menu a');

// Add event listener to each menu link
menuLinks.forEach(link => {
  link.addEventListener('click', function() {
    // Remove 'active' class from all menu links
    menuLinks.forEach(link => {
      link.classList.remove('active');
    });

    // Add 'active' class to the clicked menu link
    this.classList.add('active');
  });
});

// Check current URL and set active menu link accordingly
const currentURL = window.location.href;
const currentURLWithoutExtension = currentURL.replace('.php', ''); // Remove the '.php' extension from the current URL
menuLinks.forEach(link => {
  const linkURLWithoutExtension = link.href.replace('.php', ''); // Remove the '.php' extension from each menu link URL
  if (linkURLWithoutExtension === currentURLWithoutExtension) {
    link.classList.add('active');
  }
});



function toggleSections() {
  var section1 = document.getElementById("section1");
  var section2 = document.getElementById("section2");

  section1.classList.toggle("hidden");
  section2.classList.toggle("hidden");
}


const openPopupButton = document.getElementById('open-popup');
const closePopupButton = document.getElementById('close-popup');
const popupOverlay = document.getElementById('popup-overlay');

openPopupButton.addEventListener('click', () => {
  popupOverlay.style.display = 'block';
});

closePopupButton.addEventListener('click', () => {
  popupOverlay.style.display = 'none';
});

