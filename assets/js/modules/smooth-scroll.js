/**
 * Smooth scrolling for in-page navigation links.
 */
(function setupSmoothScrollModule() {
  window.Dietitian = window.Dietitian || {};

  window.Dietitian.initSmoothScroll = function initSmoothScroll(options) {
    const { inPageLinks, getHeaderOffset, setActiveLink } = options;

    if (!Array.isArray(inPageLinks) || inPageLinks.length === 0) {
      return;
    }

    inPageLinks.forEach((link) => {
      link.addEventListener("click", (event) => {
        const targetSelector = link.getAttribute("href");

        if (!targetSelector || targetSelector === "#") {
          return;
        }

        const targetElement = document.querySelector(targetSelector);

        if (!targetElement) {
          return;
        }

        event.preventDefault();

        const targetTop =
          targetElement.getBoundingClientRect().top +
          window.scrollY -
          getHeaderOffset();

        const prefersReduced = window.matchMedia(
          "(prefers-reduced-motion: reduce)",
        ).matches;

        window.scrollTo({
          top: targetTop,
          behavior: prefersReduced ? "instant" : "smooth",
        });
        setActiveLink(targetSelector);
      });
    });
  };
})();
