import "./styles/picture_show.scss";
import Drift from "drift-zoom";

//zoom on the image on hover
const imgTrigger = document.body.querySelector('#my-picture')
const pane = document.body.querySelector('#zoom-img')
new Drift(imgTrigger, {
    paneContainer: pane
})

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
