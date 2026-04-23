/**
 * Bootstrap application flow: create context and run modules.
 */
(function setupBootstrapApp() {
  window.DietitianBootstrap = window.DietitianBootstrap || {};

  window.DietitianBootstrap.bootstrapApp = function bootstrapApp() {
    if (
      typeof window.DietitianBootstrap.createPageContext !== "function" ||
      typeof window.DietitianBootstrap.initModules !== "function"
    ) {
      return;
    }

    const pageContext = window.DietitianBootstrap.createPageContext();
    window.DietitianBootstrap.initModules(pageContext);
  };
})();
