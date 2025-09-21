// Theme toggle functionality
function toggleTheme() {
  const themeToggle = document.getElementById("themeToggle");
  const icon = themeToggle.querySelector(".material-symbols-outlined");
  const html = document.documentElement;
  const currentTheme = html.getAttribute("data-theme");
  const newTheme = currentTheme === "dark" ? "light" : "dark";
  html.setAttribute("data-theme", newTheme);

  if (newTheme === "dark") {
    icon.textContent = "light_mode";
    Chart.defaults.color = "#94a3b8";
    Chart.defaults.borderColor = "#334155";
  } else {
    icon.textContent = "dark_mode";
    Chart.defaults.color = "#64748b";
    Chart.defaults.borderColor = "#e2e8f0";
  }

  // Update all charts
  applicantsChart.update();
  employersChart.update();
  hiresChart.update();
  sexChart.update();
  ageChart.update();
}
