<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Weather and Holiday Dashboard</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
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
      background: #5e35b1;
      color: white;
      border: none;
      padding: 0.5em 1em;
      margin-left: 1em;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .top-menu button:hover {
      background: #4527a0;
    }

    .forecast {
      display: flex;
      justify-content: center;
      gap: 10px;
      padding: 2em;
      background: #fff;
    }

    .day {
      background: #1e1e1e;
      color: white;
      border-radius: 12px;
      padding: 1em;
      text-align: center;
      width: 80px;
    }

    .day-name {
      font-weight: bold;
      margin-bottom: 0.5em;
    }

    .weather-icon {
      width: 40px;
      height: 40px;
    }

    .temp-range {
      font-size: 0.85em;
      color: #ccc;
    }

    .events-section {
      display: flex;
      justify-content: space-evenly;
      flex-wrap: wrap;
      padding: 2em;
    }

    .event-card {
      background: #f8f1fb;
      border-radius: 12px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      width: 230px;
      margin: 1em;
      overflow: hidden;
    }

    .event-header {
      background: #ede7f6;
      padding: 0.75em;
      font-weight: bold;
      font-size: 0.9em;
    }

    .event-content {
      padding: 1em;
      font-size: 0.85em;
    }

    .event-time {
      color: #555;
      font-size: 0.8em;
      margin-top: 0.5em;
    }

    .event-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.75em 1em;
    }

    .tag {
      background: #d1c4e9;
      padding: 0.25em 0.75em;
      border-radius: 999px;
      font-size: 0.75em;
    }

    .finish-button {
      background: #5e35b1;
      color: white;
      border: none;
      padding: 0.3em 0.8em;
      border-radius: 8px;
      font-size: 0.75em;
      cursor: pointer;
    }

    .add-btn, .modal { display: none; }
  </style>
</head>
<body>

  <header>
    <h1>Weather Holiday Dashboard</h1>
    <div class="top-menu">
      <button onclick="location.href='<?= site_url('webservice/forecast') ?>'">Home</button>
      <button onclick="location.href='<?= site_url('webservice/calendar') ?>'">Calendar</button>
      <button onclick="location.href='<?= site_url('webservice/about') ?>'">About</button>
      <button onclick="location.href='<?= site_url('login/logout') ?>'">Logout</button>
    </div>
  </header>

  <div class="forecast" id="forecast">
    <?php
    $weatherIcons = [
      0 => "https://openweathermap.org/img/wn/01d.png",
      1 => "https://openweathermap.org/img/wn/02d.png",
      2 => "https://openweathermap.org/img/wn/03d.png",
      3 => "https://openweathermap.org/img/wn/04d.png",
      45 => "https://openweathermap.org/img/wn/50d.png",
      48 => "https://openweathermap.org/img/wn/50d.png",
      51 => "https://openweathermap.org/img/wn/09d.png",
      61 => "https://openweathermap.org/img/wn/10d.png",
      71 => "https://openweathermap.org/img/wn/13d.png",
      80 => "https://openweathermap.org/img/wn/09d.png",
      95 => "https://openweathermap.org/img/wn/11d.png",
    ];

    if (isset($weather['daily']['time'])) {
      for ($i = 0; $i < 7; $i++) {
        $date = new DateTime($weather['daily']['time'][$i]);
        $dayName = $i === 0 ? "Today" : $date->format('D');
        $icon = $weatherIcons[$weather['daily']['weathercode'][$i]] ?? $weatherIcons[0];
        $tempMax = round($weather['daily']['temperature_2m_max'][$i]);
        $tempMin = round($weather['daily']['temperature_2m_min'][$i]);
        echo "
          <div class='day'>
            <div class='day-name'>{$dayName}</div>
            <img src='{$icon}' class='weather-icon' />
            <div class='temp-range'>{$tempMax}° / {$tempMin}°</div>
          </div>
        ";
      }
    } else {
      echo "<p>Failed to load forecast data.</p>";
    }
    ?>
  </div>

  <?php
  $philippineHolidays = [
    ['name' => 'Labor Day', 'description' => 'Regular holiday to celebrate workers.', 'date' => '2025-05-01', 'time' => '00:00'],
    ['name' => 'Eid al-Fitr', 'description' => 'Feast of the end of Ramadan (movable date).', 'date' => '2025-05-29', 'time' => '00:00'],
    ['name' => 'Barrio Fiesta', 'description' => 'Local town celebrations.', 'date' => '2025-05-15', 'time' => '00:00'],
    ['name' => 'Flores de Mayo', 'description' => 'Month-long Catholic devotion to the Virgin Mary.', 'date' => '2025-05-01', 'time' => 'All Day'],
    ['name' => 'Santacruzan', 'description' => 'Finale parade of Flores de Mayo.', 'date' => '2025-05-31', 'time' => '17:00'],
  ];

  $currentMonth = 5;
  $currentMonthName = 'May';

  $holidaysThisMonth = array_filter($philippineHolidays, function($holiday) use ($currentMonth) {
    return date('m', strtotime($holiday['date'])) == $currentMonth;
  });
  ?>

  <h2 style="text-align:center; margin-top: 1em;">Holidays in <?= $currentMonthName ?> (Philippines)</h2>

  <div class="events-section" id="events">
    <?php foreach ($holidaysThisMonth as $holiday): ?>
      <div class="event-card">
        <div class="event-header"><?= htmlspecialchars($holiday['name']) ?></div>
        <div class="event-content">
          <p><?= htmlspecialchars($holiday['description']) ?></p>
          <div class="event-time">📅 <?= htmlspecialchars($holiday['date']) ?> 🕒 <?= htmlspecialchars($holiday['time']) ?></div>
        </div>
        <div class="event-footer">
          <span class="tag">Official</span>
          <button class="finish-button">Done</button>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</body>
</html>
