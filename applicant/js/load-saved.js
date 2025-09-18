const savedTheme = localStorage.getItem("theme") || "light";
document.documentElement.setAttribute("data-theme", savedTheme);
// console.log("Saved theme:", savedTheme);

const savedSidebarState =
  localStorage.getItem("sidebar-collapsed") || "expanded";
document.documentElement.setAttribute("data-state", savedSidebarState);
