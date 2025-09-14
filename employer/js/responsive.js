document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.querySelector(".hamburger");
  const sidebar = document.querySelector(".sidebar");

  function isMobile() {
    return window.matchMedia("(max-width: 767px)").matches;
  }

  // Check for saved sidebar state in localStorage
  function loadSidebarState() {
    const savedState = localStorage.getItem("sidebar-collapsed");
    if (savedState === "true") {
      sidebar.classList.add("collapsed");
    } else {
      sidebar.classList.remove("collapsed");
    }
  }

  function saveSidebarState() {
    const isCollapsed = sidebar.classList.contains("collapsed");
    localStorage.setItem("sidebar-collapsed", isCollapsed);
  }

  hamburger.addEventListener("click", function () {
    if (isMobile()) {
      sidebar.classList.toggle("visible");
    } else {
      sidebar.classList.toggle("collapsed");
      saveSidebarState();
    }
  });

  function initSidebar() {
    if (isMobile()) {
      sidebar.classList.remove("collapsed");
      sidebar.classList.remove("visible");
    } else {
      loadSidebarState();
      sidebar.classList.remove("visible");
    }
  }

  window.addEventListener("resize", initSidebar);
  initSidebar();
});
