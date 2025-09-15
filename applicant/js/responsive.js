document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.querySelector(".hamburger");
  const body = document.body; // use body instead of sidebar
  const sidebar = document.querySelector(".sidebar");

  function isMobile() {
    return window.matchMedia("(max-width: 767px)").matches;
  }

  // Load saved sidebar state
  function loadSidebarState() {
    const savedState = localStorage.getItem("sidebar-collapsed");
    if (savedState === "true") {
      body.classList.add("collapsed");
    } else {
      body.classList.remove("collapsed");
    }
  }
  function saveSidebarState() {
    const isCollapsed = body.classList.contains("collapsed");
    localStorage.setItem("sidebar-collapsed", isCollapsed);
  }

  hamburger.addEventListener("click", function () {
    if (isMobile()) {
      sidebar.classList.toggle("visible"); // mobile slide-in
    } else {
      body.classList.toggle("collapsed"); // desktop collapse
      saveSidebarState();
    }
  });

  function initSidebar() {
    if (isMobile()) {
      body.classList.remove("collapsed");
      sidebar.classList.remove("visible");
    } else {
      loadSidebarState();
      sidebar.classList.remove("visible");
    }
  }

  window.addEventListener("resize", initSidebar);
  initSidebar();

});
