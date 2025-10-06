document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.querySelector("aside .hamburger");
  const hamburger1 = document.querySelector("nav .hamburger");
  const body = document.body;
  const html = document.documentElement;
  const sidebar = document.querySelector(".sidebar");

  function isMobile() {
    return window.matchMedia("(max-width: 767px)").matches;
  }

  hamburger.addEventListener("click", () => {
    if (isMobile()) {
      sidebar.classList.toggle("visible");
    } else {
      const currentState = html.getAttribute("data-state");
      const newState = currentState === "expanded" ? "collapsed" : "expanded";
      html.setAttribute("data-state", newState);
      localStorage.setItem("sidebar-collapsed", newState);
    }
  });
  hamburger1.addEventListener("click", () => {
    sidebar.classList.toggle("visible");
  });
});
