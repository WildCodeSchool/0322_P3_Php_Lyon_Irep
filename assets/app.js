/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.scss";

// start the Stimulus application
import "./bootstrap";
import "flowbite";
// Utility function to simplify NodeList to Array conversion
function selectAll(selector) {
    return Array.from(document.querySelectorAll(selector));
}

// JS Gallery
document.addEventListener("DOMContentLoaded", function () {
    let options = selectAll(".option");
    let categoryButtons = selectAll(".category-button");
    let bulletsContainer = document.querySelector(".bullet-navigation");

    const handleClick = (activeIndex) => {
        options.forEach((option, index) => {
            if (index === activeIndex) {
                option.classList.add("active");
            } else {
                option.classList.remove("active");
            }
        });
    };

    options.forEach((option, index) => {
        option.addEventListener("click", () => handleClick(index));
    });

    function generateBullets(visibleOptions) {
        bulletsContainer.innerHTML = ""; // Supprimer les bullet points existants

        visibleOptions.forEach((option, index) => {
            const bullet = document.createElement("span");
            bullet.classList.add("bullet");
            bullet.dataset.index = options.indexOf(option);
            bullet.addEventListener("click", () =>
                handleClick(options.indexOf(option))
            );
            bulletsContainer.appendChild(bullet);
        });
    }

    function showFirstImage(category) {
        const visibleOptions = options.filter((option) => {
            return (
                option.getAttribute("data-category") === category &&
        window.getComputedStyle(option).display !== "none"
            );
        });

        if (visibleOptions.length > 0) {
            const firstOption = visibleOptions[0];
            const firstOptionIndex = options.indexOf(firstOption);
            handleClick(firstOptionIndex);
        }
    }

    categoryButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const category = this.getAttribute("data-category");
            const categoryOptions = options.filter(
                (option) => option.getAttribute("data-category") === category
            );

            options.forEach((option) => {
                option.style.display = "none";
            });

            categoryOptions.slice(0, 6).forEach((option) => {
                option.style.display = "flex";
            });

            generateBullets(categoryOptions);
            showFirstImage(category);
        });

        // Cliquez sur le premier bouton de catégorie pour afficher la première catégorie
        if (button.dataset.firstCategory) {
            button.click();
        }
    });

    // Générer les bullet points initialement
    const initialCategoryButton = categoryButtons.find(
        (button) => button.dataset.firstCategory
    );
    if (initialCategoryButton) {
        initialCategoryButton.click();
    } else if (categoryButtons.length > 0) {
        categoryButtons[0].click();
    }
});
