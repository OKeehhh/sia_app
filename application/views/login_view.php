<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Weather Weather</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      background: white;
      padding: 2em;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 300px;
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 1em;
    }

    .login-box input {
      width: 95%;
      padding: 0.5em;
      margin: 0.5em 0;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    .login-box button {
      width: 100%;
      padding: 0.5em;
      background: #5e35b1;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .login-box button:hover {
      background: #4527a0;
    }

    .link-button {
      text-align: center;
      margin-top: 1em;
    }

    .link-button a {
      text-decoration: none;
      color: #5e35b1;
      font-size: 0.9em;
      transition: color 0.3s ease;
    }

    .link-button a:hover {
      text-decoration: underline;
      color: #311b92;
    }

    .error, .success {
      font-size: 0.9em;
      text-align: center;
      margin-bottom: 1em;
    }

    .error {
      color: red;
    }

    .success {
      color: green;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Login</h2>
    <?php if ($this->session->flashdata('error')): ?>
      <div class="error"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
      <div class="success"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <form method="post" action="<?= site_url('login/authenticate') ?>">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <div class="link-button">
      <a href="<?= site_url('register') ?>">No account? Register Now</a>
    </div>
  </div>
</body>
</html>
