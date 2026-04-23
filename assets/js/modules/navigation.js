/**
 * Mobile navigation behavior and accessibility helpers.
 */
(function setupNavigationModule() {
  window.Dietitian = window.Dietitian || {};

  window.Dietitian.initNavigation = function initNavigation(options) {
    const { navigationToggle, navigationMenu, mobileNavigationQuery } = options;

    if (!navigationToggle || !navigationMenu || !mobileNavigationQuery) {
      return;
    }

    if (window.Dietitian._navigationInitialized) {
      return;
    }

    window.Dietitian._navigationInitialized = true;

    const navigationLinks = Array.from(
      navigationMenu.querySelectorAll("a[href]"),
    );

    const isMenuOpen = () =>
      navigationToggle.getAttribute("aria-expanded") === "true";

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
      if (isMenuOpen()) {
        closeNavigation({ returnFocus: true });
        return;
      }

      openNavigation();
    });

    navigationLinks.forEach((link) => {
      link.addEventListener("click", () => {
        closeNavigation({ returnFocus: mobileNavigationQuery.matches });
      });
    });

    document.addEventListener("click", (event) => {
      if (
        !isMenuOpen() ||
        navigationMenu.contains(event.target) ||
        navigationToggle.contains(event.target)
      ) {
        return;
      }

      closeNavigation();
    });

    document.addEventListener("keydown", (event) => {
      if (!mobileNavigationQuery.matches || !isMenuOpen()) {
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

    mobileNavigationQuery.addEventListener(
      "change",
      handleNavigationViewportChange,
    );

    handleNavigationViewportChange(mobileNavigationQuery);
  };
})();
