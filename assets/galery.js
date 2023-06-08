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
    
    let previousOptions = [];
    let nextOptions = [];
    for(let i = 1; i <= visibleCount / 2; i++) {
        const previousIndex = (activeIndex - i + currentOptions.length) % currentOptions.length;
        const nextIndex = (activeIndex + i) % currentOptions.length;
        previousOptions.unshift(currentOptions[previousIndex]);
        nextOptions.push(currentOptions[nextIndex]);
    }
    const visibleOptions = [...previousOptions, currentOptions[activeIndex], ...nextOptions];

    // Hide all options
    options.forEach((option) => {
        option.style.display = "none";
        option.style.pointerEvents = "none"; // No clickable icon
    });


    // Show visible options
    visibleOptions.forEach((option) => {
        option.style.display = "flex";
        option.style.pointerEvents = "auto"; 
    });

    // Set the active class on the current option
    options.forEach((option) => {
        if (option === currentOptions[activeIndex]) {
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
        option.addEventListener("click", (event) => {
            const currentOptionIndex = currentOptions.indexOf(option);
            if (currentOptionIndex !== -1) {
                if (option.classList.contains("active")) {
                // If the clicked option is active, allow the click event
                    return;
                } else {
                // If the clicked option is not active, prevent the click event
                    event.preventDefault();
                    handleClick(currentOptionIndex);
                }
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

            handleClick(Math.floor(categoryOptions.length / 2));
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
let nav = document.querySelector('.category-buttons');
let line = document.createElement('div');
line.className = 'line';
nav.appendChild(line);

let active = nav.querySelector('.category-button.active');
let pos = 0;
let wid = 0;

if(active) {
    pos = active.offsetLeft;
    wid = active.offsetWidth;
    line.style.left = `${pos}px`;
    line.style.width = `${wid}px`;
}

nav.querySelectorAll('.category-button').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        if(!button.classList.contains('active')) {
            nav.querySelectorAll('.category-button').forEach(btn => {
                btn.classList.remove('active');
            });
            button.classList.add('active');

            let position = button.offsetLeft;
            let width = button.offsetWidth;

            // Double animation en deux étapes
            if(position >= pos) {
                line.style.width = `${position - pos + width}px`;
                setTimeout(() => {
                    line.style.width = `${width}px`;
                    line.style.left = `${position}px`;
                }, 300);
            } else {
                line.style.left = `${position}px`;
                line.style.width = `${pos - position + wid}px`;
                setTimeout(() => {
                    line.style.width = `${width}px`;
                }, 300);
            }
            pos = position;
            wid = width;
        }
    });
});
