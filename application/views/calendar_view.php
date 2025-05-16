<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Calendar - Weather Weather</title>
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

    .calendar-container {
      max-width: 1200px;
      margin: 2em auto;
      padding: 1em;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    .calendar-header {
      text-align: center;
      margin-bottom: 1em;
    }

    .year-toggle {
      text-align: center;
      margin-bottom: 2em;
    }

    .year-toggle button {
      background: #5e35b1;
      color: white;
      border: none;
      padding: 0.5em 1.2em;
      margin: 0 10px;
      border-radius: 6px;
      cursor: pointer;
    }

    .calendar-grid {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 1em;
}

.day-card {
  background: #ede7f6;
  border-radius: 8px;
  padding: 0.5em;
  aspect-ratio: 1 / 1; /* Keep it square */
  display: flex;
  flex-direction: column;
  justify-content: start;
  overflow: hidden;
}

.day-number {
  font-weight: bold;
  margin-bottom: 0.3em;
  flex-shrink: 0;
}

.event-list {
  flex-grow: 1;
  overflow-y: auto;
  padding-right: 4px;
}

.event-box {
  background: white;
  border-left: 4px solid #5e35b1;
  padding: 0.5em;
  margin-top: 0.4em;
  border-radius: 4px;
  font-size: 0.85em;
  cursor: pointer;
}

.event-box:hover {
  background-color: #f3e5f5;
}

    .event-box h4 {
      margin: 0;
      font-size: 0.9em;
      color: #333;
    }

    .event-box p {
      margin: 0.2em 0;
      font-size: 0.75em;
      color: #555;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 10;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: white;
      padding: 20px;
      border-radius: 10px;
      width: 350px;
      max-width: 90%;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
      position: relative;
    }

    .modal-close {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 1.2em;
      cursor: pointer;
      color: #333;
    }

    .modal-content h3 {
      margin-top: 0;
    }
  </style>
</head>
<body>

<header>
  <h1>Event Calendar</h1>
  <div class="top-menu">
    <button onclick="location.href='<?= site_url('webservice/forecast') ?>'">Home</button>
    <button onclick="location.href='<?= site_url('webservice/calendar') ?>'">Calendar</button>
    <button onclick="location.href='<?= site_url('webservice/about') ?>'">About</button>
    <button onclick="location.href='<?= site_url('login/logout') ?>'">Logout</button>
  </div>
</header>

<div class="calendar-container">
  <div class="calendar-header">
    <h2>May 2025</h2>
  </div>


  <div class="calendar-grid">
    <?php
    // Group activities by day
    $eventsByDay = [];
    if (!empty($activities)) {
      foreach ($activities as $activity) {
        $day = (int)date('j', strtotime($activity['date']));
        $eventsByDay[$day][] = $activity;
      }
    }

    for ($day = 1; $day <= 31; $day++) {
      echo "<div class='day-card'>";
      echo "<div class='day-number'>{$day}</div>";
      echo "<div class='event-list'>";

      if (isset($eventsByDay[$day])) {
        foreach ($eventsByDay[$day] as $event) {
          $title = htmlspecialchars($event['title']);
          $desc = htmlspecialchars($event['description']);
          $date = htmlspecialchars($event['date']);
          $time = htmlspecialchars($event['time']);

          echo "<div class='event-box' onclick=\"showEventModal('{$title}', '{$desc}', '{$date}', '{$time}')\">";
          echo "<h4>{$title}</h4>";
          echo "<p>{$desc}</p>";
          echo "<p>{$date} - {$time}</p>";
          echo "</div>";
        }
      }

      echo "</div></div>";
    }
    ?>
  </div>
</div>

<!-- Modal -->
<div class="modal" id="eventModal">
  <div class="modal-content">
    <span class="modal-close" onclick="closeEventModal()">&times;</span>
    <h3 id="modalTitle"></h3>
    <p><strong>Description:</strong> <span id="modalDesc"></span></p>
    <p><strong>Date:</strong> <span id="modalDate"></span></p>
    <p><strong>Time:</strong> <span id="modalTime"></span></p>
  </div>
</div>

<script>
  function showEventModal(title, desc, date, time) {
    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalDesc').innerText = desc;
    document.getElementById('modalDate').innerText = date;
    document.getElementById('modalTime').innerText = time;
    document.getElementById('eventModal').style.display = 'flex';
  }

  function closeEventModal() {
    document.getElementById('eventModal').style.display = 'none';
  }

  window.onclick = function(event) {
    const modal = document.getElementById('eventModal');
    if (event.target === modal) {
      closeEventModal();
    }
  }
</script>

</body>
</html>
