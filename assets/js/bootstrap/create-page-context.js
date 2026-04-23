/**
 * Build a page context used by navigation/scroll/motion modules.
 */
(function setupCreatePageContext() {
  window.DietitianBootstrap = window.DietitianBootstrap || {};

  const getBreakpointMd = () => {
    const fallback =
      window.DietitianBootstrap.constants?.BREAKPOINT_MD_FALLBACK || "768px";

    return (
      getComputedStyle(document.documentElement)
        .getPropertyValue("--breakpoint-md")
        .trim() || fallback
    );
  };

  window.DietitianBootstrap.createPageContext = function createPageContext() {
    const header = document.getElementById("site-header");
    const navigationToggle = document.querySelector(".site-nav__toggle");
    const navigationMenu = document.getElementById("primary-menu");
    const mobileNavigationQuery = window.matchMedia(
      `(max-width: ${getBreakpointMd()})`,
    );
    const inPageLinks = Array.from(
      document.querySelectorAll('.site-nav a[href^="#"]'),
    );
    const sectionLinks = inPageLinks.filter((link) => {
      const targetSelector = link.getAttribute("href");

      return targetSelector && targetSelector.length > 1;
    });

    const getHeaderOffset = () => {
      if (!header) {
        return 0;
      }

      const headerPosition = window.getComputedStyle(header).position;

      if (headerPosition !== "fixed" && headerPosition !== "sticky") {
        return 0;
      }

      return (
        header.getBoundingClientRect().height +
        (window.DietitianBootstrap.constants?.HEADER_EXTRA_OFFSET || 16)
      );
    };

    const setActiveLink = (targetSelector) => {
      sectionLinks.forEach((link) => {
        const isActive = link.getAttribute("href") === targetSelector;

        link.classList.toggle("is-active", isActive);

        if (isActive) {
          link.setAttribute("aria-current", "page");
        } else {
          link.removeAttribute("aria-current");
        }
      });
    };

    return {
      navigationToggle,
      navigationMenu,
      mobileNavigationQuery,
      inPageLinks,
      sectionLinks,
      getHeaderOffset,
      setActiveLink,
    };
  };
})();
