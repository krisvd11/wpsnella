document.addEventListener("DOMContentLoaded", function () {


  gsap.registerPlugin(ScrollTrigger);

  if (window.Lenis) {
    const lenis = new Lenis({
      lerp: 0.1,
      smoothWheel: true,
      smoothTouch: false,
    });

    lenis.on("scroll", () => {
      ScrollTrigger.update();
    });

    function raf(time) {
      lenis.raf(time);
      requestAnimationFrame(raf);
    }

    requestAnimationFrame(raf);
  }

  const path = document.getElementById("svg-path");

  if (path && typeof path.getTotalLength === "function") {
    const pathLength = path.getTotalLength();

    path.style.strokeDasharray = pathLength;
    path.style.strokeDashoffset = pathLength;

    gsap.to(path, {
      strokeDashoffset: 0,
      ease: "none",
      scrollTrigger: {
        trigger: ".svgwidth",
        start: "top top",
        end: "bottom bottom",
        scrub: true,
      },
    });
  }

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

  const wrapper1 = document.querySelector(".wrapper1");

  if (wrapper1) {
    gsap.set(wrapper1, { autoAlpha: 0 });

    const wrapperTimeline = gsap.timeline({
      scrollTrigger: {
        trigger: document.documentElement, 
        start: "top top",
        end: "bottom bottom",
        scrub: true,
      },
    });

    wrapperTimeline.to(
      wrapper1,
      {
        autoAlpha: 1,
        duration: 0.05,
        ease: "none",
      },
      0.18,
    );

    wrapperTimeline.to(
      wrapper1,
      {
        autoAlpha: 0,
        duration: 0.1,
        ease: "none",
      },
      0.35,
    );
  }
});
