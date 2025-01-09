// Initialize Lenis
const lenis = new Lenis();

// Use requestAnimationFrame to continuously update the scroll
function raf(time) {
  lenis.raf(time);
  requestAnimationFrame(raf);
}

requestAnimationFrame(raf);

document.querySelectorAll('a.smooth-scroll').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
      e.preventDefault();

      document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
      });
  });
});


let button_left = document.getElementById('button_left');
let button_right = document.getElementById('button_right');
let carrousselOeuvre = document.getElementById('carrousselpepite');

if (button_left && button_right && carrousselOeuvre) {
    button_left.addEventListener('click', function() {
        carrousselOeuvre.scrollBy({
            left: -carrousselOeuvre.clientWidth * 0.16,
            behavior: 'smooth'
        });
    });

    button_right.addEventListener('click', function() {
        carrousselOeuvre.scrollBy({
            left: carrousselOeuvre.clientWidth * 0.16,
            behavior: 'smooth'
        });
    });
} else {
    console.error('One or more elements not found for carrousselpepite:', {
        button_left,
        button_right,
        carrousselOeuvre
    });
}

// Carrousel pour carrousselartiste
let bLeftArtiste = document.getElementById('bLeftArtiste');
let bRightArtiste = document.getElementById('bRightArtiste');
let carrousselArtiste = document.getElementById('carrousselartiste');

if (bLeftArtiste && bRightArtiste && carrousselArtiste) {
    bLeftArtiste.addEventListener('click', function() {
        carrousselArtiste.scrollBy({
            left: -carrousselArtiste.clientWidth * 0.16,
            behavior: 'smooth'
        });
    });

    bRightArtiste.addEventListener('click', function() {
        carrousselArtiste.scrollBy({
            left: carrousselArtiste.clientWidth * 0.16,
            behavior: 'smooth'
        });
    });
} else {
    console.error('One or more elements not found for carrousselartiste:', {
        bLeftArtiste,
        bRightArtiste,
        carrousselArtiste
    });
}

// Carrousel pour carrousselcollaborate
let bLeftFiche = document.getElementById('bLeftFiche');
let bRightFiche = document.getElementById('bRightFiche');
let carrousselCollaborate = document.getElementById('carrousselCollab');

if (bLeftFiche && bRightFiche && carrousselCollaborate) {
    bLeftFiche.addEventListener('click', function() {
        carrousselCollaborate.scrollBy({
            left: -carrousselCollaborate.clientWidth * 0.25,
            behavior: 'smooth'
        });
    });

    bRightFiche.addEventListener('click', function() {
        carrousselCollaborate.scrollBy({
            left: carrousselCollaborate.clientWidth * 0.25,
            behavior: 'smooth'
        });
    });
} else {
    console.error('One or more elements not found for carrousselcollaborate:', {
        bLeftFiche,
        bRightFiche,
        carrousselCollaborate
    });
}