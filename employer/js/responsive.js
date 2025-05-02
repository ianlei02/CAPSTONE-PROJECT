document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.querySelector(".hamburger");
    const sidebar = document.querySelector(".sidebar");

    function isMobile() {
      return window.matchMedia("(max-width: 767px)").matches;
    }
    hamburger.addEventListener("click", function () {
      if (isMobile()) {
        sidebar.classList.toggle("visible");
      } else {
        sidebar.classList.toggle("collapsed");
      }
    });
    function initSidebar() {
      if (isMobile()) {
        sidebar.classList.remove("collapsed");
        sidebar.classList.remove("visible");
      } else {
        sidebar.classList.remove("visible");
      }
    }
    window.addEventListener("resize", initSidebar);
    initSidebar();
  });