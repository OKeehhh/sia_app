<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Weather Weather' ?></title>
  <!-- Header Styles -->
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      background: #f4f4f4;
      color: #333;
    }

    header {
      background: #1e1e24;
      color: white;
      padding: 1em 2em;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .top-menu {
      display: flex;
      align-items: center;
      gap: 1em;
    }

    .top-menu button {
      background: #5e35b1;
      color: white;
      border: none;
      padding: 0.5em 1em;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .top-menu button:hover {
      background: #4527a0;
    }
  </style>
</head>
<body>

<!-- Header Navigation -->
<header>
  <h1><?= $header_title ?? 'Weather Weather' ?></h1>
  <div class="top-menu">
    <button onclick="location.href='<?= site_url('webservice/forecast') ?>'">Home</button>
    <button onclick="location.href='<?= site_url('webservice/calendar') ?>'">Calendar</button>
    <button onclick="location.href='<?= site_url('webservice/about') ?>'">About</button>
  </div>
</header>
</body>
</html> 