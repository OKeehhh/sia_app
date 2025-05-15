<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Weather Weather</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .register-box {
      background: white;
      padding: 2em;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 300px;
    }

    .register-box h2 {
      text-align: center;
      margin-bottom: 1em;
    }

    .register-box input {
      width: 95%;
      padding: 0.5em;
      margin: 0.5em 0;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    .register-box button {
      width: 100%;
      padding: 0.5em;
      background: #5e35b1;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .register-box button:hover {
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
    }

    .link-button a:hover {
      text-decoration: underline;
    }

    .error {
      color: red;
      font-size: 0.85em;
    }
  </style>
</head>
<body>
  <div class="register-box">
    <h2>Register</h2>
    <?php echo validation_errors('<div class="error">', '</div>'); ?>
    <form method="post" action="<?= site_url('register/create_account') ?>">
      <input type="text" name="first_name" placeholder="First Name" required />
      <input type="text" name="last_name" placeholder="Last Name" required />
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <input type="password" name="confirm_password" placeholder="Confirm Password" required />
      <button type="submit">Register Account</button>
    </form>
    <div class="link-button">
      <a href="<?= site_url('login') ?>">Back to Login</a>
    </div>
  </div>
</body>
</html>
