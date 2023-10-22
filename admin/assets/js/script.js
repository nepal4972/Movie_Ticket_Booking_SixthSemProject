const menuLinks = document.querySelectorAll('.side-menu a');

menuLinks.forEach(link => {
  link.addEventListener('click', function() {
    menuLinks.forEach(link => {
      link.classList.remove('active');
    });

    this.classList.add('active');
  });
});

const currentURL = window.location.href;
const currentURLWithoutExtension = currentURL.replace('.php', '');
menuLinks.forEach(link => {
  const linkURLWithoutExtension = link.href.replace('.php', '');
  if (linkURLWithoutExtension === currentURLWithoutExtension) {
    link.classList.add('active');
  }
});



function toggleSections() {
  var section1 = document.getElementById("section1");
  var section2 = document.getElementById("section2");
  
  section1.classList.toggle("hidden");
  section2.classList.toggle("hidden");

  localStorage.setItem("sectionState", section2.classList.contains("hidden") ? "section1" : "section2");
}

const sectionState = localStorage.getItem("sectionState");

if (sectionState === "section2") {
  // If section2 was toggled, show it
  document.getElementById("section1").classList.add("hidden");
  document.getElementById("section2").classList.remove("hidden");
}





