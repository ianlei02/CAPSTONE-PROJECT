<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Portal | Login</title>
  <style>
    :root {
      --primary: oklch(55% 0.15 250);
      --primary-dark: oklch(45% 0.15 250);
      --primary-light:hsla(0, 0%, 94%, 1.00);
      --accent: oklch(60% 0.12 280);
      --text: oklch(25% 0.05 250);
      --light-text: oklch(55% 0.05 250);
      --border: oklch(85% 0.02 250);
      --white: oklch(100% 0 0);
      --shadow: 0 8px 24px oklch(0% 0 0 / 0.08);
      --radius: 12px;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Inter", "Segoe UI", system-ui, sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: oklch(98% 0.01 250);
      padding: 20px;
      color: var(--text);
    }

    .login-container {
      width: 100%;
      max-width: 420px;
      background: var(--white);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: hidden;
      border: 1px solid var(--border);
    }

    .login-header {
      padding: 40px 40px 20px;
      text-align: center;
      background-color: var(--primary-light);
      border-bottom: 1px solid var(--border);
    }

    .brand-logo {
      width: 100px;
      height: 100px;
      margin: 0 auto 20px;
      /* background-color: var(--primary); */
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      /* box-shadow: 0 4px 12px oklch(55% 0.15 250 / 0.2); */
    }

    .brand-logo img {
      width: 100px;
      height: 100px;
      fill: var(--white);
    }

    .login-header h1 {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 8px;
      color: var(--text);
    }

    .login-header p {
      font-size: 14px;
      color: var(--light-text);
    }

    .login-card {
      padding: 40px;
    }

    .login-form {
      margin-top: 10px;
    }

    .form-group {
      margin-bottom: 24px;
    }

    .form-group label {
      display: block;
      font-size: 14px;
      color: var(--text);
      margin-bottom: 8px;
      font-weight: 500;
    }

    .form-control {
      width: 100%;
      padding: 14px 16px;
      font-size: 15px;
      border: 1px solid var(--border);
      border-radius: 8px;
      transition: all 0.2s ease;
      background-color: var(--white);
      color: var(--text);
    }

    .form-control:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px oklch(55% 0.15 250 / 0.1);
    }

    .password-container {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: var(--light-text);
      font-size: 16px;
      padding: 0;
      width: 20px;
      height: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .toggle-password:hover {
      color: var(--primary);
    }

    .btn {
      width: 100%;
      padding: 14px;
      border: none;
      border-radius: 8px;
      background: var(--primary);
      color: var(--white);
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      margin-top: 10px;
    }

    .btn:hover {
      background: var(--primary-dark);
      transform: translateY(-1px);
      box-shadow: 0 4px 12px oklch(55% 0.15 250 / 0.2);
    }

    .btn:active {
      transform: translateY(0);
    }

    .form-footer {
      text-align: center;
      margin-top: 24px;
      font-size: 14px;
      color: var(--light-text);
    }

    .form-footer a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      transition: color 0.2s ease;
    }

    .form-footer a:hover {
      color: var(--primary-dark);
      text-decoration: underline;
    }

    .remember-forgot {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .remember-me {
      display: flex;
      align-items: center;
      gap: 8px;
      color: var(--light-text);
    }

    .remember-me input {
      width: 16px;
      height: 16px;
      accent-color: var(--primary);
    }

    .security-notice {
      background-color: var(--primary-light);
      border-radius: 8px;
      padding: 16px;
      margin-top: 24px;
      font-size: 13px;
      color: var(--text);
      display: flex;
      align-items: flex-start;
      gap: 12px;
    }

    .security-notice svg {
      width: 16px;
      height: 16px;
      fill: var(--primary);
      flex-shrink: 0;
      margin-top: 2px;
    }

    /* Responsive */
    @media (max-width: 480px) {
      .login-container {
        max-width: 100%;
      }

      .login-header {
        padding: 30px 20px 15px;
      }

      .login-card {
        padding: 30px 20px;
      }

      .remember-forgot {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
      }
    }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="login-header">
      <div class="brand-logo">
        <img src="../../public/smb-images/pesosmb.png" alt="">
      </div>
      <h1>Admin Portal</h1>
      <p>Secure access to management dashboard</p>
    </div>

    <div class="login-card">
      <form class="login-form" method="POST" id="loginform">
        <div class="form-group">
          <label for="username">Username</label>
          <input
            type="text"
            id="username"
            name="username"
            class="form-control"
            placeholder="Enter your username"
            required />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <div class="password-container">
            <input
              type="password"
              id="password"
              name="password"
              class="form-control"
              placeholder="Enter your password"
              required />
            <button type="button" id="togglePassword" class="toggle-password">
              <span id="toggleIcon">👁️</span>
            </button>
          </div>
        </div>

        <div class="remember-forgot">
          <div class="remember-me">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
          </div>
          <a href="forgot-password">Forgot password?</a>
        </div>

        <button type="submit" class="btn">Sign In</button>

        <div class="security-notice">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M11,7H13V9H15V11H13V13H11V11H9V9H11V7M12,17.25C13.24,17.25 14.25,16.24 14.25,15C14.25,13.76 13.24,12.75 12,12.75C10.76,12.75 9.75,13.76 9.75,15C9.75,16.24 10.76,17.25 12,17.25Z" />
          </svg>
          <div>Ensure you're on a secure network before logging in to the admin portal.</div>
        </div>

        <div class="form-footer">
          <p>Need help? <a href="">Contact Support</a></p>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordInput = document.getElementById('password');
      const icon = document.getElementById('toggleIcon');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.textContent = '🔒';
      } else {
        passwordInput.type = 'password';
        icon.textContent = '👁️';
      }
    });

    document.getElementById('loginform').addEventListener('submit', async function(e) {
      e.preventDefault();

      const submitBtn = this.querySelector('.btn');
      const originalText = submitBtn.textContent;
      
      // Show loading state
      submitBtn.textContent = 'Signing In...';
      submitBtn.disabled = true;

      const formData = new FormData(this);

      try {
        const response = await fetch('../Function/login.php', {
          method: 'POST',
          body: formData
        });

        if (!response.ok) throw new Error('Network response was not ok');

        const result = await response.json();

        if (result.status === 'success') {
          submitBtn.textContent = 'Success!';
          submitBtn.style.backgroundColor = 'oklch(50% 0.12 150)'; 
          setTimeout(() => {
            window.location.href = result.redirect;
          }, 1000);
        } else {
          submitBtn.textContent = 'Login Failed';
          submitBtn.style.backgroundColor = 'oklch(50% 0.12 30)';
          setTimeout(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
            submitBtn.style.backgroundColor = '';
          }, 2000);
          alert(result.message);
        }
      } catch (err) {
        submitBtn.textContent = 'Connection Error';
        submitBtn.style.backgroundColor = 'oklch(50% 0.12 30)'; 
        setTimeout(() => {
          submitBtn.textContent = originalText;
          submitBtn.disabled = false;
          submitBtn.style.backgroundColor = '';
        }, 2000);
        alert('Login failed. Please try again.');
      }
    });
  </script>
</body>

</html>