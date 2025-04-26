const loginForm = document.querySelector(".login-form");
const signupForm = document.querySelector(".signup-form");
const loginTab = document.querySelector(".login-tab");
const signupTab = document.querySelector(".signup-tab");
const termsLink = document.getElementById("termsLink");
const termsModal = document.getElementById("termsModal");
const closeModal = document.querySelector(".close");
const acceptTerms = document.getElementById("acceptTerms");
const termsCheckbox = document.getElementById("terms");
const signupBtn = document.getElementById("signupBtn");
const loginBtn = document.getElementById("loginBtn");

function showTab(tabName) {
  if (tabName === "login") {
    loginForm.classList.add("active");
    signupForm.classList.remove("active");
    loginTab.classList.add("active");
    signupTab.classList.remove("active");
  } else {
    signupForm.classList.add("active");
    loginForm.classList.remove("active");
    signupTab.classList.add("active");
    loginTab.classList.remove("active");
  }
}

termsLink.addEventListener("click", () => {
  termsModal.style.display = "flex";
});

closeModal.addEventListener("click", () => {
  termsModal.style.display = "none";
});

acceptTerms.addEventListener("click", () => {
  termsCheckbox.checked = true;
  termsModal.style.display = "none";
});

window.addEventListener("click", (e) => {
  if (e.target === termsModal) {
    termsModal.style.display = "none";
  }
});


const modal = document.getElementById("forgotPasswordModal");
const closeBtn = document.querySelector(".close-modal");
const loginLink = document.querySelector(".login-link");

function openForgotPasswordModal() {
  modal.style.display = "flex";
}

function closeForgotPasswordModal() {
  modal.style.display = "none";
}

closeBtn.addEventListener("click", closeForgotPasswordModal);
loginLink.addEventListener("click", function (e) {
//   e.preventDefault();
  closeForgotPasswordModal();
});

window.addEventListener("click", function (e) {
  if (e.target === modal) {
    closeForgotPasswordModal();
  }
});

