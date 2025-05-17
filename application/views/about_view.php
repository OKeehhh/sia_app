<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About - Weather Weather</title>
  <?php
  $title = 'About - Weather Weather';
  $header_title = 'About';
  $this->load->view('templates/header');
  ?>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #ffffff;
      color: #000;
    }

    .about-container {
      max-width: 800px;
      margin: 2em auto;
      padding: 2em;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    .about-container h2 {
      color: #333;
      margin-bottom: 1em;
    }

    .about-container p {
      line-height: 1.6;
      margin-bottom: 1em;
      color: #555;
    }

    .about-container ul {
      list-style-type: disc;
      margin-left: 2em;
      margin-bottom: 1em;
    }

    .about-container li {
      margin-bottom: 0.5em;
      color: #555;
    }
  </style>
</head>
<body>
  <div class="about-container">
    <h2>About Weather Weather</h2>
    <p>Welcome to Weather Weather, your comprehensive weather and holiday planning application. Our platform combines accurate weather forecasting with holiday information to help you plan your activities effectively.</p>
    
    <h2>Features</h2>
    <ul>
      <li>Real-time weather forecasts for your location</li>
      <li>Holiday calendar with important dates and events</li>
      <li>Activity planning based on weather conditions</li>
      <li>User-friendly interface for easy navigation</li>
    </ul>

    <h2>Our Mission</h2>
    <p>We aim to provide accurate and reliable weather information while helping users plan their activities and holidays effectively. Our platform is designed to make weather-based decision making simple and intuitive.</p>

    <h2>Contact</h2>
    <p>For any questions or support, please contact us at support@weatherweather.com</p>
  </div>
</body>
</html>
