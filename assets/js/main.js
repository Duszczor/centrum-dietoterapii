/**
 * main.js
 * Main JavaScript entry point for Dietitian Theme.
 */

document.addEventListener("DOMContentLoaded", () => {
  const header = document.getElementById("site-header");
  const navigationToggle = document.querySelector(".site-nav__toggle");
  const navigationMenu = document.getElementById("primary-menu");
  const breakpointMd =
    getComputedStyle(document.documentElement)
      .getPropertyValue("--breakpoint-md")
      .trim() || "768px";
  const mobileNavigationQuery = window.matchMedia(
    `(max-width: ${breakpointMd})`,
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

    return header.getBoundingClientRect().height + 16;
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

  if (window.Dietitian?.initNavigation) {
    window.Dietitian.initNavigation({
      navigationToggle,
      navigationMenu,
      mobileNavigationQuery,
    });
  }

  if (window.Dietitian?.initSmoothScroll) {
    window.Dietitian.initSmoothScroll({
      inPageLinks,
      getHeaderOffset,
      setActiveLink,
    });
  }

  if (window.Dietitian?.initSectionObserver) {
    window.Dietitian.initSectionObserver({
      sectionLinks,
      getHeaderOffset,
      setActiveLink,
    });
  }
});
