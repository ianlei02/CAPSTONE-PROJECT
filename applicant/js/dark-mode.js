function toggleTheme() {
  const html = document.documentElement;
  const themeIcon = document.getElementById('themeIcon');
  const themeLabel = document.getElementById('themeLabel');
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