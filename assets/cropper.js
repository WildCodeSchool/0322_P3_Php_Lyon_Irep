import "./styles/cropper.scss";
import "cropperjs/dist/cropper.css";
import Cropper from 'cropperjs';

const image = document.getElementById('image-cropped');
const id = image.dataset.id;
const cropper = new Cropper(image, {
    aspectRatio: 640 / 443,
    cropBoxResizable: false,
    cropBoxMovable: true,
    minCropBoxWidth: 640,
    minCropBoxHeight: 443,
    maxCropBoxWidth: 640,
    maxCropBoxHeight: 443,
    crop(event) {
        
    },
});

const saveCropButton = document.getElementById('save-crop-button');
saveCropButton.addEventListener('click', () => {
    // Obtenir les coordonnées et les dimensions de la crop
    const cropData = cropper.getData();

    // Créer un élément canvas pour dessiner la crop
    const canvas = document.createElement('canvas');
    const context = canvas.getContext('2d');

    // Définir les dimensions du canvas en fonction de la crop
    canvas.width = cropData.width;
    canvas.height = cropData.height;

    // Dessiner la crop sur le canvas
    context.drawImage(
        image,
        cropData.x,
        cropData.y,
        cropData.width,
        cropData.height,
        0,
        0,
        cropData.width,
        cropData.height
    );

    // Convertir le canvas en base64
    const croppedImageBase64 = canvas.toDataURL();

    // Envoyer l'image recadrée au serveur
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/picture/upload-crop', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
   

    // Créer un objet contenant l'ID et les données de l'image
    const data = {
        id: id,
        croppedImage: croppedImageBase64
    };

    xhr.send(JSON.stringify(data));
});