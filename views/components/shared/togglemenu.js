function setupToggleMenu(iconSelector, menuSelector) {
    const icon = document.querySelector(iconSelector);
    const menu = document.querySelector(menuSelector);

    function toggleMenu() {
        menu.classList.toggle('show');
    }

    function closeMenuOnClickOutside(event) {
        if (!icon.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.remove('show');
        }
    }

    icon.addEventListener('click', function(event) {
        event.stopPropagation();
        toggleMenu();
    });

    document.addEventListener('click', closeMenuOnClickOutside);
}
