import "./styles/intermediatePage.scss";

setTimeout(function() {
    let imageId = document.getElementById('imageId');
    let imageIdValue = imageId.value;
    let redirectLink = "/admin/exhibition/" + imageIdValue;

    window.location.href = redirectLink;
}, 3000);