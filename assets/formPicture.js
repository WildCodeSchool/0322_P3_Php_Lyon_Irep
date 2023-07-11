document.addEventListener("DOMContentLoaded", () => {
    let categoryDropdown = document.getElementById("picture_category");
    let newCategoryField = document.getElementById("picture_newCategory");

    if (categoryDropdown && newCategoryField) {
        categoryDropdown.addEventListener("change", function() {
            if(categoryDropdown.value === "new") {
                newCategoryField.style.display = "block";
            } else {
                newCategoryField.style.display = "none";
            }
        });
    }
});
