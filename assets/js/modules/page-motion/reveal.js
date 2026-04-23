/**
 * Scroll-based reveal behavior for homepage sections.
 */
(function setupPageMotionReveal() {
  window.DietitianPageMotion = window.DietitianPageMotion || {};

  const config = window.DietitianPageMotion.config || {};

  const registerMotionTargets = () => {
    const targets = [];
    const seenTargets = new WeakSet();

    const registerGroup = (selectors, step = 0, base = 0) => {
      document.querySelectorAll(selectors).forEach((element, index) => {
        if (seenTargets.has(element)) {
          return;
        }

        seenTargets.add(element);
        element.classList.add("motion-reveal");
        element.style.setProperty(
          "--motion-delay",
          `${(base + index * step).toFixed(2)}s`,
        );
        targets.push(element);
      });
    };

    (config.MOTION_GROUPS || []).forEach(({ selectors, step, base }) =>
      registerGroup(selectors, step, base),
    );

    return targets;
  };

  window.DietitianPageMotion.initSectionReveal = function initSectionReveal() {
    if (!document.body) {
      return;
    }

    document.body.classList.add("motion-enabled");

    const targets = registerMotionTargets();

    if (targets.length === 0) {
      return;
    }

    if (!("IntersectionObserver" in window)) {
      targets.forEach((target) => target.classList.add("is-visible"));
      return;
    }

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) {
          return;
        }

        entry.target.classList.add("is-visible");
        observer.unobserve(entry.target);
      });
    }, config.MOTION_OBSERVER_OPTIONS);

    targets.forEach((target) => observer.observe(target));
  };
})();
