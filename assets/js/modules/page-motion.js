/**
 * Homepage motion orchestrator.
 */
(function setupPageMotionModule() {
  window.Dietitian = window.Dietitian || {};

  window.Dietitian.initPageMotion = function initPageMotion() {
    const prefersMotion = window.matchMedia(
      "(prefers-reduced-motion: no-preference)",
    );
    const heroSection = document.querySelector(".hero");
    const pageMotion = window.DietitianPageMotion || {};

    if (
      prefersMotion.matches &&
      typeof pageMotion.initZnanyWidgetMotion === "function"
    ) {
      pageMotion.initZnanyWidgetMotion();
    }

    if (!prefersMotion.matches || !heroSection || !document.body) {
      return;
    }

    if (typeof pageMotion.initSectionReveal === "function") {
      pageMotion.initSectionReveal();
    }
  };
})();
