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


// Gallery Js

document.addEventListener('DOMContentLoaded', function() {
    let options = document.querySelectorAll('.option');
  
    options.forEach(function(option) {
        option.addEventListener('click', function() {
            options.forEach(function(option) {
                option.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
});
  