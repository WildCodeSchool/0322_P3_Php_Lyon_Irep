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

//------------------------display the image in full screen -----------------//
// Get the modal
let modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "title" text as a caption
let img = document.getElementById("myImg");
let modalImg = document.getElementById("img01");
let captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
