/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
import 'flowbite';


// JS Galery 

document.addEventListener('DOMContentLoaded', function() {
    let options = Array.from(document.querySelectorAll('.option'));
    let bullets = Array.from(document.querySelectorAll('.bullet'));

    const handleClick = (activeIndex) => {
        const visibleOptions = options.filter(option => window.getComputedStyle(option).display !== 'none');
        const activeOption = options[activeIndex];

// Rendre visible les images qui dépasse le breakpoint de résolution d'écran
        if (window.getComputedStyle(activeOption).display === 'none') {
            const randomVisibleIndex = visibleOptions.findIndex(option => window.getComputedStyle(option).display !== 'none');
            visibleOptions[randomVisibleIndex].style.display = 'none';
            activeOption.style.display = 'flex';
        }

        // Mise à jour des classes 'active' pour toutes les options et bullets
        options.forEach((option, index) => {
            if (option.style.display !== 'none') {
                if (index === activeIndex) {
                    option.classList.add('active');
                    bullets[index].classList.add('active');
                } else {
                    option.classList.remove('active');
                    bullets[index].classList.remove('active');
                }
            } else {
 // Si l'option est masquée, assure que le bullet correspondant est également désactivé
                option.classList.remove('active');
                bullets[index].classList.remove('active');
            }
        });
    };

    options.forEach((option, index) => {
        option.addEventListener('click', () => handleClick(index));
    });

    bullets.forEach((bullet, index) => {
        bullet.addEventListener('click', () => handleClick(index));
    });

    handleClick(0);
});

