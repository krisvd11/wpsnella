document.addEventListener("DOMContentLoaded", function() {
    const hamburger = document.getElementById("hamburger");
    const mobileMenu = document.getElementById("menu-wrapper");
    const toggle = document.getElementById("toggle-btn");
    const cross = document.getElementById("cross");

    hamburger.addEventListener("click", function() {
        mobileMenu.classList.toggle("active");
        toggle.classList.toggle("inactive");
        cross.classList.toggle("active");
        hamburger.classList.toggle("active")
    });
});





document.addEventListener("DOMContentLoaded", function() {

    document.querySelectorAll(".current-menu-ancestor").forEach(function(menuItem) {

        const btn = document.createElement("button");
        btn.classList.add("submenu-toggle");
        btn.setAttribute("aria-expanded", "false");

        btn.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 24 24">
                <path d="M6 9l6 6 6-6" fill="none" stroke="currentColor" stroke-width="2"/>
            </svg>
        `;

        const link = menuItem.querySelector("a");
        link.after(btn);

        btn.addEventListener("click", function(e) {
            e.preventDefault();
            menuItem.classList.toggle("open");

            const expanded = menuItem.classList.contains("open");
            btn.setAttribute("aria-expanded", expanded);
        });

    });

});