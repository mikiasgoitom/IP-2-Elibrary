// the menu
function toggle() {
    let menu = document.querySelector(".menu-toggled");
    menu.style.display = 'block'; // Ensure the element is displayed before adding the 'active' class
    setTimeout(function () {
        menu.classList.add('active');
    }, 2);
}

function toggleBack() {
    let container = document.querySelector(".menu-toggled");
    container.classList.remove('active');
    container.addEventListener('transitionend', function () {
        container.style.display = 'none'; // Hide the element after the transition has ended
    }, {
        once: true
    });
}

