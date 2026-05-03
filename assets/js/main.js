/**
 * main.js
 * Main JavaScript entry point for Dietitian Theme.
 */

document.addEventListener("DOMContentLoaded", () => {
  if (typeof window.DietitianBootstrap?.bootstrapApp === "function") {
    window.DietitianBootstrap.bootstrapApp();
  }

  const searchInput = document.getElementById("blog-search-input");
  const searchClearButton = document.querySelector("[data-search-clear]");

  if (!searchInput || !searchClearButton) {
    return;
  }

  const syncClearButtonVisibility = () => {
    searchClearButton.disabled = searchInput.value.trim().length === 0;
  };

  searchClearButton.addEventListener("click", () => {
    if (searchClearButton.disabled) {
      return;
    }

    searchInput.value = "";
    searchInput.focus();
    syncClearButtonVisibility();
  });

  searchInput.addEventListener("input", syncClearButtonVisibility);
  syncClearButtonVisibility();
});
