document.addEventListener("DOMContentLoaded", function () {
  const loader = document.getElementById("page-loader");
  if (!loader) return;

  const bars = [
    ".loader-left",
    ".loader-left-middle",
    ".loader-right-middle",
    ".loader-right"
  ];

  const tl = gsap.timeline();

  tl.to(bars, {
    scaleY: 1,
    duration: 0.35,
    ease: "power2.inOut",
    stagger: 0.06
  })
  .to(".logo-animatie-img", {
    opacity: 1,
    y: 20,
    scale: 1,
    duration: 0.2,
    ease: "power2.in"
  })
  .to(".spinner", {
    rotation: 720,
    scale: 0.2,
    opacity: 0,
    filter: "blur(6px)",
    duration: 0.45,
    ease: "power2.in"
  }, "+=0.15")
  .to(".logo-animatie-img:not(.spinner)", {
    opacity: 0,
    duration: 0.35,
    ease: "power2.out"
  }, "<")
  .set(bars, { transformOrigin: "top" })
  .to(bars, {
    scaleY: 0,
    duration: 0.4,
    ease: "power2.inOut",
    stagger: 0.06
  })
  .set(loader, { display: "none" })
  .to("section", {
    opacity: 1,
    y: 0,
    duration: 0.2,
    ease: "power2.in"
  });
});
