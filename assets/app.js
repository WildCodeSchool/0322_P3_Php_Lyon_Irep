import "./styles/app.scss";
import "./bootstrap";
import "flowbite";

function selectAll(selector) {
    return Array.from(document.querySelectorAll(selector));
}

let options = [];
let categoryButtons = [];
let bulletsContainer = null;
let currentOptions = [];

// Function to check if it's a mobile device based on screen width
const isMobileDevice = () => {
    return window.innerWidth < 768;
};

const handleClick = (activeIndex) => {
    // Use a single image on mobile, else 6 images.
    const visibleCount = isMobileDevice() ? 1 : 6;
    const visibleOptions = currentOptions.slice(activeIndex, activeIndex + visibleCount);

    while (visibleOptions.length < visibleCount) {
        visibleOptions.push(...currentOptions.slice(0, visibleCount - visibleOptions.length));
    }

    options.forEach((option) => {
        option.style.display = "none";
    });

    visibleOptions.forEach((option) => {
        option.style.display = "flex";
    });

    options.forEach((option) => {
        if (option === visibleOptions[0]) {
            option.classList.add("active");
        } else {
            option.classList.remove("active");
        }
    });

    selectAll(".bullet").forEach((bullet, index) => {
        if (index === activeIndex) {
            bullet.classList.add("active");
        } else {
            bullet.classList.remove("active");
        }
    });
};

const generateBullets = (visibleOptions) => {
    bulletsContainer.innerHTML = "";
    visibleOptions.forEach((_, index) => {
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

    options.forEach((option) => {
        option.addEventListener("click", () => {
            const currentOptionIndex = currentOptions.indexOf(option);
            if (currentOptionIndex !== -1) {
                handleClick(currentOptionIndex);
            }
        });
    });

    categoryButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const category = this.getAttribute("data-category");
            const categoryOptions = options.filter(
                (option) => option.getAttribute("data-category") === category
            );

            options.forEach((option) => {
                option.style.display = "none";
            });

            const visibleCount = isMobileDevice() ? 1 : 6;

            categoryOptions.slice(0, visibleCount).forEach((option) => {
                option.style.display = "flex";
            });

            currentOptions = categoryOptions;
            generateBullets(categoryOptions);

            handleClick(0);
        });

        if (button.dataset.firstCategory) {
            button.click();
        }
    });

    const initialCategoryButton = categoryButtons.find(
        (button) => button.dataset.firstCategory
    );
    if (initialCategoryButton) {
        initialCategoryButton.click();
    } else if (categoryButtons.length > 0) {
        categoryButtons[0].click();
    }
});
