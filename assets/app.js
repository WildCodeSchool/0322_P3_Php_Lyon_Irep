// Import styles and dependencies
import "./styles/app.scss";
import "./bootstrap";
import "flowbite";
import Drift from "drift-zoom";

// Activate the dropdown menu language only on click
document.getElementById('dropdownHoverButton').addEventListener('click', function() {
    document.getElementById('dropdownHover').classList.toggle('hidden');
});

// Animation to hide the navbar when scrolldown
let lastScrollTop = 0;
const navbar = document.querySelector('.custom-navbar');

window.addEventListener("scroll", () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
        navbar.style.transition = '0.5s';
        navbar.style.transform = 'translateY(-100%)';
    } else {
        navbar.style.transition = '0.5s';
        navbar.style.transform = 'translateY(0%)';
    }
    lastScrollTop = scrollTop;
});

//zoom on the image on hover
const imgTrigger = document.body.querySelector('#my-picture')
const pane = document.body.querySelector('#zoom-img')
new Drift(imgTrigger, {
    paneContainer: pane
})
