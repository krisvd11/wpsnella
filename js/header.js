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

    document.querySelectorAll(".menu-item-has-children").forEach(function(menuItem) {

        const btn = document.createElement("button");
        btn.classList.add("submenu-toggle");
        btn.setAttribute("aria-expanded", "false");

        btn.innerHTML = `
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" fill="none" class="menu-item-icon" width="22px" height="22px" aria-hidden="true" focusable="false"><path d="M1.50002 4L6.00002 8L10.5 4" stroke-width="1" stroke="#0f2a84"></path></svg>
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

document.addEventListener("DOMContentLoaded", function() {
    if (typeof window.gsap === "undefined") {
        return;
    }

    const initUnderline = (navList, options = {}) => {
        if (!navList) {
            return;
        }

        const links = navList.querySelectorAll("a");
        if (!links.length) {
            return;
        }

        const underline = document.createElement("span");
        underline.className = "nav-underline";
        navList.appendChild(underline);

        const getActiveLink = () => {
            if (options.defaultToFirst) {
                return links[0];
            }
            return navList.querySelector(".current-menu-item > a, .current-menu-ancestor > a") || links[0];
        };

        let activeLink = getActiveLink();

        const getTextRect = (link) => {
            try {
                const range = document.createRange();
                range.selectNodeContents(link);
                const rect = range.getBoundingClientRect();
                if (rect && rect.width > 0) {
                    return rect;
                }
            } catch (e) {
                // Fallback below if range fails
            }
            return link.getBoundingClientRect();
        };

        const setUnderline = (link, immediate = false, animateIn = false) => {
            if (!link) {
                return;
            }
            const linkRect = link.getBoundingClientRect();
            const textRect = getTextRect(link);
            const navRect = navList.getBoundingClientRect();
            const x = textRect.left - navRect.left;
            const width = textRect.width;
            const offsetY = options.offsetY || 0;
            const y = linkRect.top - navRect.top + linkRect.height + offsetY;

            if (immediate) {
                window.gsap.set(underline, { x, y, width, opacity: 1, scaleX: 1, transformOrigin: "right center" });
            } else {
                window.gsap.set(underline, { x, y, width, opacity: 1, transformOrigin: "right center" });
                if (animateIn) {
                    window.gsap.fromTo(
                        underline,
                        { scaleX: 0 },
                        { scaleX: 1, duration: 0.35, ease: "power2.out" }
                    );
                } else {
                    window.gsap.to(underline, { scaleX: 1, duration: 0.2, ease: "power2.out" });
                }
            }
        };

        setUnderline(activeLink, true);

        links.forEach((link) => {
            link.addEventListener("mouseenter", () => setUnderline(link, false, true));
            link.addEventListener("focus", () => setUnderline(link, false, true));
            link.addEventListener("click", () => {
                activeLink = link;
                setUnderline(activeLink, false, true);
            });
        });

        navList.addEventListener("mouseleave", () => setUnderline(activeLink, false, true));
        window.addEventListener("resize", () => setUnderline(activeLink, true));
    };

    initUnderline(document.querySelector(".site-nav .menu"), { offsetY: 6 });
    document.querySelectorAll(".site-nav .sub-menu").forEach((subMenu) => {
        initUnderline(subMenu, { defaultToFirst: true, offsetY: 2 });
    });
});
