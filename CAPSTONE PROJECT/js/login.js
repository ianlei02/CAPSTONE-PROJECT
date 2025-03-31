
document.getElementById('show-applicant-signup').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('login-container').style.display = 'none';
    document.getElementById('signup-container').style.display = 'block';
    document.getElementById('employer-signup-toggle').classList.remove('active');
    document.getElementById('applicant-signup-toggle').classList.add('active');
    document.getElementById('employer-signup-form').classList.remove('active');
    document.getElementById('applicant-signup-form').classList.add('active');
});

document.getElementById('show-employer-signup').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('login-container').style.display = 'none';
    document.getElementById('signup-container').style.display = 'block';
    document.getElementById('applicant-signup-toggle').classList.remove('active');
    document.getElementById('employer-signup-toggle').classList.add('active');
    document.getElementById('applicant-signup-form').classList.remove('active');
    document.getElementById('employer-signup-form').classList.add('active');
});

document.getElementById('show-applicant-login').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('signup-container').style.display = 'none';
    document.getElementById('login-container').style.display = 'block';

    document.getElementById('employer-login-toggle').classList.remove('active');
    document.getElementById('applicant-login-toggle').classList.add('active');
    document.getElementById('employer-login-form').classList.remove('active');
    document.getElementById('applicant-login-form').classList.add('active');
});
document.getElementById('show-employer-login').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('signup-container').style.display = 'none';
    document.getElementById('login-container').style.display = 'block';
    document.getElementById('applicant-login-toggle').classList.remove('active');
    document.getElementById('employer-login-toggle').classList.add('active');
    document.getElementById('applicant-login-form').classList.remove('active');
    document.getElementById('employer-login-form').classList.add('active');
});

document.getElementById('applicant-login-toggle').addEventListener('click', function() {
    this.classList.add('active');
    document.getElementById('employer-login-toggle').classList.remove('active');
    document.getElementById('applicant-login-form').classList.add('active');
    document.getElementById('employer-login-form').classList.remove('active');
});

document.getElementById('employer-login-toggle').addEventListener('click', function() {
    this.classList.add('active');
    document.getElementById('applicant-login-toggle').classList.remove('active');
    document.getElementById('employer-login-form').classList.add('active');
    document.getElementById('applicant-login-form').classList.remove('active');
});

document.getElementById('applicant-signup-toggle').addEventListener('click', function() {
    this.classList.add('active');
    document.getElementById('employer-signup-toggle').classList.remove('active');
    document.getElementById('applicant-signup-form').classList.add('active');
    document.getElementById('employer-signup-form').classList.remove('active');
});

document.getElementById('employer-signup-toggle').addEventListener('click', function() {
    this.classList.add('active');
    document.getElementById('applicant-signup-toggle').classList.remove('active');
    document.getElementById('employer-signup-form').classList.add('active');
    document.getElementById('applicant-signup-form').classList.remove('active');
});

const termsModal = document.getElementById('terms-modal');
const closeModal = document.querySelector('.close-modal');

document.getElementById('applicant-terms-link').addEventListener('click', function() {
    termsModal.style.display = 'flex';
});

document.getElementById('employer-terms-link').addEventListener('click', function() {
    termsModal.style.display = 'flex';
});
closeModal.addEventListener('click', function() {
    termsModal.style.display = 'none';
});
window.addEventListener('click', function(event) {
    if (event.target === termsModal) {
        termsModal.style.display = 'none';
    }
});
document.getElementById('applicant-login').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Applicant login form submitted');
});
document.getElementById('employer-login').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Employer login form submitted');
});
document.getElementById('applicant-signup').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Applicant signup form submitted');
});
document.getElementById('employer-signup').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Employer signup form submitted');
});
document.getElementById('applicant-forgot-password').addEventListener('click', function(e) {
    e.preventDefault();
    alert('Password reset link will be sent to applicant email');
});
document.getElementById('employer-forgot-password').addEventListener('click', function(e) {
    e.preventDefault();
    alert('Password reset link will be sent to employer email');
});