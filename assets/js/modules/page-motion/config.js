/**
 * Shared configuration for page motion modules.
 */
(function setupPageMotionConfig() {
  window.DietitianPageMotion = window.DietitianPageMotion || {};

  window.DietitianPageMotion.config = {
    ZNANY_WIDGET_VISIBLE_CLASS: "is-visible",
    ZNANY_WIDGET_MOTION_CLASS: "zl-widget-motion",
    ZNANY_WIDGET_ANIMATED_ATTR: "data-zl-motion-animated",
    ZNANY_WIDGET_ANIMATION: {
      duration: 1450,
      delay: 620,
      easing: "cubic-bezier(0.22, 1, 0.36, 1)",
      fill: "both",
    },
    ZNANY_WIDGET_START_X: "120vw",
    ZNANY_WIDGET_SELECTORS: [
      "#zl-url",
      ".zl-url",
      "[data-zlw-type]",
      "[id*='zlw']",
      "[class*='zlw']",
      "[class*='docplanner']",
      "[class*='dp-widget']",
      "[id*='dp-widget']",
      "iframe[src*='docplanner']",
      "iframe[src*='znanylekarz']",
    ],
    ZNANY_WIDGET_OBSERVER_OPTIONS: {
      childList: true,
      subtree: true,
      attributes: true,
      attributeFilter: ["id", "class", "style", "src", "data-zlw-type"],
    },
    MOTION_OBSERVER_OPTIONS: {
      rootMargin: "0px 0px -4% 0px",
      threshold: 0.08,
    },
    MOTION_GROUPS: [
      { selectors: ".offer-cards__header", step: 0, base: 0.03 },
      { selectors: ".offer-card", step: 0.08, base: 0.05 },
      { selectors: ".contact-banner__content", step: 0, base: 0.03 },
      { selectors: ".consultation-preview__content", step: 0, base: 0.03 },
      { selectors: ".consultation-preview__media", step: 0, base: 0.09 },
      {
        selectors: ".pricing__title, .pricing__subtitle",
        step: 0.06,
        base: 0.03,
      },
      { selectors: ".pricing__card", step: 0.08, base: 0.05 },
      { selectors: ".pricing__footer", step: 0, base: 0.08 },
      { selectors: ".contact__header", step: 0, base: 0.03 },
      { selectors: ".contact__card", step: 0.08, base: 0.05 },
      { selectors: ".contact__map-copy", step: 0, base: 0.04 },
      { selectors: ".contact__map-frame", step: 0, base: 0.1 },
      {
        selectors: ".site-footer__brand, .site-footer__column",
        step: 0.06,
        base: 0.03,
      },
    ],
  };
})();
