/**
 * main.js
 * Main JavaScript entry point for Dietitian Theme.
 */

document.addEventListener("DOMContentLoaded", () => {
  if (typeof window.DietitianBootstrap?.bootstrapApp === "function") {
    window.DietitianBootstrap.bootstrapApp();
  }
});
