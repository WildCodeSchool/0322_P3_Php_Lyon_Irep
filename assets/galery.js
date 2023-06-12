// Import ColorThief from the node modules
import ColorThief from '../node_modules/colorthief/dist/color-thief.mjs';

// Create a new ColorThief instance
const colorThief = new ColorThief();

// Function to convert NodeList to Array for all elements matching a given selector
function selectAll(selector) {
    return Array.from(document.querySelectorAll(selector));
}

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

    // Determine the indices for the previous and next options
    for(let i = 1; i <= visibleCount / 2; i++) {
        const previousIndex = (activeIndex - i + currentOptions.length) % currentOptions.length;
        const nextIndex = (activeIndex + i) % currentOptions.length;
        previousOptions.unshift(currentOptions[previousIndex]);
        nextOptions.push(currentOptions[nextIndex]);
    }

    const visibleOptions = [...previousOptions, currentOptions[activeIndex], ...nextOptions];

    // Hide all options and disable their pointer events
    options.forEach(option => {
        option.style.display = "none";
        option.style.pointerEvents = "none";
    });

    // Show visible options and enable their pointer events
    visibleOptions.forEach(option => {
        option.style.display = "flex";
        option.style.pointerEvents = "auto";
    });

    // Set the active class on the current option and remove from others
    options.forEach(option => {
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

// Add event listener for DOMContentLoaded
document.addEventListener("DOMContentLoaded", function () {
    options = selectAll(".option"); // Select all elements with class "option"
    categoryButtons = selectAll(".category-button"); // Select all elements with class "category-button"
    bulletsContainer = document.querySelector(".bullet-navigation"); // Select the bullets container element

    options.forEach(option => {
        let backgroundImage = getComputedStyle(option).backgroundImage;
        let imageUrl = backgroundImage.replace('url(', '').replace(')', '').replace(/"/g, '');

        let testImg = new Image();
        testImg.crossOrigin = "anonymous";
        testImg.src = imageUrl;
    
        // When picture is loaded
        testImg.onload = async function() {
            if(testImg.naturalWidth < 404) {
                option.style.backgroundSize = 'contain';
                option.style.backgroundRepeat = 'no-repeat';
                option.style.backgroundPosition = 'center';
                testImg.style.display = 'none';
                document.body.appendChild(testImg);

                const dominantColor = await colorThief.getColor(testImg);

                option.style.backgroundImage = `${backgroundImage}, linear-gradient(to right, rgba(${dominantColor[0]},${dominantColor[1]},${dominantColor[2]},1) 50%, rgba(${dominantColor[0]},${dominantColor[1]},${dominantColor[2]},0.5) 100%), linear-gradient(to left, rgba(${dominantColor[0]},${dominantColor[1]},${dominantColor[2]},1) 50%, rgba(${dominantColor[0]},${dominantColor[1]},${dominantColor[2]},0.5) 100%)`;
                
            }
        };
    });

    // Add click event listeners to each option
    options.forEach(option => {
        option.addEventListener("click", event => {
            const currentOptionIndex = currentOptions.indexOf(option);
            if (currentOptionIndex !== -1) {
                if (!option.classList.contains("active")) {
                    event.preventDefault();
                    handleClick(currentOptionIndex);
                }
            }
        });
    });

    // Add click event listeners to each category button
    categoryButtons.forEach(button => {
        button.addEventListener("click", function () {
            const category = this.getAttribute("data-category");
            const categoryOptions = options.filter(option => option.getAttribute("data-category") === category);

            // Hide all options
            options.forEach(option => {
                option.style.display = "none";
            });

            const visibleCount = isMobileDevice() ? 1 : 6;

            // Show the first few options from the selected category
            categoryOptions.slice(0, visibleCount).forEach(option => {
                option.style.display = "flex";
            });

            currentOptions = categoryOptions;
            generateBullets(categoryOptions);

            handleClick(Math.floor(categoryOptions.length / 2));
        });

        if (button.dataset.firstCategory) {
            button.click();
        }
    });
    // Find the first category button that has a "data-first-category" attribute
    const initialCategoryButton = categoryButtons.find(button => button.dataset.firstCategory);

    if (initialCategoryButton) {
    // If such button exists, simulate a click on it
        initialCategoryButton.click();
    } else if (categoryButtons.length > 0) {
    // If there is no "first category" button but there are other category buttons, simulate a click on the first one of them
        categoryButtons[0].click();
    }
// Close the DOMContentLoaded event listener
});

// After handling initial category buttons, handle navigation

// Select the navigation bar which contains category buttons
let nav = document.querySelector('.category-buttons');

// Create a new 'div' element which will represent the active line under the active category button
let line = document.createElement('div');

// Add class 'line' to this div element
line.className = 'line';

// Append the created line to the navigation bar
nav.appendChild(line);

// Find the currently active category button
let active = nav.querySelector('.category-button.active');

// Initialize positions and width variables
let pos = 0;
let wid = 0;

if(active) {
    // If there is an active button, get its left offset and width
    pos = active.offsetLeft;
    wid = active.offsetWidth;

    // Set the left position and the width of the line to match the active button
    line.style.left = `${pos}px`;
    line.style.width = `${wid}px`;
}

// Add click event listeners to all category buttons
nav.querySelectorAll('.category-button').forEach(button => {
    button.addEventListener('click', (e) => {
        // Prevent the default action of the click
        e.preventDefault();
        
        if(!button.classList.contains('active')) {
            // If the clicked button is not currently active, remove 'active' class from all buttons
            nav.querySelectorAll('.category-button').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Then add 'active' class to the clicked button
            button.classList.add('active');

            // Get the clicked button's left offset and width
            let position = button.offsetLeft;
            let width = button.offsetWidth;
            
            // Update the line's width and position with a smooth transition
            if(position >= pos) {
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
