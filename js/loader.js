document.addEventListener("DOMContentLoaded", function () {


  const loader = document.getElementById("page-loader");

  if (loader) {
    const tl = gsap.timeline();

    tl.to(".loader-bar", {
      height: "100%",
      duration: 0.6,
      ease: "power2.in",
    });

    tl.to(".loader-bar", {
      height: "0%",
      duration: 0.6,
      ease: "power2.out",
      delay: 0.6
    });

    tl.to(".loader-bar", {
      opacity: 0,
      duration: 0.6,
      ease: "power2.out",
      delay: 0.6
    });

    tl.to(loader, {
      opacity: 0,
      duration: 0.5,
      onComplete: function () {
        loader.style.display = "none";
      },
    });
  }
  const heroText = document.querySelector(".hero-gsap-text");

  if (heroText) {
    const originalText = heroText.textContent;

    heroText.innerHTML = [...originalText]
      .map((char) =>
        char === " "
          ? '<span class="space">&nbsp;</span>'
          : `<span>${char}</span>`,
      )
      .join("");

    gsap.fromTo(
      ".hero-gsap-text",
      { opacity: 0, y: 20 },
      { opacity: 1, y: 0, duration: 2.2, ease: "power2.out" },
    );
  }

 
});
