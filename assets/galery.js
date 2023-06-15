import "./styles/galery.scss";

// Import ColorThief from the node modules
import ColorThief from "../node_modules/colorthief/dist/color-thief.mjs";

// Create a new ColorThief instance
const colorThief = new ColorThief();

// Function to convert NodeList to Array for all elements matching a given selector
const selectAll = (selector) => Array.from(document.querySelectorAll(selector));

// Initialize necessary variables
let options = []; // Array to store all options
let categoryButtons = []; // Array to store all category buttons
let bulletsContainer = null; // Variable to store bullets container element
let currentOptions = []; // Array to store currently selected options

// Function to check if the current device is a mobile device based on screen width
const isMobileDevice = () => window.innerWidth < 768;

// Function to handle click event on an option
const handleClick = (activeIndex) => {
    // Determine number of images to display based on device
    const visibleCount = isMobileDevice() ? 1 : 4;

    let previousOptions = [];
    let nextOptions = [];

    // The loop iterates for half of the visible count to determine the indices for the previous and next options
    for (let i = 1; i <= visibleCount / 2; i++) {
    // Calculate the index of the previous option taking into account the length of the array to avoid negative indices
        const previousIndex =
      (activeIndex - i + currentOptions.length) % currentOptions.length;
        // Calculate the index of the next option using modulo operator to wrap around if the end of the array is reached
        const nextIndex = (activeIndex + i) % currentOptions.length;
        // Add the previous option at the beginning of the previous Options array
        previousOptions.unshift(currentOptions[previousIndex]);
        // Add the next option at the end of the nextOptions array
        nextOptions.push(currentOptions[nextIndex]);
    }

    // Create an array of visible options which includes previous options, the current option, and next options
    const visibleOptions = [
        ...previousOptions,
        currentOptions[activeIndex],
        ...nextOptions,
    ];

    // Hide all options and disable their pointer events
    options.forEach((option) => {
        option.style.display = "none";
        option.style.pointerEvents = "none";
    });

    // Show visible options and enable their pointer events
    visibleOptions.forEach((option) => {
        option.style.display = "flex";
        option.style.pointerEvents = "auto";
    });

    // Set the active class on the current option and remove from others
    options.forEach((option) => {
        option.classList.toggle("active", option === currentOptions[activeIndex]);
    });

    // Set the active class on the current bullet and remove from others
    selectAll(".bullet").forEach((bullet, index) => {
        bullet.classList.toggle("active", index === activeIndex);
    });
};

// Function to generate bullets for the visible options
const generateBullets = (visibleOptions) => {
    bulletsContainer.innerHTML = ""; // Clear the bullets container

    // Create a bullet element for each visible option
    visibleOptions.forEach((_, index) => {
        const bullet = document.createElement("span");
        bullet.classList.add("bullet");
        bullet.dataset.index = index;
        bullet.addEventListener("click", () => handleClick(index));
        bulletsContainer.appendChild(bullet);
    });
};

// Function to handle option click events
const handleOptionClick = (option) => {
    option.addEventListener("click", (event) => {
        const currentOptionIndex = currentOptions.indexOf(option);
        // Get the index of the current option in the currentOptions array
        if (currentOptionIndex !== -1) {
            // Check if the option was found in currentOptions
            if (!option.classList.contains("active")) {
                // Check if the option does not already have the "active" class
                event.preventDefault();
                // Prevent the default click behavior of the option
                handleClick(currentOptionIndex);
                // Call the handleClick function with the index of the current option as an argument
            }
        }
    });
};

// Function to handle category button click events
const handleCategoryButtonClick = (button) => {
    button.addEventListener("click", function () {
    // When the button is clicked, execute the following function:

        const category = this.getAttribute("data-category");
        // Get the value of the "data-category" attribute from the clicked button
        // This determines the selected category

        const categoryOptions = options.filter(
            (option) => option.getAttribute("data-category") === category
        );
        // Filter the options based on their "data-category" attribute that matches the selected category

        currentOptions = categoryOptions;
        // Update the currentOptions array with the filtered category options

        generateBullets(categoryOptions);
        // Generate bullets for the visible category options

        handleClick(Math.floor(categoryOptions.length / 2));
    // Call the handleClick function with the index of the middle option as an argument
    });
};
// Add an event listener for the "load" event to the window.
// This event fires when the entire page, including all dependent resources such as stylesheets images, has been fully loaded.
window.addEventListener("load", function () {
    initialize(); // Call the initialization function.
});

// The main function that is called once the page is loaded.
function initialize() {
    // Select all elements with the class "option".
    options = selectAll(".option");

    // Select all elements with the class "category-button".
    categoryButtons = selectAll(".category-button");

    // Select the element with the class "bullet-navigation".
    bulletsContainer = document.querySelector(".bullet-navigation");

    // For each "option" element, prepare its background image.
    options.forEach((option) => prepareOptionBackground(option));

    // For each "option" element, handle its click event.
    options.forEach((option) => handleOptionClick(option));

    // For each "category-button" element, handle its click event.
    categoryButtons.forEach((button) => handleCategoryButtonClick(button));

    // Handle the initial category button click.
    handleInitialCategoryButton();
}

// Function to prepare the background of each Small .
function prepareOptionBackground(option) {
    // Get the computed style of the option element's background image.
    let backgroundImage = getComputedStyle(option).backgroundImage;

    // Extract the URL of the background image from the computed style.
    let imageUrl = backgroundImage
        .replace("url(", "")
        .replace(")", "")
        .replace(/"/g, "");

    // Create a new Image object.
    let smImgBackground = new Image();

    // Set the crossOrigin attribute to allow fetching the image data from a different origin.
    smImgBackground.crossOrigin = "anonymous";

    // Set the source of the image to the extracted URL.
    smImgBackground.src = imageUrl;

    // When the image is loaded, handle the image load.
    smImgBackground.onload = async function () {
        await addBackgroundOnSmallImage(smImgBackground, option);
    };
}

// Function to handle the load event of each image.
async function addBackgroundOnSmallImage(smImgBackground, option) {
    // Check if the image's natural width is less than 404 pixels.
    if (smImgBackground.naturalWidth < 404) {
    // If the image is small, apply certain styles to the option.
        styleOptionForSmallImage(option);

        // Hide the original image element.
        smImgBackground.style.display = "none";

        // Append the image element to the body of the document.
        document.body.appendChild(smImgBackground);

        // Use the ColorThief library to get the dominant color of the image.
        const dominantColor = await colorThief.getColor(smImgBackground);

        // Set the background color of the option to the dominant color of the image.
        option.style.backgroundColor = `rgba(${dominantColor[0]}, ${dominantColor[1]}, ${dominantColor[2]}, 1)`;
    }
}

// Function to style the option for small images.
function styleOptionForSmallImage(option) {
    // Set the background size of the option to "contain" to fit the image within the element.
    option.style.backgroundSize = "contain";

    // Set the background repeat of the option to "no-repeat" to prevent repetition of the image.
    option.style.backgroundRepeat = "no-repeat";

    // Set the background position of the option to "center" to center the image within the element.
    option.style.backgroundPosition = "center";
}

// Function to handle the initial click on the category button`
function handleInitialCategoryButton() {
    if (categoryButtons.length > 0) {
        categoryButtons[0].click();
    }
}

// After handling initial category buttons, handle navigation

// Select the navigation bar which contains category buttons
let nav = document.querySelector(".category-buttons");

// Create a new 'div' element which will represent the active line under the active category button
let line = document.createElement("div");

// Add class 'line' to this div element
line.className = "line";

// Append the created line to the navigation bar
nav.appendChild(line);

// Find the currently active category button
let active = nav.querySelector(".category-button.active");

// Initialize positions and width variables
let pos = 0;
let wid = 0;

if (active) {
    // If there is an active button, get its left offset and width
    pos = active.offsetLeft;
    wid = active.offsetWidth;

    // Set the left position and the width of the line to match the active button
    line.style.left = `${pos}px`;
    line.style.width = `${wid}px`;
}

// Add click event listeners to all category buttons
nav.querySelectorAll(".category-button").forEach((button) => {
    button.addEventListener("click", () => {
        if (!button.classList.contains("active")) {
            // If the clicked button is not currently active, remove 'active' class from all buttons
            nav.querySelectorAll(".category-button").forEach((btn) => {
                btn.classList.remove("active");
            });

            // Then add 'active' class to the clicked button
            button.classList.add("active");

            // Get the clicked button's left offset and width
            let position = button.offsetLeft;
            let width = button.offsetWidth;

            // Update the line's width and position with a smooth transition
            if (position >= pos) {
                // If the clicked button is to the right of the currently active one, increase the line's width first, then move it to the right
                line.style.width = `${position - pos + width}px`;
                setTimeout(() => {
                    line.style.width = `${width}px`;
                    line.style.left = `${position}px`;
                }, 300);
            } else {
                // If the clicked button is to the left of the currently active one, move the line to the left first, then decrease its width
                line.style.left = `${position}px`;
                line.style.width = `${pos - position + wid}px`;
                setTimeout(() => {
                    line.style.width = `${width}px`;
                }, 300);
            }
            // Update pos and wid for future reference
            pos = position;
            wid = width;
        }
    });
});
