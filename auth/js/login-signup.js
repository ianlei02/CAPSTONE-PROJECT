const loginForm = document.querySelector(".login-form");
const signupForm = document.querySelector(".signup-form");
const termsLink = document.getElementById("termsLink");
const termsModal = document.getElementById("termsModal");
const closeModal = document.querySelector(".close");
const acceptTerms = document.getElementById("acceptTerms");
const termsCheckbox = document.getElementById("terms");
const signupBtn = document.getElementById("signupBtn");
const loginBtn = document.getElementById("loginBtn");
const welcomeText = document.getElementById("welcomeText");
const subText = document.getElementById("subText");
const illustration = document.querySelector(".illustration img");

function showTab(tabName) {
  if (tabName === "login") {
    loginForm.classList.add("active");
    signupForm.classList.remove("active");
    welcomeText.textContent = "Welcome Back!"
    subText.textContent = "Sign in to access your personalized dashboard..."
    illustration.src = "../public/svg/login.svg";
  } else {
    signupForm.classList.add("active");
    loginForm.classList.remove("active");
    welcomeText.textContent = "Join Us Today!"
    subText.textContent = "Create an account to get started with our services..."
    illustration.src = "../public/svg/signup.svg";
  }
}

const urlParams = new URLSearchParams(window.location.search);
const formType = urlParams.get("form");


function showForm(tab) {
  console.log(`Switching to ${tab} tab`);
  if (tab === "login") {
    loginForm.classList.add("active");
    signupForm.classList.remove("active");
  } else if (tab === "signup") {
    signupForm.classList.add("active");
    loginForm.classList.remove("active");
  } else {
    console.error(`Unknown tab: ${tab}`);
  }
}
if (formType === "signup") {
  showForm("signup");
} else {
  showForm("login");
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

//password ruules modal
const passwordRules = document.getElementById("password-rules");
const passwordModal = document.getElementById("password-rules-modal");
const closePasswordModal = document.querySelector(
  "#password-rules-modal .close"
);
const closePasswordModal1 = document.querySelector(
  "#password-rules-modal .modal-footer .close"
);

passwordRules.addEventListener("click", () => {
  passwordModal.style.display = "flex";
});

closePasswordModal.addEventListener("click", () => {
  passwordModal.style.display = "none";
});
closePasswordModal1.addEventListener("click", (e) => {
  e.preventDefault();
  passwordModal.style.display = "none";
});

window.addEventListener("click", function (e) {
  if (e.target === passwordModal) {
    passwordModal.style.display = "none";
  }
});

//passwrd strength
const signupPasswordInput = document.getElementById("signupPassword");
const strengthBar = document.getElementById("strength-bar");
const strengthText = document.getElementById("strength-text");

signupPasswordInput.addEventListener("input", () => {
  const password = signupPasswordInput.value;
  let strength = 0;

  if (password.length >= 8) strength++;
  if (/[A-Z]/.test(password)) strength++;
  if (/[a-z]/.test(password)) strength++;
  if (/[0-9]/.test(password)) strength++;
  // if (/[^A-Za-z0-9]/.test(password)) strength++;
  console.log(strength);

  if (strength === 1) {
    strengthBar.style.width = "5%";
    strengthBar.className = "weak";
    strengthText.textContent = "Very Weak";
  } else if (strength === 2) {
    strengthBar.style.width = "12.5%";
    strengthBar.className = "weak";
    strengthText.textContent = "Weak";
  } else if (strength === 3) {
    strengthBar.style.width = "25%";
    strengthBar.className = "medium";
    strengthText.textContent = "Medium";
  } else if (strength === 4) {
    strengthBar.style.width = "40%";
    strengthBar.className = "strong";
    strengthText.textContent = "Strong";
  } else {
    strengthBar.style.width = "";
    strengthBar.className = "";
    strengthText.textContent = "";
  }
});
