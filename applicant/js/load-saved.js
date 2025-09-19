const savedTheme = localStorage.getItem("theme") || "light";
document.documentElement.setAttribute("data-theme", savedTheme);
// console.log("Saved theme:", savedTheme);

const savedSidebarState =
  localStorage.getItem("sidebar-collapsed") || "expanded";
document.documentElement.setAttribute("data-state", savedSidebarState);

document.addEventListener("DOMContentLoaded", () =>{
  const themeIcon1 = document.getElementById("themeIcon");
  const themeLabel1 = document.getElementById("themeLabel");

  themeIcon1.textContent = savedTheme === "dark" ? "light_mode" : "dark_mode";
  themeLabel1.textContent = savedTheme === "dark" ? "Light mode" : "Dark mode";
});



