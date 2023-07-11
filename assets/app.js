// Import styles and dependencies
import "./styles/app.scss";
import "./bootstrap";
import "flowbite";



document.addEventListener('click', function(event) {
    var burgerMenu = document.getElementById('navbar-hamburger');
    var isClickInsideMenu = burgerMenu.contains(event.target);
    var isClickOnBurgerButton = document.querySelector('[data-collapse-toggle="navbar-hamburger"]').contains(event.target);

    if (!isClickInsideMenu && !isClickOnBurgerButton) {
        burgerMenu.classList.add('hidden');
    }
});

document.querySelector('[data-collapse-toggle="navbar-hamburger"]').addEventListener('click', function() {
    var burgerMenu = document.getElementById('navbar-hamburger');
    burgerMenu.classList.toggle('hidden');
});

