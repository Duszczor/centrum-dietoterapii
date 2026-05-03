/**
 * Section visibility observer for active nav-link state.
 */
(function setupSectionObserverModule() {
  window.Dietitian = window.Dietitian || {};

  window.Dietitian.initSectionObserver = function initSectionObserver(options) {
    const { sectionLinks, getHeaderOffset, setActiveLink } = options;

    if (
      !("IntersectionObserver" in window) ||
      !Array.isArray(sectionLinks) ||
      sectionLinks.length === 0
    ) {
      return;
    }

    const observedSections = sectionLinks
      .map((link) => document.querySelector(link.getAttribute("href")))
      .filter(Boolean);

    if (observedSections.length === 0) {
      return;
    }

    let observer = null;

    const createObserver = () => {
      if (observer) {
        observer.disconnect();
      }

      observer = new IntersectionObserver(
        (entries) => {
          const visibleEntry = entries
            .filter((entry) => entry.isIntersecting)
            .sort(
              (entryA, entryB) =>
                entryB.intersectionRatio - entryA.intersectionRatio,
            )[0];

          setActiveLink(
            visibleEntry?.target?.id ? `#${visibleEntry.target.id}` : null,
          );
        },
        {
          rootMargin: `-${getHeaderOffset()}px 0px -45% 0px`,
          threshold: [0.2, 0.45, 0.7],
        },
      );

      observedSections.forEach((section) => observer.observe(section));
    };

    createObserver();

    let resizeTimer;
    window.addEventListener(
      "resize",
      () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(createObserver, 150);
      },
      { passive: true },
    );
  };
})();
