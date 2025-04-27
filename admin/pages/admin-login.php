<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Portal | Login</title>
  <style>
    :root {
      --primary: #4361ee;
      --primary-dark: #3a56d4;
      --accent: #7209b7;
      --text: #2b2d42;
      --light-text: #8d99ae;
      --border: #edf2f4;
      --white: #ffffff;
      --bg-gradient: linear-gradient(135deg, #4361ee 0%, #7209b7 100%);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", system-ui, sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: var(--bg-gradient);
      padding: 20px;
    }

    .login-card {
      width: 100%;
      max-width: 420px;
      background: var(--white);
      border-radius: 16px;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      padding: 48px;
      position: relative;
      z-index: 1;
    }

    .login-card::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: var(--bg-gradient);
      opacity: 0.05;
      z-index: -1;
      transform: rotate(15deg);
    }

    .login-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .login-header h1 {
      font-size: 28px;
      color: var(--text);
      margin-bottom: 12px;
      font-weight: 700;
      background: var(--bg-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      display: inline-block;
    }

    .login-header p {
      font-size: 15px;
      color: var(--light-text);
    }

    .login-form {
      margin-top: 30px;
    }

    .form-group {
      margin-bottom: 24px;
      position: relative;
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
      padding: 16px 20px;
      font-size: 15px;
      border: 2px solid var(--border);
      border-radius: 10px;
      transition: all 0.3s ease;
      background-color: #f9fafb;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.15);
      background-color: var(--white);
    }

    .btn {
      width: 100%;
      padding: 16px;
      border: none;
      border-radius: 10px;
      background: var(--bg-gradient);
      color: var(--white);
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 10px;
      position: relative;
      overflow: hidden;
    }

    .btn::after {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(rgba(255, 255, 255, 0.1),
          rgba(255, 255, 255, 0.1));
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .btn:hover::after {
      opacity: 1;
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
      transition: color 0.3s ease;
    }

    .form-footer a:hover {
      color: var(--accent);
    }

    /* Floating label animation */
    .floating-label {
      position: relative;
    }

    .floating-label label {
      position: absolute;
      top: 18px;
      left: 20px;
      color: var(--light-text);
      transition: all 0.3s ease;
      pointer-events: none;
    }

    .floating-label input:focus+label,
    .floating-label input:not(:placeholder-shown)+label {
      top: -8px;
      left: 12px;
      font-size: 12px;
      background: var(--white);
      padding: 0 8px;
      color: var(--primary);
    }

    /* Responsive */
    @media (max-width: 480px) {
      .login-card {
        padding: 40px 30px;
        border-radius: 12px;
      }
    }
  </style>
</head>

<body>
  <div class="login-card">
    <div class="login-header">
      <h1>Admin Portal</h1>
      <p>Sign in to access your dashboard</p>
    </div>

    <form class="login-form" action="/admin/dashboard" method="POST">
      <div class="form-group floating-label">
        <input
          type="text"
          id="username"
          name="username"
          class="form-control"
          placeholder=" "
          required />
        <label for="username">Username</label>
      </div>

      <div class="form-group floating-label">
        <input
          type="password"
          id="password"
          name="password"
          class="form-control"
          placeholder=" "
          required />
        <label for="password">Password</label>
      </div>

      <button type="submit" class="btn">Sign In →</button>

      <div class="form-footer">
        <a href="/forgot-password">Forgot your password?</a>
      </div>
    </form>
  </div>
</body>

</html>