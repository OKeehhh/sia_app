<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register - Weather Weather</title>
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

    .register-box {
      background: white;
      padding: 2em;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px; /* max width on bigger screens */
      box-sizing: border-box;
      margin: 1em;
    }

    .register-box h2 {
      text-align: center;
      margin-bottom: 1em;
      color: #5e35b1;
      font-weight: bold;
    }

    .register-box label {
      display: block;
      margin-bottom: 0.3em;
      font-weight: bold;
      color: #333;
    }

    .register-box input[type="text"],
    .register-box input[type="password"] {
      width: 100%;
      padding: 0.5em;
      margin-bottom: 1em;
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
      font-size: 1em;
    }

    .register-box input[type="submit"] {
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

    .register-box input[type="submit"]:hover {
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

    .error-message {
      color: red;
      font-size: 0.9em;
      text-align: center;
      margin-bottom: 1em;
      white-space: pre-wrap;
    }
  </style>
</head>
<body>

  <div class="register-box">
    <h2>Register</h2>

    <?php if (validation_errors()): ?>
      <div class="error-message"><?= validation_errors() ?></div>
    <?php endif; ?>

    <?= form_open('register/create_account') ?>

      <label for="first_name">First Name:</label>
      <input type="text" id="first_name" name="first_name" required>

      <label for="last_name">Last Name:</label>
      <input type="text" id="last_name" name="last_name" required>

      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" required>

      <input type="submit" value="Register">

    <?= form_close() ?>

    <div class="link-button">
      <a href="<?= site_url('login') ?>">Already have an account? Login</a>
    </div>
  </div>

</body>
</html>
