document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.querySelector(".hamburger");
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
  if (isMobile()) {
    body.classList.remove("collapsed");
    sidebar.classList.remove("visible");
  } else {
    sidebar.classList.remove("visible");
  }
});
