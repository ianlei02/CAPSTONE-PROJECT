// Event listeners for modals
document.addEventListener("DOMContentLoaded", function () {
  // Pending Employer modal
  const pendingEmployerModal = document.getElementById("pendingEmployerModal");
  pendingEmployerModal.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget;
    const employerId = button.getAttribute("data-id");
    const data = employerData[employerId];

    document.getElementById("employer-company-name").textContent =
      data.companyName;
    document.getElementById("employer-contact").textContent =
      data.contactPerson;
    document.getElementById("employer-email").textContent = data.email;
    document.getElementById("employer-phone").textContent = data.phone;
    document.getElementById("employer-industry").textContent = data.industry;
    document.getElementById("employer-size").textContent = data.companySize;
    document.getElementById("employer-website").textContent = data.website;

    const statusBadge = document.getElementById("employer-status");
    statusBadge.textContent = data.status;
    statusBadge.className = `status-badge ${
      data.status === "Verified" ? "badge-verified" : "badge-pending"
    }`;
  });
  // Verified Employer modal
  const verifiedEmployerModal = document.getElementById(
    "verifiedEmployerModal"
  );
  verifiedEmployerModal.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget;
    const employerId = button.getAttribute("data-id");
    const data = employerData[employerId];

    document.getElementById("employer-company-name").textContent =
      data.companyName;
    document.getElementById("employer-contact").textContent =
      data.contactPerson;
    document.getElementById("employer-email").textContent = data.email;
    document.getElementById("employer-phone").textContent = data.phone;
    document.getElementById("employer-industry").textContent = data.industry;
    document.getElementById("employer-size").textContent = data.companySize;
    document.getElementById("employer-website").textContent = data.website;

    const statusBadge = document.getElementById("employer-status");
    statusBadge.textContent = data.status;
    statusBadge.className = `status-badge ${
      data.status === "Verified" ? "badge-verified" : "badge-pending"
    }`;
  });

  // Action buttons event listeners
  document
    .getElementById("verifyEmployer")
    .addEventListener("click", function () {
      alert("Employer verification process initiated.");
    });

  document
    .getElementById("rejectEmployer")
    .addEventListener("click", function () {
      alert("Employer rejection process initiated.");
    });
});
