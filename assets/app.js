import "./styles/app.scss";
import "./bootstrap";
import "flowbite";

// Helper function to select elements
function selectAll(selector) {
    return Array.from(document.querySelectorAll(selector));
}

let options = [];
let categoryButtons = [];
let bulletsContainer = null;
let currentOptions = [];

// Function to handle click event
const handleClick = (activeIndex) => {
    // Create a new array of visible options starting with the clicked option
    const visibleOptions = currentOptions.slice(activeIndex, activeIndex + 6);

    // If there are less than 6 options, fill in the rest with options from the start
    while (visibleOptions.length < 6) {
        visibleOptions.push(...currentOptions.slice(0, 6 - visibleOptions.length));
    }

    // Hide all options
    options.forEach((option) => {
        option.style.display = "none";
    });

    // Display the visible options
    visibleOptions.forEach((option) => {
        option.style.display = "flex";
    });

    // Highlight the active option
    options.forEach((option) => {
        if (option === visibleOptions[0]) {
            option.classList.add("active");
        } else {
            option.classList.remove("active");
        }
    });

    // Highlight the active bullet
    selectAll(".bullet").forEach((bullet, index) => {
        if (index === activeIndex) {
            bullet.classList.add("active");
        } else {
            bullet.classList.remove("active");
        }
    });
};

// Function to generate bullet navigation
const generateBullets = (visibleOptions) => {
    bulletsContainer.innerHTML = "";
    visibleOptions.forEach((index) => {
        const bullet = document.createElement("span");
        bullet.classList.add("bullet");
        bullet.dataset.index = index;
        bullet.addEventListener("click", () => handleClick(index));
        bulletsContainer.appendChild(bullet);
    });
};

document.addEventListener("DOMContentLoaded", function () {
    options = selectAll(".option");
    categoryButtons = selectAll(".category-button");
    bulletsContainer = document.querySelector(".bullet-navigation");

    // Add click event listeners to options
    options.forEach((option) => {
        option.addEventListener("click", () => {
            const currentOptionIndex = currentOptions.indexOf(option);
            if (currentOptionIndex !== -1) {
                handleClick(currentOptionIndex);
            }
        });
    });

    // Add click event listeners to category buttons
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

            // Display the first 6 options in this category
            categoryOptions.slice(0, 6).forEach((option) => {
                option.style.display = "flex";
            });

            // Update currentOptions and generate bullets
            currentOptions = categoryOptions;
            generateBullets(categoryOptions);

            // Handle click on the first option in this category
            handleClick(0);
        });

        // Click on the first category
        if (button.dataset.firstCategory) {
            button.click();
        }
    });

    // Click on the initial category
    const initialCategoryButton = categoryButtons.find(
        (button) => button.dataset.firstCategory
    );
    if (initialCategoryButton) {
        initialCategoryButton.click();
    } else if (categoryButtons.length > 0) {
        categoryButtons[0].click();
    }
});
