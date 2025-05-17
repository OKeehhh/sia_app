<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Calendar - Weather Weather</title>
  <?php
  $title = 'Calendar - Weather Weather';
  $header_title = 'Calendar';
  $this->load->view('templates/header');
  ?>
  <style> 
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      background: #f4f4f4;
      color: #333;
    }

    .calendar-container {
      max-width: 1200px;
      margin: 2em auto;
      padding: 1em;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      position: relative;
    }

    .create-event-btn {
      position: absolute;
      right: 1em;
      top: 1em;
      background: #5e35b1;
      color: white;
      border: none;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      font-size: 1.5em;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
      transition: background-color 0.3s ease;
    }

    .create-event-btn:hover {
      background: #4527a0;
    }

    .time-options {
      margin: 1em 0;
      padding: 1em;
      background: #f5f5f5;
      border-radius: 4px;
    }

    .time-options label {
      display: block;
      margin-bottom: 0.5em;
      color: #333;
    }

    .time-options input[type="radio"] {
      margin-right: 0.5em;
    }

    .time-inputs {
      display: none;
      margin-top: 1em;
    }

    .time-inputs.show {
      display: block;
    }

    .time-inputs .time-group {
      display: flex;
      gap: 1em;
      margin-bottom: 1em;
    }

    .time-inputs .time-group label {
      flex: 1;
    }

    .time-inputs .time-group input {
      flex: 2;
    }

    .calendar-header {
      text-align: center;
      margin-bottom: 1em;
    }

    .year-toggle, .month-toggle {
        text-align: center;
        margin-bottom: 1em;
    }

    .year-toggle button, .month-toggle button {
      background: #5e35b1;
      color: white;
      border: none;
      padding: 0.5em 1.2em;
      margin: 0 5px;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

     .year-toggle button:hover, .month-toggle button:hover {
        background: #4527a0;
     }

    .calendar-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 0.75em;
    }

    .day-name-header {
      font-weight: bold;
      text-align: center;
      padding: 0.5em 0;
      background-color: #ede7f6;
      border-radius: 8px;
      font-size: 0.9em;
      color: #333;
    }

    .sunday-header {
      color: #e57373;
    }

    .day-card {
      background: #f8f1fb;
      border-radius: 12px;
      padding: 0.5em;
      aspect-ratio: 1 / 1;
      display: flex;
      flex-direction: column;
      justify-content: start;
      overflow: hidden;
      box-shadow: 0 0 5px rgba(0,0,0,0.05);
      border: 1px solid #ede7f6;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .day-card:hover {
      background: #f3e5f5;
    }

    .day-card.empty {
      cursor: default;
      background: #f5f5f5;
    }

    .day-card.empty:hover {
      background: #f5f5f5;
    }

    .day-number {
      font-weight: bold;
      margin-bottom: 0.3em;
      flex-shrink: 0;
      text-align: center;
      color: #333;
    }

    .day-card.current-day {
        border: 2px solid #5e35b1;
        background-color: #e3f2fd;
    }

    .day-card.sunday-day {
        background-color: #ffebee;
    }

    .event-list {
      flex-grow: 1;
      overflow-y: auto;
      padding-right: 4px;
    }

    .event-box, .holiday-box {
      background: white;
      border: 1px solidrgb(70, 39, 127);
      padding: 0.5em;
      margin-top: 0.4em;
      border-radius: 8px;
      font-size: 0.85em;
      cursor: pointer;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      transition: background-color 0.3s ease;
    }

    .event-box:hover, .holiday-box:hover {
      background-color: #f3e5f5;
    }

    .event-box h4, .holiday-box h4 {
      margin: 0;
      font-size: 0.9em;
      color: #333;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .event-box p, .holiday-box p {
      margin: 0.2em 0;
      font-size: 0.75em;
      color: #555;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .event-box p:first-of-type, .holiday-box p:first-of-type {
      max-width: 100%;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .event-box p:last-of-type, .holiday-box p:last-of-type {
      margin-top: 0.3em;
      color: #666;
    }

    .holiday-box {
      border: 1px solid #ffcc80;
      background: #fff3e0;
    }

    .holiday-box:hover {
      background-color: #ffe0b2;
    }

    .holiday-box h4 {
        color: #e65100;
    }

    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background-color: #fff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 500px;
      position: relative;
    }

    .modal-content input[type="text"],
    .modal-content input[type="date"],
    .modal-content textarea {
      width: 100%;
      padding: 0.5em;
      margin: 0.5em 0 1em 0;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 1em;
    }

    .modal-content textarea {
      min-height: 100px;
      resize: vertical;
    }

    .modal-content .time-options {
      margin: 1em 0;
      padding: 1em;
      background: #f5f5f5;
      border-radius: 4px;
      border: 1px solid #ddd;
    }

    .modal-content .time-options label {
      display: flex;
      align-items: center;
      margin-bottom: 0.5em;
      color: #333;
      cursor: pointer;
    }

    .modal-content .time-options input[type="radio"] {
      margin-right: 0.5em;
      cursor: pointer;
      width: auto;
      margin-top: 0;
      margin-bottom: 0;
    }

    .modal-content .time-inputs {
      display: none;
      margin-top: 1em;
      padding: 1em;
      background: #fff;
      border-radius: 4px;
      border: 1px solid #ddd;
    }

    .modal-content .time-inputs.show {
      display: block;
    }

    .modal-content .time-inputs .time-group {
      display: flex;
      gap: 1em;
      margin-bottom: 1em;
      align-items: center;
    }

    .modal-content .time-inputs .time-group label {
      flex: 1;
      margin-bottom: 0;
      display: block;
    }

    .modal-content .time-inputs .time-group input {
      flex: 2;
      padding: 0.5em;
      border: 1px solid #ddd;
      border-radius: 4px;
      width: auto;
      margin-top: 0;
      margin-bottom: 0;
    }

    .modal-content .modal-buttons {
      display: flex;
      gap: 1rem;
      margin-top: 1.5rem;
      justify-content: flex-end;
    }

    .modal-content .modal-buttons button {
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 500;
      transition: background-color 0.2s;
    }

    .modal-close {
      position: absolute;
      right: 1rem;
      top: 1rem;
      font-size: 1.5rem;
      cursor: pointer;
      color: #666;
    }

    .modal-close:hover {
      color: #333;
    }

    .modal h3 {
      margin-top: 0;
      color: #333;
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .modal p {
      margin: 0.75rem 0;
      color: #555;
    }

    .modal strong {
      color: #333;
    }

    .modal-buttons {
      display: flex;
      gap: 1rem;
      margin-top: 1.5rem;
      justify-content: flex-end;
    }

    .modal button {
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 500;
      transition: background-color 0.2s;
    }

    #editButton {
      background-color: #4CAF50;
      color: white;
    }

    #editButton:hover {
      background-color: #45a049;
    }

    #updateButton {
      background-color: #2196F3;
      color: white;
    }

    #updateButton:hover {
      background-color: #1976D2;
    }

    #deleteButton {
      background-color: #f44336;
      color: white;
    }

    #deleteButton:hover {
      background-color: #d32f2f;
    }

    .form-group {
      margin-bottom: 1em;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5em;
      color: #333;
    }

    .form-group input[type="text"],
    .form-group input[type="date"],
    .form-group textarea {
      width: 100%;
      padding: 0.5em;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 1em;
    }

    .form-group textarea {
      min-height: 100px;
      resize: vertical;
    }

    .time-options {
      margin: 1em 0;
      padding: 1em;
      background: #f5f5f5;
      border-radius: 4px;
    }

    .time-options label {
      display: block;
      margin-bottom: 0.5em;
      color: #333;
      cursor: pointer;
    }

    .time-options input[type="radio"] {
      margin-right: 0.5em;
      cursor: pointer;
    }

    .time-inputs {
      display: none;
      margin-top: 1em;
      padding: 1em;
      background: #fff;
      border-radius: 4px;
      border: 1px solid #ddd;
    }

    .time-inputs.show {
      display: block;
    }

    .time-inputs .time-group {
      display: flex;
      gap: 1em;
      margin-bottom: 1em;
      align-items: center;
    }

    .time-inputs .time-group label {
      flex: 1;
      margin-bottom: 0;
    }

    .time-inputs .time-group input {
      flex: 2;
      padding: 0.5em;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .submit-btn {
      background: #5e35b1;
      color: white;
      border: none;
      padding: 0.75em 1.5em;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
      background: #4527a0;
    }

    /* Profile Modal Styles */
    .profile-modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .profile-content {
      background-color: #fff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 500px;
      position: relative;
    }

    .profile-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .profile-header h2 {
      color: #333;
      margin-bottom: 1rem;
    }

    .profile-info {
      margin-bottom: 2rem;
    }

    .profile-info p {
      margin: 0.5rem 0;
      color: #555;
    }

    .profile-info strong {
      color: #333;
      margin-right: 0.5rem;
    }

    .profile-actions {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .profile-actions button {
      padding: 0.75rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 500;
      transition: background-color 0.2s;
    }

    .change-password-btn {
      background-color: #2196F3;
      color: white;
    }

    .change-password-btn:hover {
      background-color: #1976D2;
    }

    .delete-account-btn {
      background-color: #f44336;
      color: white;
    }

    .delete-account-btn:hover {
      background-color: #d32f2f;
    }

    .logout-btn {
      background-color: #757575;
      color: white;
    }

    .logout-btn:hover {
      background-color: #616161;
    }
  </style>
</head>
<body>
  <div class="calendar-container">
    <div class="calendar-header">
      <?php
        $monthName = date('F', mktime(0, 0, 0, $current_month, 10)); // Get full month name
      ?>
      <h2><?= $monthName . ' ' . $current_year ?> <span id="yearMonthPickerIcon" style="cursor: pointer;" title="Select Year and Month">📅</span></h2>
      <div class="year-toggle" style="display: none;">
          <!-- Removed Previous/Next Year buttons -->
      </div>
      <div class="month-toggle">
          <button onclick="location.href='<?= site_url('webservice/calendar/' . ($current_month == 1 ? $current_year - 1 : $current_year) . '/' . ($current_month == 1 ? 12 : $current_month - 1)) ?>'">&lt;&lt;</button>
          <button onclick="location.href='<?= site_url('webservice/calendar') ?>'">⦿</button>
          <button onclick="location.href='<?= site_url('webservice/calendar/' . ($current_month == 12 ? $current_year + 1 : $current_year) . '/' . ($current_month == 12 ? 1 : $current_month + 1)) ?>'">&gt;&gt;</button>
      </div>
    </div>

    <!-- Year and Month Picker Modal -->
    <div id="yearMonthPickerModal" class="modal" style="z-index: 20;">
      <div class="modal-content">
        <span class="modal-close" onclick="closeYearMonthPickerModal()">&times;</span>
        <h3>Select Year and Month</h3>
        <label for="selectYear">Year:</label>
        <select id="selectYear" name="selectYear" style="width: 100%; margin-bottom: 1em;">
          <?php for ($y = 2020; $y <= 2030; $y++): ?>
            <option value="<?= $y ?>" <?= ($y == $current_year) ? 'selected' : '' ?>><?= $y ?></option>
          <?php endfor; ?>
        </select>
        <label for="selectMonth">Month:</label>
        <select id="selectMonth" name="selectMonth" style="width: 100%; margin-bottom: 1em;">
          <?php for ($m = 1; $m <= 12; $m++): ?>
            <option value="<?= $m ?>" <?= ($m == $current_month) ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $m, 1)) ?></option>
          <?php endfor; ?>
        </select>
        <button onclick="goToSelectedYearMonth()" class="year-toggle button">Go</button>
      </div>
    </div>

    <div class="calendar-grid">
      <?php
      // Array of day names starting with Sunday
      $dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

      // Print day name headers
      foreach ($dayNames as $name) {
          $class = ($name === 'Sun') ? 'day-name-header sunday-header' : 'day-name-header';
          echo "<div class='{$class}'>{$name}</div>";
      }

      // Get the first day of the month (1 for Monday, 7 for Sunday) adjusted for the grid (0 for Sunday, 6 for Saturday)
      $firstDayOfMonth = date('N', mktime(0, 0, 0, $current_month, 1, $current_year));
      $startDay = ($firstDayOfMonth == 7) ? 0 : $firstDayOfMonth;

      // Get the number of days in the month
      $daysInMonth = date('t', mktime(0, 0, 0, $current_month, 1, $current_year));

      // Print empty cells for days before the first day of the month
      for ($i = 0; $i < $startDay; $i++) {
          echo "<div class='day-card empty'></div>";
      }

      // Group activities by day
      $eventsByDay = [];
      if (!empty($activities)) {
        foreach ($activities as $activity) {
          $day = (int)date('j', strtotime($activity['date']));
          // Ensure the event is for the current month and year being displayed
          if (date('Y', strtotime($activity['date'])) == $current_year && date('n', strtotime($activity['date'])) == $current_month) {
               $eventsByDay[$day][] = $activity;
          }
        }
      }

      // Add holidays to the events array
      if (!empty($holidays)) {
        foreach ($holidays as $day => $holiday) {
          if (!isset($eventsByDay[$day])) {
            $eventsByDay[$day] = [];
          }
          $eventsByDay[$day][] = $holiday;
        }
      }

      for ($day = 1; $day <= $daysInMonth; $day++) {
        // Check if this day is the current date
        $isCurrentDay = ($day == date('j') && $current_month == date('n') && $current_year == date('Y'));
        // Check if this day is a Sunday (0 for Sunday)
        $timestamp = mktime(0, 0, 0, $current_month, $day, $current_year);
        $isSunday = date('w', $timestamp) == 0;

        $dayCardClass = 'day-card';
        if ($isCurrentDay) {
            $dayCardClass .= ' current-day';
        }
        if ($isSunday) {
            $dayCardClass .= ' sunday-day';
        }

        echo "<div class='{$dayCardClass}' onclick='handleDayCardClick(event, \"{$current_year}-{$current_month}-{$day}\")'>";
        echo "<div class='day-number'>{$day}</div>";
        echo "<div class='event-list'>";

        if (isset($eventsByDay[$day])) {
          foreach ($eventsByDay[$day] as $event) {
            // Properly escape and format the data for JavaScript
            $title = str_replace(["\n", "\r"], ' ', addslashes(htmlspecialchars($event['title'])));
            $desc = str_replace(["\n", "\r"], ' ', addslashes(htmlspecialchars($event['description'])));
            $date = htmlspecialchars($event['date']);
            $time = htmlspecialchars($event['time']);
            $isHoliday = isset($event['is_holiday']) && $event['is_holiday'];
            $boxClass = $isHoliday ? 'holiday-box' : 'event-box';
            $eventId = isset($event['id']) ? $event['id'] : '';

            // Use json_encode to properly escape the data
            $eventData = json_encode([
              'title' => $title,
              'desc' => $desc,
              'date' => $date,
              'time' => $time,
              'id' => $eventId
            ]);

            echo "<div class='{$boxClass}' data-event-id='{$eventId}' onclick='showEventModalFromData({$eventData})'>";
            echo "<h4>{$title}</h4>";
            echo "<p>{$desc}</p>";
            echo "<p>{$date} - {$time}</p>";
            echo "</div>";
          }
        }

        echo "</div></div>";
      }

      // Print empty cells for days after the last day of the month to complete the grid (up to 6 weeks)
      $totalDaysDisplayed = $startDay + $daysInMonth;
      $remainingCells = 42 - $totalDaysDisplayed; // 6 rows * 7 days = 42
      if ($remainingCells < 0) $remainingCells = 0;

      for ($i = 0; $i < $remainingCells; $i++) {
          echo "<div class='day-card empty'></div>";
      }

      ?>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal" id="eventModal">
    <div class="modal-content">
      <span class="modal-close" onclick="closeEventModal()">&times;</span>
      <h3 id="modalTitle"></h3>
      <div id="viewMode">
        <div class="form-group">
          <label><strong>Title:</strong></label>
          <p id="modalTitle"></p>
        </div>

        <div class="form-group">
          <label><strong>Description:</strong></label>
          <p id="modalDesc"></p>
        </div>

        <div class="form-group">
          <label><strong>Date:</strong></label>
          <p id="modalDate"></p>
        </div>

        <div class="form-group">
          <label><strong>Time:</strong></label>
          <div class="time-options">
            <div id="modalTimeDisplay"></div>
          </div>
        </div>

        <div class="modal-buttons">
          <button id="editButton" onclick="toggleEditMode()">Edit</button>
          <button id="deleteButton" onclick="deleteEvent()">Delete</button>
        </div>
      </div>
      <div id="editMode" style="display: none;">
        <div class="form-group">
          <label for="editTitle"><strong>Title:</strong></label>
          <input type="text" id="editTitle" required>
        </div>

        <div class="form-group">
          <label for="editDesc"><strong>Description:</strong></label>
          <textarea id="editDesc" required></textarea>
        </div>

        <div class="form-group">
          <label for="editDate"><strong>Date:</strong></label>
          <input type="date" id="editDate" required>
        </div>

        <div class="time-options">
          <label>
            <input type="radio" name="editTimeOption" value="allDay" checked onchange="toggleEditTimeInputs('allDay')">
            All Day
          </label>
          <label>
            <input type="radio" name="editTimeOption" value="specificTime" onchange="toggleEditTimeInputs('specificTime')">
            Specific Time
          </label>

          <div id="editTimeInputs" class="time-inputs">
            <div class="time-group">
              <label for="editStartTime">Start Time:</label>
              <input type="time" id="editStartTime" name="editStartTime">
            </div>
            <div class="time-group">
              <label for="editEndTime">End Time:</label>
              <input type="time" id="editEndTime" name="editEndTime">
            </div>
          </div>
        </div>

        <div class="modal-buttons">
          <button id="editButton" onclick="toggleEditMode()">Edit</button>
          <button id="updateButton" onclick="updateEvent()">Update</button>
          <button id="deleteButton" onclick="deleteEvent()">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Create Event Modal -->
  <div class="modal" id="createEventModal">
    <div class="modal-content">
      <span class="modal-close" onclick="closeCreateEventModal()">&times;</span>
      <h3>Create New Event</h3>
      <form id="createEventForm" method="post" action="<?= site_url('activity/create') ?>">
        <div class="form-group">
          <label for="eventTitle">Title:</label>
          <input type="text" id="eventTitle" name="title" required>
        </div>

        <div class="form-group">
          <label for="eventDescription">Description:</label>
          <textarea id="eventDescription" name="description" required></textarea>
        </div>

        <div class="form-group">
          <label for="eventDate">Date:</label>
          <input type="date" id="eventDate" name="date" required>
        </div>

        <div class="time-options">
          <label>
            <input type="radio" name="timeOption" value="allDay" checked onchange="toggleTimeInputs('allDay')">
            All Day
          </label>
          <label>
            <input type="radio" name="timeOption" value="specificTime" onchange="toggleTimeInputs('specificTime')">
            Specific Time
          </label>

          <div id="timeInputs" class="time-inputs">
            <div class="time-group">
              <label for="startTime">Start Time:</label>
              <input type="time" id="startTime" name="startTime">
            </div>
            <div class="time-group">
              <label for="endTime">End Time:</label>
              <input type="time" id="endTime" name="endTime">
            </div>
          </div>
        </div>

        <div class="modal-buttons">
          <button type="submit" class="submit-btn">Create Event</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    let currentEvent = null;

    function showEventModalFromData(eventData) {
      try {
        currentEvent = eventData;
        
        // Update modal content
        document.getElementById('modalTitle').innerText = eventData.title;
        document.getElementById('modalDesc').innerText = eventData.desc;
        document.getElementById('modalDate').innerText = eventData.date;
        
        // Handle time display
        const timeDisplay = document.getElementById('modalTimeDisplay');
        if (eventData.time === 'All Day') {
          timeDisplay.innerHTML = '<p>All Day</p>';
        } else {
          const [startTime, endTime] = eventData.time.split(' - ');
          timeDisplay.innerHTML = `
            <div class="time-group">
              <label>Start Time:</label>
              <p>${startTime}</p>
            </div>
            <div class="time-group">
              <label>End Time:</label>
              <p>${endTime}</p>
            </div>
          `;
        }
        
        // Reset edit mode
        document.getElementById('viewMode').style.display = 'block';
        document.getElementById('editMode').style.display = 'none';
        document.getElementById('editButton').style.display = 'block';
        document.getElementById('updateButton').style.display = 'none';
        
        // Show/hide buttons based on whether it's a holiday
        const isHoliday = !eventData.id;
        document.getElementById('editButton').style.display = isHoliday ? 'none' : 'block';
        document.getElementById('deleteButton').style.display = isHoliday ? 'none' : 'block';
        
        // Show the modal
        const modal = document.getElementById('eventModal');
        modal.style.display = 'flex';
        
        // Add debug logging
        console.log('Modal opened with event:', currentEvent);
      } catch (error) {
        console.error('Error opening modal:', error);
        alert('Error opening event details. Please try again.');
      }
    }

    function toggleEditMode() {
      const viewMode = document.getElementById('viewMode');
      const editMode = document.getElementById('editMode');
      const editButton = document.getElementById('editButton');
      const updateButton = document.getElementById('updateButton');
      
      if (viewMode.style.display !== 'none') {
        // Switch to edit mode
        viewMode.style.display = 'none';
        editMode.style.display = 'block';
        editButton.style.display = 'none';
        updateButton.style.display = 'block';
        
        // Populate edit fields
        document.getElementById('editTitle').value = currentEvent.title;
        document.getElementById('editDesc').value = currentEvent.desc;
        document.getElementById('editDate').value = currentEvent.date;
        
        // Handle time options
        const time = currentEvent.time;
        if (time === 'All Day') {
          document.querySelector('input[name="editTimeOption"][value="allDay"]').checked = true;
          toggleEditTimeInputs('allDay');
        } else {
          document.querySelector('input[name="editTimeOption"][value="specificTime"]').checked = true;
          const [startTime, endTime] = time.split(' - ');
          document.getElementById('editStartTime').value = startTime;
          document.getElementById('editEndTime').value = endTime;
          toggleEditTimeInputs('specificTime');
        }
      } else {
        // Switch to view mode
        viewMode.style.display = 'block';
        editMode.style.display = 'none';
        editButton.style.display = 'block';
        updateButton.style.display = 'none';
        
        // Update view mode content
        document.getElementById('modalTitle').innerText = currentEvent.title;
        document.getElementById('modalDesc').innerText = currentEvent.desc;
        document.getElementById('modalDate').innerText = currentEvent.date;
        
        // Update time display
        const timeDisplay = document.getElementById('modalTimeDisplay');
        if (currentEvent.time === 'All Day') {
          timeDisplay.innerHTML = '<p>All Day</p>';
        } else {
          const [startTime, endTime] = currentEvent.time.split(' - ');
          timeDisplay.innerHTML = `
            <div class="time-group">
              <label>Start Time:</label>
              <p>${startTime}</p>
            </div>
            <div class="time-group">
              <label>End Time:</label>
              <p>${endTime}</p>
            </div>
          `;
        }
      }
    }

    function toggleEditTimeInputs(option) {
      const timeInputs = document.getElementById('editTimeInputs');
      if (option === 'specificTime') {
        timeInputs.classList.add('show');
        document.getElementById('editStartTime').required = true;
        document.getElementById('editEndTime').required = true;
      } else {
        timeInputs.classList.remove('show');
        document.getElementById('editStartTime').required = false;
        document.getElementById('editEndTime').required = false;
      }
    }

    function updateEvent() {
      const newTitle = document.getElementById('editTitle').value;
      const newDesc = document.getElementById('editDesc').value;
      const newDate = document.getElementById('editDate').value;
      
      // Handle time
      let newTime;
      const timeOption = document.querySelector('input[name="editTimeOption"]:checked').value;
      if (timeOption === 'allDay') {
        newTime = 'All Day';
      } else {
        const startTime = document.getElementById('editStartTime').value;
        const endTime = document.getElementById('editEndTime').value;
        newTime = `${startTime} - ${endTime}`;
      }
      
      // Create form data
      const formData = new FormData();
      formData.append('id', currentEvent.id);
      formData.append('title', newTitle);
      formData.append('description', newDesc);
      formData.append('date', newDate);
      formData.append('time', newTime);
      
      // Send update request
      fetch('<?= site_url('activity/update') ?>', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Update the current event data
          currentEvent = { 
            title: newTitle, 
            desc: newDesc, 
            date: newDate, 
            time: newTime,
            id: currentEvent.id 
          };
          
          // Update the modal display
          document.getElementById('modalTitle').innerText = newTitle;
          document.getElementById('modalDesc').innerText = newDesc;
          document.getElementById('modalDate').innerText = newDate;
          
          // Update time display
          const timeDisplay = document.getElementById('modalTimeDisplay');
          if (newTime === 'All Day') {
            timeDisplay.innerHTML = '<p>All Day</p>';
          } else {
            const [startTime, endTime] = newTime.split(' - ');
            timeDisplay.innerHTML = `
              <div class="time-group">
                <label>Start Time:</label>
                <p>${startTime}</p>
              </div>
              <div class="time-group">
                <label>End Time:</label>
                <p>${endTime}</p>
              </div>
            `;
          }
          
          // Update the event box in the calendar
          const eventBox = document.querySelector(`[data-event-id="${currentEvent.id}"]`);
          if (eventBox) {
            eventBox.querySelector('h4').innerText = newTitle;
            eventBox.querySelector('p:first-of-type').innerText = newDesc;
            eventBox.querySelector('p:last-of-type').innerText = `${newDate} - ${newTime}`;
          }
          
          // Switch back to view mode
          toggleEditMode();
          
          // Show success message
          alert('Event updated successfully!');
        } else {
          throw new Error(data.error || 'Failed to update event');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Failed to update event. Please try again.');
      });
    }

    function deleteEvent() {
      if (confirm('Are you sure you want to delete this event?')) {
        const formData = new FormData();
        formData.append('id', currentEvent.id);
        
        fetch('<?= site_url('activity/delete') ?>', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Remove the event box from the calendar
            const eventBox = document.querySelector(`[data-event-id="${currentEvent.id}"]`);
            if (eventBox) {
              eventBox.remove();
            }
            closeEventModal();
          } else {
            alert('Failed to delete event: ' + (data.error || 'Unknown error'));
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Failed to delete event. Please try again.');
        });
      }
    }

    function closeEventModal() {
      document.getElementById('eventModal').style.display = 'none';
      currentEvent = null;
    }

    // JavaScript for Year and Month Picker Modal
    const yearMonthPickerModal = document.getElementById('yearMonthPickerModal');
    const yearMonthPickerIcon = document.getElementById('yearMonthPickerIcon');
    const selectYear = document.getElementById('selectYear');
    const selectMonth = document.getElementById('selectMonth');

    yearMonthPickerIcon.onclick = function() {
      yearMonthPickerModal.style.display = 'flex';
    }

    function closeYearMonthPickerModal() {
      yearMonthPickerModal.style.display = 'none';
    }

    function goToSelectedYearMonth() {
      const selectedYear = selectYear.value;
      const selectedMonth = selectMonth.value;
      window.location.href = '<?= site_url('webservice/calendar/') ?>' + selectedYear + '/' + selectedMonth;
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
      const eventModal = document.getElementById('eventModal');
      if (event.target === eventModal) {
        closeEventModal();
      }
      if (event.target === yearMonthPickerModal) {
          closeYearMonthPickerModal();
      }
    }

    function showCreateEventModalForDate(date) {
      document.getElementById('createEventModal').style.display = 'flex';
      document.getElementById('eventDate').value = date;
    }

    function showCreateEventModal() {
      document.getElementById('createEventModal').style.display = 'flex';
      // Set default date to today
      document.getElementById('eventDate').valueAsDate = new Date();
    }

    function closeCreateEventModal() {
      document.getElementById('createEventModal').style.display = 'none';
    }

    function toggleTimeInputs(option) {
      const timeInputs = document.getElementById('timeInputs');
      if (option === 'specificTime') {
        timeInputs.classList.add('show');
        document.getElementById('startTime').required = true;
        document.getElementById('endTime').required = true;
      } else {
        timeInputs.classList.remove('show');
        document.getElementById('startTime').required = false;
        document.getElementById('endTime').required = false;
      }
    }

    // Add form submission handler
    document.getElementById('createEventForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(this);
      const timeOption = formData.get('timeOption');
      
      // Set time based on option
      if (timeOption === 'allDay') {
        formData.set('time', 'All Day');
      } else {
        const startTime = formData.get('startTime');
        const endTime = formData.get('endTime');
        formData.set('time', `${startTime} - ${endTime}`);
      }
      
      // Remove unnecessary fields
      formData.delete('timeOption');
      formData.delete('startTime');
      formData.delete('endTime');
      
      // Submit the form
      fetch('<?= site_url('activity/create') ?>', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Create new event box
          const eventDate = formData.get('date');
          const day = new Date(eventDate).getDate();
          const eventBox = document.createElement('div');
          eventBox.className = 'event-box';
          eventBox.setAttribute('data-event-id', data.id);
          
          const title = formData.get('title');
          const desc = formData.get('description');
          const time = formData.get('time');
          
          eventBox.innerHTML = `
            <h4>${title}</h4>
            <p>${desc}</p>
            <p>${eventDate} - ${time}</p>
          `;
          
          // Add click handler
          eventBox.onclick = function() {
            showEventModalFromData({
              title: title,
              desc: desc,
              date: eventDate,
              time: time,
              id: data.id
            });
          };
          
          // Find the correct day card and append the event
          const dayCards = document.querySelectorAll('.day-card');
          dayCards.forEach(card => {
            const dayNumber = card.querySelector('.day-number');
            if (dayNumber && parseInt(dayNumber.textContent) === day) {
              const eventList = card.querySelector('.event-list');
              if (eventList) {
                eventList.appendChild(eventBox);
              }
            }
          });
          
          // Close the create modal
          closeCreateEventModal();
          
          // Show success message
          alert('Event created successfully!');
        } else {
          throw new Error(data.error || 'Failed to create event');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Failed to create event. Please try again.');
      });
    });

    function handleDayCardClick(event, date) {
      // If the click was on an event box, don't show the create modal
      if (event.target.closest('.event-box') || event.target.closest('.holiday-box')) {
        return;
      }
      
      // If the click was on the day card itself, show the create modal
      showCreateEventModalForDate(date);
    }
  </script>
</body>
</html>
