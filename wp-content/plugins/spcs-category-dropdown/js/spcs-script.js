document.addEventListener('DOMContentLoaded', function () {
    // Category Dropdown Toggle
    const categoryHeading = document.querySelector('.spcs-category-heading');
    const categoryDropdown = document.querySelector('.spcs-category-list');

    if (categoryHeading && categoryDropdown) {
        categoryHeading.addEventListener('click', function () {
            categoryDropdown.classList.toggle('show');
        });
    }

    // Subcategory Toggle
    const categoryItems = document.querySelectorAll('.spcs-category-item.has-children');
    categoryItems.forEach(item => {
        const childIndicator = item.querySelector('.spcs-child-indicator');
        const subcategoryList = item.querySelector('.spcs-subcategory-list');

        if (childIndicator && subcategoryList) {
            childIndicator.addEventListener('click', function (e) {
                e.preventDefault();
                subcategoryList.classList.toggle('show');
                item.classList.toggle('expanded');
            });
        }
    });

    // Sorting Dropdown Toggle
    const sortingHeading = document.querySelector('.spcs-sorting-heading');
    const sortingDropdown = document.querySelector('.spcs-sorting-dropdown');
    const sortingList = document.querySelector('.spcs-sorting-list');

    if (sortingHeading && sortingList) {
        sortingHeading.addEventListener('click', function () {
            sortingList.classList.toggle('expanded');
        });
    }

    // Sorting Option Selection
    const sortingLinks = document.querySelectorAll('.spcs-sorting-list li a');
    sortingLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            window.location.href = href; // Redirect to the selected sorting option
        });
    });
});
