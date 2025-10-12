function toggleTheme() {
  const html = document.documentElement;
  const themeIcon = document.getElementById("themeIcon");
  const themeLabel = document.getElementById("themeLabel");
  const currentTheme = html.getAttribute("data-theme");
  const newTheme = currentTheme === "dark" ? "light" : "dark";
  html.setAttribute("data-theme", newTheme);
  console.log("Theme toggled to:", newTheme);
  localStorage.setItem("theme", newTheme);
  newTheme === "dark" ? themeIcon.setAttribute("data-lucide", "sun") : themeIcon.setAttribute("data-lucide", "moon");
  lucide.createIcons();
}
const savedTheme = localStorage.getItem("theme") || "light";
document.documentElement.setAttribute("data-theme", savedTheme);
