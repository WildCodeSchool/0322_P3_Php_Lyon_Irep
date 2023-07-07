import "./styles/picture_show.scss";
import Drift from "drift-zoom";

//zoom on the image on hover
const imgTrigger = document.body.querySelector('#my-picture');
const pane = document.body.querySelector('#zoom-img');
let driftInstance;
let isZoomEnabled = false; // Indicateur pour suivre l'état du zoom

function enableZoom() {
    if (!isZoomEnabled) {
        driftInstance = new Drift(imgTrigger, {
            paneContainer: pane
        });
        isZoomEnabled = true;
    }
}

function disableZoom() {
    if (isZoomEnabled) {
        driftInstance.destroy();
        driftInstance = null;
        isZoomEnabled = false;
    }
}

function handleResize() {
    if (window.innerWidth > 640 && !isZoomEnabled) {
        enableZoom();
    } else if (window.innerWidth <= 640 && isZoomEnabled) {
        disableZoom();
    }
}

function handleResizeEvent() {
    handleResize(); // Vérifier l'état initial lors du chargement de la page

    window.addEventListener('resize', () => {
        const wasZoomEnabled = isZoomEnabled; // Stocker l'état précédent
        handleResize(); // Vérifier l'état actuel

       
    });
}

handleResizeEvent();


// Get the modal
let modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "title" text as a caption
let img = document.getElementById("my-picture");
let modalImg = document.getElementById("img-modal");
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

// Modal tweeter

document.getElementById("openModalTweeter").addEventListener("click", function() {
    document.getElementById("modalTweeter").classList.remove("hidden");
});

document.getElementById("closeModalTweeter").addEventListener("click", function() {
    document.getElementById("modalTweeter").classList.add("hidden");
});

document.getElementById("modalTweeter").addEventListener("click", function(event) {
    if (event.target == document.getElementById("modalTweeter")) {
        document.getElementById("modalTweeter").classList.add("hidden");
    }
});