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
    // Obtain the coordinates and dimensions of the crop
    const cropData = cropper.getData();

    // Create a canvas element to draw the crop
    const canvas = document.createElement('canvas');
    const context = canvas.getContext('2d');

    // Defining the canvas dimensions according to the crop
    canvas.width = cropData.width;
    canvas.height = cropData.height;

    // Draw the crop on the canvas
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

    // Convert canvas to base64
    const croppedImageBase64 = canvas.toDataURL();

    // Send the cropped image to the server
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/picture/upload-crop', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
   

    // Create an object containing the image ID and data
    const data = {
        id: id,
        croppedImage: croppedImageBase64
    };

    xhr.send(JSON.stringify(data));
});