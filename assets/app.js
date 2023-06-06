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

function selectAll(selector) {
    return Array.from(document.querySelectorAll(selector));
}

// JS Gallery
document.addEventListener("DOMContentLoaded", function () {
    let options = selectAll(".option");
    let categoryButtons = selectAll(".category-button");
    let bulletsContainer = document.querySelector(".bullet-navigation");

    const handleClick = (activeIndex) => {
        const category = options[activeIndex].getAttribute("data-category");
        const categoryOptions = options.filter(
            (option) => option.getAttribute("data-category") === category
        );
        const startIndex = categoryOptions.indexOf(options[activeIndex]);

        // hide all options
        options.forEach((option) => {
            option.style.display = "none";
        });

        // show selected option and next 5 options in the category
        let imagesToDisplay = categoryOptions.slice(startIndex, startIndex + 6);

        // If there are less than 6 images, add from the start of the list
        while (imagesToDisplay.length < 6) {
            imagesToDisplay = imagesToDisplay.concat(
                categoryOptions.slice(0, 6 - imagesToDisplay.length)
            );
        }

        imagesToDisplay.forEach((option) => {
            option.style.display = "flex";
        });

        //highlight the selected option
        options.forEach((option, index) => {
            if (index === activeIndex) {
                option.classList.add("active");
            } else {
                option.classList.remove("active");
            }
        });

        //Highlight the slected bullet
        selectAll(".bullet").forEach((bullet, index) => {
            if (index === activeIndex) {
                bullet.classList.add("active");
            } else {
                bullet.classList.remove("active");
            }
        });
    };

    options.forEach((option, index) => {
        option.addEventListener("click", () => handleClick(index));
    });

    function generateBullets(visibleOptions) {
        bulletsContainer.innerHTML = ""; // Supprimer les bullet points existants

        visibleOptions.forEach((option) => {
            const bullet = document.createElement("span");
            bullet.classList.add("bullet");
            bullet.dataset.index = options.indexOf(option);
            bullet.addEventListener("click", () =>
                handleClick(options.indexOf(option))
            );
            bulletsContainer.appendChild(bullet);
        });
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
            handleClick(options.indexOf(categoryOptions[0]));
        });

        // Click on first button of category
        if (button.dataset.firstCategory) {
            button.click();
        }
    });

    // Generate Bullepoint
    const initialCategoryButton = categoryButtons.find(
        (button) => button.dataset.firstCategory
    );
    if (initialCategoryButton) {
        initialCategoryButton.click();
    } else if (categoryButtons.length > 0) {
        categoryButtons[0].click();
    }
});
