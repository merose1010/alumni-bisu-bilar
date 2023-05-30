document.addEventListener('click', function(event) {
    if (!event.target.closest('.user-profile')) {
        const toggleMenu = document.querySelector('.sub-menu-wrap');
        toggleMenu.classList.remove('active');
    }
});

function menuToggle(){
    const toggleMenu = document.querySelector('.sub-menu-wrap');
    toggleMenu.classList.toggle('active')
}