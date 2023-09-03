// !animasi hamburger-menu dan navigasi
const menus = document.querySelectorAll(".menu");
const navMenu = document.querySelector('.nav-menu');
const hambergerMenu = document.querySelector(".hamberger-menu");

menus.forEach(function (menu) {
    menu.addEventListener("click", function () {
        hambergerMenu.classList.toggle("open");
        navMenu.classList.toggle('show');
    });
});
