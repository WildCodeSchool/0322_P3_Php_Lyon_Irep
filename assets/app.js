import "./styles/app.scss";
import "./bootstrap";
import "flowbite";

function selectAll(selector) {
    return Array.from(document.querySelectorAll(selector));
}

document.addEventListener("DOMContentLoaded", function () {
    // Get All options
    let options = selectAll(".option");
    let categoryButtons = selectAll(".category-button");
    let bulletsContainer = document.querySelector(".bullet-navigation");

    const handleClick = (activeIndex) => {
        const category = options[activeIndex].getAttribute("data-category");
        const categoryOptions = options.filter(
            (option) => option.getAttribute("data-category") === category
        );
        const startIndex = categoryOptions.indexOf(options[activeIndex]);

        options.forEach((option) => {
            option.style.display = "none";
        });

        //Display the option and the next 5 pictures
        let imagesToDisplay = categoryOptions.slice(startIndex, startIndex + 6);

        //If less than 6 get from the start
        while (imagesToDisplay.length < 6) {
            imagesToDisplay = imagesToDisplay.concat(
                categoryOptions.slice(0, 6 - imagesToDisplay.length)
            );
        }

        // Affiche les images à afficher
        imagesToDisplay.forEach((option) => {
            option.style.display = "flex";
        });

        // Met en surbrillance l'option sélectionnée
        options.forEach((option, index) => {
            if (index === activeIndex) {
                option.classList.add("active");
            } else {
                option.classList.remove("active");
            }
        });

        // Met en surbrillance le point sélectionné
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
        bulletsContainer.innerHTML = "";

        // New bullet point for each pictures
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

            //Display the 6 first images
            categoryOptions.slice(0, 6).forEach((option) => {
                option.style.display = "flex";
            });

            generateBullets(categoryOptions);
            handleClick(options.indexOf(categoryOptions[0]));
        });

        // Click on first category
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
