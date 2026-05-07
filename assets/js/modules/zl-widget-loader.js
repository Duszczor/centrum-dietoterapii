(function () {
  if (!document.getElementById("zl-url")) {
    return;
  }

  var loaded = false;
  var events = ["pointerdown", "touchstart", "scroll", "keydown"];

  var loadWidget = function () {
    if (loaded || document.getElementById("dietitian-znanylekarz-script")) {
      return;
    }
    loaded = true;
    events.forEach(function (e) {
      window.removeEventListener(e, loadWidget, { passive: true });
    });
    var s = document.createElement("script");
    s.id = "dietitian-znanylekarz-script";
    s.src = "https://platform.docplanner.com/js/widget.js";
    s.async = true;
    document.body.appendChild(s);
  };

  events.forEach(function (e) {
    window.addEventListener(e, loadWidget, { once: true, passive: true });
  });

  window.addEventListener(
    "load",
    function () {
      window.setTimeout(loadWidget, 10000);
    },
    { once: true },
  );
})();
