// Import styles and dependencies
import "./styles/app.scss";
import "./bootstrap";
import "flowbite";

// Activate the dropdown menu language only on click
document.getElementById('dropdownHoverButton').addEventListener('click', function() {
    document.getElementById('dropdownHover').classList.toggle('hidden');
});

// Animation to hide the navbar when scrolldown
let lastScrollTop = 0;
const navbar = document.querySelector('.custom-navbar');

window.addEventListener("scroll", () => {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
        navbar.style.transition = '0.5s';
        navbar.style.transform = 'translateY(-100%)';
    } else {
        navbar.style.transition = '0.5s';
        navbar.style.transform = 'translateY(0%)';
    }
    lastScrollTop = scrollTop;
});

// Newsletter confirmation of subscription

const toast = document.getElementById('toast-success');
let form = document.getElementById('newsletter').innerHTML;
const url = '/';

form.addEventListener('submit', function(event){ 
    event.preventDefault();

    fetch (url,{
        method: "POST",
    })

        .then(response => {
            if(response.status != 200 ) alert("Erreur");
        

            toast.style.display = 'block';

            setTimeout(function() {
                toast.style.display = 'none';
            }, 5000);
        });
});

