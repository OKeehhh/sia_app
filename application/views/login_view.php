<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login - Weather Weather</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      padding: 1em;
    }

    .login-box {
      background: white;
    padding: 2em;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px; 
    box-sizing: border-box;
    margin: 1em; 
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 1em;
      color: #5e35b1;
      font-weight: bold;
    }

    .login-box label {
      display: block;
      margin-bottom: 0.3em;
      font-weight: bold;
      color: #333;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 0.5em;
      margin-bottom: 1em;
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
      font-size: 1em;
    }

    .login-box input[type="submit"] {
      width: 100%;
      padding: 0.5em;
      background: #5e35b1;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
      font-size: 1em;
      transition: background 0.3s ease;
    }

    .login-box input[type="submit"]:hover {
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

    .message {
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
      <div class="message error"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <?= form_open('login/authenticate') ?>

      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required autofocus>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <input type="submit" value="Login">

    <?= form_close() ?>

    <div class="link-button">
      <a href="<?= site_url('register') ?>">Don't have an account? Register</a>
    </div>
  </div>

</body>
</html>
