/**
 * main.js
 * Main JavaScript entry point for Dietitian Theme.
 */

document.addEventListener("DOMContentLoaded", () => {
  const header = document.getElementById("site-header");
  const navigationToggle = document.querySelector(".site-nav__toggle");
  const navigationMenu = document.getElementById("primary-menu");
  const mobileNavigationQuery = window.matchMedia("(max-width: 768px)");

  if (header) {
    const onScroll = () => {
      header.classList.toggle("is-scrolled", window.scrollY > 50);
    };

    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
  }

  if (navigationToggle && navigationMenu) {
    const navigationLinks = Array.from(
      navigationMenu.querySelectorAll("a[href]"),
    );

    const syncNavigationState = (isOpen) => {
      const shouldUseMobileMenu = mobileNavigationQuery.matches;

      navigationMenu.classList.toggle("is-open", shouldUseMobileMenu && isOpen);
      navigationToggle.setAttribute(
        "aria-expanded",
        shouldUseMobileMenu && isOpen ? "true" : "false",
      );
      navigationMenu.setAttribute(
        "aria-hidden",
        shouldUseMobileMenu && !isOpen ? "true" : "false",
      );
      document.body.classList.toggle(
        "no-scroll",
        shouldUseMobileMenu && isOpen,
      );
    };

    const closeNavigation = ({ returnFocus = false } = {}) => {
      syncNavigationState(false);

      if (returnFocus) {
        navigationToggle.focus();
      }
    };

    const openNavigation = () => {
      syncNavigationState(true);

      if (navigationLinks.length > 0) {
        navigationLinks[0].focus();
      }
    };

    navigationToggle.addEventListener("click", () => {
      const isOpen = navigationToggle.getAttribute("aria-expanded") === "true";

      if (isOpen) {
        closeNavigation({ returnFocus: true });
        return;
      }

      openNavigation();
    });

    navigationLinks.forEach((link) => {
      link.addEventListener("click", () => {
        closeNavigation();
      });
    });

    document.addEventListener("keydown", (event) => {
      const isOpen = navigationToggle.getAttribute("aria-expanded") === "true";

      if (!mobileNavigationQuery.matches || !isOpen) {
        return;
      }

      if (event.key === "Escape") {
        event.preventDefault();
        closeNavigation({ returnFocus: true });
        return;
      }

      if (event.key !== "Tab" || navigationLinks.length === 0) {
        return;
      }

      const firstLink = navigationLinks[0];
      const lastLink = navigationLinks[navigationLinks.length - 1];

      if (event.shiftKey && document.activeElement === firstLink) {
        event.preventDefault();
        lastLink.focus();
      }

      if (!event.shiftKey && document.activeElement === lastLink) {
        event.preventDefault();
        firstLink.focus();
      }
    });

    const handleNavigationViewportChange = (event) => {
      if (!event.matches) {
        closeNavigation();
        navigationMenu.removeAttribute("aria-hidden");
        return;
      }

      syncNavigationState(false);
    };

    if (typeof mobileNavigationQuery.addEventListener === "function") {
      mobileNavigationQuery.addEventListener(
        "change",
        handleNavigationViewportChange,
      );
    } else if (typeof mobileNavigationQuery.addListener === "function") {
      mobileNavigationQuery.addListener(handleNavigationViewportChange);
    }

    handleNavigationViewportChange(mobileNavigationQuery);
  }
});
