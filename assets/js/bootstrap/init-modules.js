/**
 * Initialize all front-end modules with provided context.
 */
(function setupInitModules() {
  window.DietitianBootstrap = window.DietitianBootstrap || {};

  window.DietitianBootstrap.initModules = function initModules(context) {
    if (window.Dietitian?.initNavigation) {
      window.Dietitian.initNavigation({
        navigationToggle: context.navigationToggle,
        navigationMenu: context.navigationMenu,
        mobileNavigationQuery: context.mobileNavigationQuery,
      });
    }

    if (window.Dietitian?.initSmoothScroll) {
      window.Dietitian.initSmoothScroll({
        inPageLinks: context.inPageLinks,
        getHeaderOffset: context.getHeaderOffset,
        setActiveLink: context.setActiveLink,
      });
    }

    if (window.Dietitian?.initSectionObserver) {
      window.Dietitian.initSectionObserver({
        sectionLinks: context.sectionLinks,
        getHeaderOffset: context.getHeaderOffset,
        setActiveLink: context.setActiveLink,
      });
    }

    if (window.Dietitian?.initPageMotion) {
      window.Dietitian.initPageMotion();
    }
  };
})();
