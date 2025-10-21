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
  
  lucide.createIcons();

  //DROP DOWN
  const profilePic = document.querySelector(".navbar .profile");
  const dropdownMenu = document.getElementById("dropdownMenu");

  profilePic.addEventListener("click", function (e) {
    e.stopPropagation();
    dropdownMenu.classList.toggle("active");
  });
  document.addEventListener("click", function (e) {
    if (!profilePic.contains(e.target) && !dropdownMenu.contains(e.target)) {
      dropdownMenu.classList.remove("active");
    }
  });
  dropdownMenu.addEventListener("click", function (e) {
    e.stopPropagation();
  });
});
//DARK MODE
function toggleTheme() {
  const html = document.documentElement;
  const themeIcon = document.getElementById("themeIcon");
  const themeLabel = document.getElementById("themeLabel");
  const currentTheme = html.getAttribute("data-theme");
  const newTheme = currentTheme === "dark" ? "light" : "dark";
  html.setAttribute("data-theme", newTheme);
  console.log("Theme toggled to:", newTheme);
  localStorage.setItem("theme", newTheme);
  if (newTheme === "dark") {
    themeIcon.textContent = "light_mode";
    themeLabel.textContent = "Light Mode";
  } else {
    themeIcon.textContent = "dark_mode";
    themeLabel.textContent = "Dark Mode";
  }
}
