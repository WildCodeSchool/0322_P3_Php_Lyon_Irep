// Import styles and dependencies
import "./styles/app.scss";
import "./bootstrap";
import "flowbite";

// Function to select all elements that match a given selector
function selectAll(selector) {
    return Array.from(document.querySelectorAll(selector));
}

// Initialize variables
let options = []; // Array to store all options
let categoryButtons = []; // Array to store all category buttons
let bulletsContainer = null; // Variable to store bullets container element
let currentOptions = []; // Array to store currently selected options

// Function to check if it's a mobile device based on screen width
const isMobileDevice = () => {
    return window.innerWidth < 768;
};

// Function to handle click event on an option
const handleClick = (activeIndex) => {
    // Use a single image on mobile, else 6 images.
    const visibleCount = isMobileDevice() ? 1 : 6;
    const visibleOptions = currentOptions.slice(activeIndex, activeIndex + visibleCount);

    // If there are not enough visible options, wrap around to the beginning
    while (visibleOptions.length < visibleCount) {
        visibleOptions.push(...currentOptions.slice(0, visibleCount - visibleOptions.length));
    }

    // Hide all options
    options.forEach((option) => {
        option.style.display = "none";
    });

    // Show visible options
    visibleOptions.forEach((option) => {
        option.style.display = "flex";
    });

    // Set the active class on the current option
    options.forEach((option) => {
        if (option === visibleOptions[0]) {
            option.classList.add("active");
        } else {
            option.classList.remove("active");
        }
    });

    // Set the active class on the current bullet
    selectAll(".bullet").forEach((bullet, index) => {
        if (index === activeIndex) {
            bullet.classList.add("active");
        } else {
            bullet.classList.remove("active");
        }
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

// Run the code when the DOM content is loaded
document.addEventListener("DOMContentLoaded", function () {
    options = selectAll(".option"); // Select all elements with class "option"
    categoryButtons = selectAll(".category-button"); // Select all elements with class "category-button"
    bulletsContainer = document.querySelector(".bullet-navigation"); // Select the bullets container element

    // Add click event listeners to each option
    options.forEach((option) => {
        option.addEventListener("click", () => {
            const currentOptionIndex = currentOptions.indexOf(option);
            if (currentOptionIndex !== -1) {
                handleClick(currentOptionIndex);
            }
        });
    });

    // Add click event listeners to each category button
    categoryButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const category = this.getAttribute("data-category");
            const categoryOptions = options.filter(
                (option) => option.getAttribute("data-category") === category
            );

            // Hide all options
            options.forEach((option) => {
                option.style.display = "none";
            });

            const visibleCount = isMobileDevice() ? 1 : 6;

            // Show the first few options from the selected category
            categoryOptions.slice(0, visibleCount).forEach((option) => {
                option.style.display = "flex";
            });

            currentOptions = categoryOptions;
            generateBullets(categoryOptions);

            handleClick(Math.max(0, categoryOptions.length - 2));
        });

        // Click the button with the "data-first-category" attribute
        if (button.dataset.firstCategory) {
            button.click();
        }
    });

    // Click the initial category button if available
    const initialCategoryButton = categoryButtons.find(
        (button) => button.dataset.firstCategory
    );
    if (initialCategoryButton) {
        initialCategoryButton.click();
    } else if (categoryButtons.length > 0) {
        categoryButtons[0].click();
    }
});
