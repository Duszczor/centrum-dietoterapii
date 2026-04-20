/**
 * Homepage motion effects for section reveals.
 */
(function setupPageMotionModule() {
  window.Dietitian = window.Dietitian || {};

  window.Dietitian.initPageMotion = function initPageMotion() {
    const prefersMotion = window.matchMedia(
      "(prefers-reduced-motion: no-preference)",
    );
    const heroSection = document.querySelector(".hero");

    if (!prefersMotion.matches || !heroSection || !document.body) {
      return;
    }

    const targets = [];
    const seenTargets = new WeakSet();

    const registerGroup = (selectors, delayStep = 0.07, baseDelay = 0) => {
      const elements = Array.from(document.querySelectorAll(selectors));

      elements.forEach((element, index) => {
        if (seenTargets.has(element)) {
          return;
        }

        seenTargets.add(element);
        element.classList.add("motion-reveal");
        element.style.setProperty(
          "--motion-delay",
          `${(baseDelay + index * delayStep).toFixed(2)}s`,
        );
        targets.push(element);
      });
    };

    document.body.classList.add("motion-enabled");

    registerGroup(".offer-cards__header", 0, 0.03);
    registerGroup(".offer-card", 0.08, 0.05);
    registerGroup(".contact-banner__content", 0, 0.03);
    registerGroup(".consultation-preview__content", 0, 0.03);
    registerGroup(".consultation-preview__media", 0, 0.09);
    registerGroup(".pricing__title, .pricing__subtitle", 0.06, 0.03);
    registerGroup(".pricing__card", 0.08, 0.05);
    registerGroup(".pricing__footer", 0, 0.08);
    registerGroup(".contact__header", 0, 0.03);
    registerGroup(".contact__card", 0.08, 0.05);
    registerGroup(".contact__map-copy", 0, 0.04);
    registerGroup(".contact__map-frame", 0, 0.1);
    registerGroup(".site-footer__brand, .site-footer__column", 0.06, 0.03);

    if (targets.length === 0) {
      return;
    }

    if (!("IntersectionObserver" in window)) {
      targets.forEach((target) => target.classList.add("is-visible"));
      return;
    }

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) {
            return;
          }

          entry.target.classList.add("is-visible");
          observer.unobserve(entry.target);
        });
      },
      {
        rootMargin: "0px 0px -12% 0px",
        threshold: 0.16,
      },
    );

    targets.forEach((target) => observer.observe(target));
  };
})();
