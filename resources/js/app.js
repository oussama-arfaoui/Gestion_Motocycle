const dropdowns = ["nav-products", "nav-ecommerce", "username"];

for (let element of dropdowns) {
    const dropdownButton = document.getElementById(`dropdown-${element}`);
    const dropdownContent = document.getElementById(`dropdown-menu-${element}`);

    dropdownButton.addEventListener('click', () => {
        dropdownContent.classList.toggle('show');
        dropdownContent.classList.toggle('hide');
        // Toggle the arrow direction as well
        const arrow = document.getElementById(`dropdown-${element}-arrow`);
        arrow.classList.toggle('spin-arrow');
    });
}
