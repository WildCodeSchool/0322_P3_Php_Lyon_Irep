import "./styles/intermediatePage.scss";

setTimeout(function() {
    var imageId = document.getElementById('imageId');
    var imageIdValue = imageId.value;
    var redirectLink = "/admin/exhibition/" + imageIdValue;

    window.location.href = redirectLink;
}, 3000);