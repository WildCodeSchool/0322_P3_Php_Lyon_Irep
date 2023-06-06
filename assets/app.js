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

// JS Galery
document.addEventListener("DOMContentLoaded", function () {
    let options = selectAll(".option");
    let bullets = selectAll(".bullet");
    let categoryButtons = selectAll(".category-button");

    const handleClick = (activeIndex) => {
        const activeOption = options[activeIndex];

        if (
            activeOption &&
      window.getComputedStyle(activeOption).display === "none"
        ) {
            const randomVisibleIndex = options.findIndex(
                (option) => window.getComputedStyle(option).display !== "none"
            );
            if (randomVisibleIndex !== -1) {
                options[randomVisibleIndex].style.display = "none";
            }
            activeOption.style.display = "flex";
        }

        options.forEach((option, index) => {
            if (index === activeIndex) {
                option.classList.add("active");
                const bulletIndex = options.indexOf(option);
                if (bulletIndex !== -1 && bulletIndex < bullets.length) {
                    bullets[bulletIndex].classList.add("active");
                }
            } else {
                option.classList.remove("active");
                const bulletIndex = options.indexOf(option);
                if (bulletIndex !== -1 && bulletIndex < bullets.length) {
                    bullets[bulletIndex].classList.remove("active");
                }
            }
        });
    };

    options.forEach((option, index) => {
        option.addEventListener("click", () => handleClick(index));
    });

    bullets.forEach((bullet, index) => {
        bullet.addEventListener("click", () => handleClick(index));
    });

    handleClick(0);

    categoryButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const category = this.getAttribute("data-category");
            options.forEach((option) => {
                if (option.getAttribute("data-category") !== category) {
                    option.style.display = "none";
                } else {
                    option.style.display = "flex";
                }
            });

            bullets.forEach((bullet, index) => {
                const option = options[index];
                if (option && option.getAttribute("data-category") !== category) {
                    bullet.style.display = "none";
                } else {
                    bullet.style.display = "inline-block";
                }
            });

            const firstVisibleOptionIndex = options.findIndex(
                (option) => window.getComputedStyle(option).display !== "none"
            );
            handleClick(firstVisibleOptionIndex);
        });
    });

    if (categoryButtons.length > 0) {
        categoryButtons[0].click();
    }
});
