<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About - Weather Weather</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #ffffff;
      color: #000;
    }

    header {
      background: #1e1e24;
      color: white;
      padding: 1em 2em;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .top-menu button {
      background: white;
      border: none;
      padding: 0.5em 1em;
      margin-left: 1em;
      border-radius: 4px;
      cursor: pointer;
    }

    .about-container {
      padding: 2em;
      display: flex;
      justify-content: center;
    }

    .about-card {
      background: #f3f0ff;
      border-radius: 12px;
      padding: 2em;
      max-width: 800px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .about-card h2 {
      color: #5e35b1;
      margin-bottom: 1em;
    }

    .about-card ul {
      list-style: disc;
      padding-left: 20px;
    }

    .about-card li {
      margin-bottom: 1em;
      line-height: 1.6em;
    }
  </style>
</head>
<body>

  <header>
    <h1>About Weather Weather</h1>
    <div class="top-menu">
      <button onclick="location.href='<?= site_url('webservice/consume') ?>'">Home</button>
      <button onclick="location.href='<?= site_url('webservice/calendar') ?>'">Calendar</button>
      <button onclick="location.href='<?= site_url('webservice/about') ?>'">About</button>
      <button onclick="location.href='<?= site_url('login/logout') ?>'">Logout</button>
    </div>
  </header>

  <div class="about-container">
    <div class="about-card">
      <h2>What is Weather Weather?</h2>
      <ul>
        <li><strong>7-Day Weather Forecast:</strong> Get accurate and updated weather conditions for the next 7 days to plan ahead effectively.</li>
        <li><strong>Upcoming Holidays:</strong> Stay informed about national and local holidays within the current month.</li>
        <li><strong>Personal Event Management:</strong> Create and track your personal or work-related events within the system.</li>
        <li><strong>Privacy-Centered:</strong> All events are stored securely and can only be viewed by the user who created them.</li>
      </ul>
    </div>
  </div>

</body>
</html>
