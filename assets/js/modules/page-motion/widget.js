/**
 * ZnanyLekarz / Docplanner widget motion handling.
 */
(function setupPageMotionWidget() {
  window.DietitianPageMotion = window.DietitianPageMotion || {};

  const config = window.DietitianPageMotion.config || {};

  const isHTMLElement = (node) => node instanceof HTMLElement;

  const collectWidgets = (root) => {
    const widgets = new Set();
    const selectors = config.ZNANY_WIDGET_SELECTORS || [];

    selectors.forEach((selector) => {
      if (isHTMLElement(root) && root.matches(selector)) {
        widgets.add(root);
      }

      const scope = isHTMLElement(root) ? root : document;
      scope
        .querySelectorAll(selector)
        .forEach((element) => widgets.add(element));
    });

    return widgets;
  };

  const animateWidget = (element) => {
    if (!isHTMLElement(element)) {
      return;
    }

    const animatedAttr = config.ZNANY_WIDGET_ANIMATED_ATTR;
    if (element.getAttribute(animatedAttr) === "true") {
      return;
    }

    element.setAttribute(animatedAttr, "true");
    element.classList.add(config.ZNANY_WIDGET_MOTION_CLASS);

    if (typeof element.animate !== "function") {
      window.requestAnimationFrame(() => {
        window.requestAnimationFrame(() => {
          element.classList.add(config.ZNANY_WIDGET_VISIBLE_CLASS);
        });
      });
      return;
    }

    element.animate(
      [
        { opacity: 0, translate: `${config.ZNANY_WIDGET_START_X} 0` },
        { opacity: 1, translate: "0 0" },
      ],
      config.ZNANY_WIDGET_ANIMATION,
    );

    window.setTimeout(() => {
      element.classList.add(config.ZNANY_WIDGET_VISIBLE_CLASS);
    }, config.ZNANY_WIDGET_ANIMATION.delay + config.ZNANY_WIDGET_ANIMATION.duration);
  };

  window.DietitianPageMotion.initZnanyWidgetMotion =
    function initZnanyWidgetMotion() {
      collectWidgets(document).forEach(animateWidget);

      if (!("MutationObserver" in window) || !document.body) {
        return;
      }

      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (
            mutation.type === "attributes" &&
            isHTMLElement(mutation.target)
          ) {
            collectWidgets(mutation.target).forEach(animateWidget);
          }

          mutation.addedNodes.forEach((node) => {
            if (isHTMLElement(node)) {
              collectWidgets(node).forEach(animateWidget);
            }
          });
        });
      });

      observer.observe(document.body, config.ZNANY_WIDGET_OBSERVER_OPTIONS);
    };
})();
