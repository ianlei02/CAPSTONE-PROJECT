// Sample data for the charts
const months = [
  "Jan",
  "Feb",
  "Mar",
  "Apr",
  "May",
  "Jun",
  "Jul",
  "Aug",
  "Sep",
  "Oct",
  "Nov",
  "Dec",
];

// Applicants data
const monthlyApplicants = [
  120, 150, 180, 200, 240, 320, 350, 400, 380, 410, 450, 500,
];
const cumulativeApplicants = monthlyApplicants.map(
  (
    (sum) => (value) =>
      (sum += value)
  )(0)
);

// Employers data
const monthlyEmployers = [15, 18, 22, 25, 30, 35, 40, 45, 50, 52, 55, 60];
const cumulativeEmployers = monthlyEmployers.map(
  (
    (sum) => (value) =>
      (sum += value)
  )(0)
);

// Hires and Vacancies data
const monthlyHires = [25, 30, 35, 40, 45, 60, 65, 70, 75, 80, 85, 90];
const monthlyVacancies = [
  120, 135, 145, 160, 180, 210, 230, 250, 270, 290, 310, 340,
];

// Sex distribution data
 // Male, Female

// Age range data


// Initialize charts after the page loads
document.addEventListener("DOMContentLoaded", function () {
  // Set Chart.js default colors based on theme
  const isDarkMode = document.body.classList.contains("dark-mode");
  Chart.defaults.color = isDarkMode ? "#94a3b8" : "#64748b";
  Chart.defaults.borderColor = isDarkMode ? "#334155" : "#e2e8f0";

  // Increase font sizes for better readability
  Chart.defaults.font.size = 14;
  Chart.defaults.plugins.tooltip.bodyFont = { size: 14 };
  Chart.defaults.plugins.tooltip.titleFont = { size: 16 };
  Chart.defaults.plugins.legend.labels.font = { size: 14 };

  // Applicants Chart
  const applicantsChart = new Chart(
    document.getElementById("applicantsChart"),
    {
      type: "bar",
      data: {
        labels: months,
        datasets: [
          {
            label: "Monthly Applicants",
            data: monthlyApplicants,
            backgroundColor: "rgba(79, 70, 229, 0.7)",
            borderColor: "rgba(79, 70, 229, 1)",
            borderWidth: 1,
            borderRadius: 6,
            barPercentage: 0.6,
          },
          {
            label: "Cumulative Applicants",
            data: cumulativeApplicants,
            type: "line",
            fill: true,
            backgroundColor: "rgba(239, 68, 68, 0.1)",
            borderColor: "rgba(239, 68, 68, 1)",
            borderWidth: 2,
            tension: 0.2,
            pointRadius: 4,
            pointHoverRadius: 6,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "top",
            labels: {
              usePointStyle: true,
              padding: 20,
              font: {
                size: 14,
              },
            },
          },
          tooltip: {
            mode: "index",
            intersect: false,
            bodyFont: {
              size: 14,
            },
            titleFont: {
              size: 16,
            },
          },
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              drawBorder: false,
            },
            ticks: {
              font: {
                size: 13,
              },
            },
          },
          x: {
            grid: {
              display: false,
            },
            ticks: {
              font: {
                size: 13,
              },
            },
          },
        },
      },
    }
  );

  // Employers Chart
  const employersChart = new Chart(document.getElementById("employersChart"), {
    type: "bar",
    data: {
      labels: months,
      datasets: [
        {
          label: "Monthly Employers",
          data: monthlyEmployers,
          backgroundColor: "rgba(16, 185, 129, 0.7)",
          borderColor: "rgba(16, 185, 129, 1)",
          borderWidth: 1,
          borderRadius: 6,
          barPercentage: 0.6,
        },
        {
          label: "Cumulative Employers",
          data: cumulativeEmployers,
          type: "line",
          fill: true,
          backgroundColor: "rgba(139, 92, 246, 0.1)",
          borderColor: "rgba(139, 92, 246, 1)",
          borderWidth: 2,
          tension: 0.2,
          pointRadius: 4,
          pointHoverRadius: 6,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: "top",
          labels: {
            usePointStyle: true,
            padding: 20,
            font: {
              size: 14,
            },
          },
        },
        tooltip: {
          mode: "index",
          intersect: false,
          bodyFont: {
            size: 14,
          },
          titleFont: {
            size: 16,
          },
        },
      },
      scales: {
        y: {
          beginAtZero: true,
          grid: {
            drawBorder: false,
          },
          ticks: {
            font: {
              size: 13,
            },
          },
        },
        x: {
          grid: {
            display: false,
          },
          ticks: {
            font: {
              size: 13,
            },
          },
        },
      },
    },
  });

  // Hires & Vacancies Chart
  const hiresChart = new Chart(document.getElementById("hiresChart"), {
    type: "bar",
    data: {
      labels: months,
      datasets: [
        {
          label: "Monthly Hires",
          data: monthlyHires,
          backgroundColor: "rgba(59, 130, 246, 0.7)",
          borderColor: "rgba(59, 130, 246, 1)",
          borderWidth: 1,
          borderRadius: 6,
          barPercentage: 0.6,
          categoryPercentage: 0.5,
        },
        {
          label: "Job Vacancies",
          data: monthlyVacancies,
          backgroundColor: "rgba(239, 68, 68, 0.7)",
          borderColor: "rgba(239, 68, 68, 1)",
          borderWidth: 1,
          borderRadius: 6,
          barPercentage: 0.6,
          categoryPercentage: 0.5,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: "top",
          labels: {
            usePointStyle: true,
            padding: 20,
            font: {
              size: 14,
            },
          },
        },
        tooltip: {
          bodyFont: {
            size: 14,
          },
          titleFont: {
            size: 16,
          },
        },
      },
      scales: {
        y: {
          beginAtZero: true,
          grid: {
            drawBorder: false,
          },
          ticks: {
            font: {
              size: 13,
            },
          },
          title: {
            display: true,
            text: "Number of Positions",
            font: {
              size: 14,
            },
          },
        },
        x: {
          grid: {
            display: false,
          },
          ticks: {
            font: {
              size: 13,
            },
          },
        },
      },
    },
  });

  // Sex Distribution Chart
    fetch("../Function/fetch-sex.php")
        .then(response => response.json())
        .then(data => {
          const sexData = [data.Male, data.Female];
    new Chart(document.getElementById("sexChart"), {
    type: "doughnut",
    data: {
      labels: ["Male", "Female"],
      datasets: [
        {
          label: "Sex Distribution",
          data: sexData,
          backgroundColor: [
            "rgba(59, 130, 246, 0.7)",
            "rgba(236, 72, 153, 0.7)",
          ],
          borderColor: ["rgba(59, 130, 246, 1)", "rgba(236, 72, 153, 1)"],
          borderWidth: 1,
          hoverOffset: 12,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: "top",
          labels: {
            usePointStyle: true,
            padding: 20,
            font: {
              size: 14,
            },
          },
        },
        tooltip: {
          bodyFont: {
            size: 14,
          },
          titleFont: {
            size: 16,
          },
        },
      },
      cutout: "70%",
    },
  });
})

  // Age Range Chart
  fetch("../Function/fetch-age.php")
  .then(response => response.json())
  .then(data => {
    const ageLabels = ["18-24", "25-59", "60+"];

    new Chart(document.getElementById("ageChart"), {
      type: "bar",
      data: {
        labels: ageLabels,
        datasets: [
          {
            label: "Age Distribution",
            data: [data["18-24"], data["25-59"], data["60+"]],
            backgroundColor: [
              "rgba(59, 130, 246, 0.7)",
              "rgba(16, 185, 129, 0.7)",
              "rgba(139, 92, 246, 0.7)",
            ],
            borderColor: [
              "rgba(59, 130, 246, 1)",
              "rgba(16, 185, 129, 1)",
              "rgba(139, 92, 246, 1)",
            ],
            borderWidth: 1,
            borderRadius: 6,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "top",
            labels: {
              usePointStyle: true,
              padding: 20,
              font: {
                size: 14,
              },
            },
          },
          tooltip: {
            bodyFont: {
              size: 14,
            },
            titleFont: {
              size: 16,
            },
          },
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              drawBorder: false,
            },
            ticks: {
              font: {
                size: 13,
              },
            },
          },
          x: {
            grid: {
              display: false,
            },
            ticks: {
              font: {
                size: 13,
              },
            },
          },
        },
      },
    });
  })
});
