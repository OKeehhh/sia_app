<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Weather and Holiday Dashboard</title>
  <?php
  $title = 'Weather and Holiday Dashboard';
  $header_title = 'Weather and Holiday Dashboard';
  $this->load->view('templates/header');
  ?>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      background: #ffffff;
      color: #000;
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
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 0.75em;
      padding: 0.75em;
      max-width: 900px;
      width: 700px;
      height: 450px;
      margin: 0 auto;
      justify-content: center;
      align-content: flex-start;
      overflow-y: auto;
    }

    .event-card {
      background: #f8f1fb;
      border-radius: 12px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      width: 100%;
      margin: 0;
      overflow: hidden;
    }

    .event-header {
      background: #ede7f6;
      padding: 0.5em 0.75em;
      font-weight: bold;
      font-size: 0.9em;
    }

    .event-content {
      padding: 0.75em;
      font-size: 0.85em;
    }

    .event-time {
      color: #555;
      font-size: 0.8em;
      margin-top: 0.3em;
    }

    .event-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.5em 0.75em;
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

    /* Create Activity styles */
    .create-activity-btn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background: #5e35b1;
      color: white;
      border: none;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      font-size: 28px;
      cursor: pointer;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      transition: background 0.3s ease;
    }
    .create-activity-btn:hover {
      background: #4527a0;
    }
    .activity-modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0; top: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }
    .activity-modal .modal-content {
      background: white;
      padding: 20px;
      border-radius: 10px;
      width: 350px;
      position: relative;
    }
    .activity-modal .modal-close {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 1.2em;
      cursor: pointer;
    }
    .modal-content input, .modal-content textarea, .modal-content select {
      width: 100%;
      padding: 0.6em;
      margin-top: 0.5em;
      margin-bottom: 1em;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    .holiday-item {
      padding: 0.8em;
      margin: 0.5em 0;
      border-radius: 8px;
      background: #fff3e0;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .holiday-item:hover {
      background: #ffe0b2;
    }
    .holiday-item strong {
      color: #e65100;
    }
    .holiday-modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }
    .holiday-modal .modal-content {
      background: white;
      padding: 25px;
      border-radius: 12px;
      width: 400px;
      max-width: 90%;
      position: relative;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .holiday-modal .modal-header {
      border-bottom: 2px solid #ffe0b2;
      padding-bottom: 15px;
      margin-bottom: 15px;
    }
    .holiday-modal .modal-header h3 {
      color: #e65100;
      margin: 0;
    }
    .holiday-modal .modal-date {
      color: #666;
      font-size: 0.9em;
      margin-top: 5px;
    }
    .holiday-modal .modal-description {
      line-height: 1.6;
      color: #333;
    }
    .holiday-modal .modal-close {
      position: absolute;
      top: 15px;
      right: 15px;
      font-size: 1.5em;
      cursor: pointer;
      color: #666;
    }
    .modal-content h3 {
      margin-top: 0;
    }

    .activity-details-buttons {
      margin-top: 20px;
      text-align: right;
    }

    .activity-details-buttons button {
      display: inline-block; /* Ensure buttons are displayed */
      margin-left: 10px; /* Adjust spacing between buttons */
    }

    .activity-details-buttons button:first-child {
      margin-left: 0; /* No left margin for the first button */
    }

    .activity-details-description {
      word-wrap: break-word; /* Allow long words to break */
      white-space: normal; /* Ensure text wraps */
    }

    .activity-modal .time-options {
      margin: 1em 0;
      padding: 1em;
      background: #f5f5f5;
      border-radius: 4px;
    }

    .activity-modal .time-options label {
      display: flex;
      align-items: center;
      margin-bottom: 0.5em;
      color: #333;
      cursor: pointer;
    }

    .activity-modal .time-options input[type="radio"] {
      margin-right: 0.5em;
      cursor: pointer;
      width: auto;
      margin-top: 0;
      margin-bottom: 0;
    }

    .activity-modal .time-inputs {
      display: none;
      margin-top: 1em;
      padding: 1em;
      background: #fff;
      border-radius: 4px;
      border: 1px solid #ddd;
    }

    .activity-modal .time-inputs.show {
      display: block;
    }

    .activity-modal .time-inputs .time-group {
      display: flex;
      gap: 1em;
      margin-bottom: 1em;
      align-items: center;
    }

    .activity-modal .time-inputs .time-group label {
      flex: 1;
      margin-bottom: 0;
      display: block;
    }

    .activity-modal .time-inputs .time-group input {
      flex: 2;
      padding: 0.5em;
      border: 1px solid #ddd;
      border-radius: 4px;
      width: auto;
      margin-top: 0;
      margin-bottom: 0;
    }
  </style>
  <!-- Add Font Awesome for the profile icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <div class="forecast">
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
  $currentMonth = date('n');
  $currentMonthName = date('F');
  ?>

  <h2 style="text-align:center; margin-top: 1em;">Philippine Holidays on <?= $currentMonthName ?></h2>

  <div class="events-section" id="events">
    <?php if (!empty($holidays)): ?>
      <?php foreach ($holidays as $day => $holiday): ?>
        <div class="event-card">
          <div class="event-header"><?= htmlspecialchars($holiday['title']) ?></div>
          <div class="event-content">
            <p><?= htmlspecialchars($holiday['description']) ?></p>
            <div class="event-time">
              📅 <?= date('F j, Y', strtotime($holiday['date'])) ?>
            </div>
          </div>
          <div class="event-footer">
            <span class="tag">Official Holiday</span>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="event-card">
        <div class="event-header">No Holidays</div>
        <div class="event-content">
          <p>There are no official holidays this month.</p>
        </div>
      </div>
    <?php endif; ?>

    <?php if (!empty($activities)): ?>
      <?php foreach ($activities as $activity): ?>
        <div class="event-card" onclick="showActivityDetailsModal('<?= htmlspecialchars(json_encode($activity)) ?>')">
          <div class="event-header"><?= htmlspecialchars($activity['title']) ?></div>
          <div class="event-content">
            <?= htmlspecialchars($activity['description']) ?>
            <div class="event-time">
              <?= date('F j, Y', strtotime($activity['date'])) ?> at <?= $activity['time'] ?>
            </div>
          </div>
          <div class="event-footer">
            <span class="tag"><?= $activity['status'] ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <button class="create-activity-btn" onclick="showActivityModal()">+</button>

  <!-- Holiday Details Modal -->
  <div class="holiday-modal" id="holidayModal">
    <div class="modal-content">
      <span class="modal-close" onclick="closeHolidayModal()">&times;</span>
      <div class="modal-header">
        <h3 id="holidayTitle"></h3>
        <div class="modal-date" id="holidayDate"></div>
      </div>
      <div class="modal-description" id="holidayDescription"></div>
    </div>
  </div>

  <!-- Activity Details Modal -->
  <div id="activityDetailsModal" class="modal">
    <div class="modal-content">
      <span class="modal-close" onclick="closeActivityDetailsModal()">&times;</span>
      <h3 id="activityTitle"></h3>
      <div id="viewMode">
        <p><strong>Description:</strong> <span id="activityDescription"></span></p>
        <p><strong>Date:</strong> <span id="activityDate"></span></p>
        <p><strong>Time:</strong> <span id="activityTime"></span></p>
        <p><strong>Status:</strong> <span id="activityStatus"></span></p>
      </div>
      <div id="editMode" style="display: none;">
        <label>Title</label>
        <input type="text" id="editTitle" required>

        <label>Description</label>
        <textarea id="editDescription" required></textarea>

        <label>Date</label>
        <input type="date" id="editDate" required>

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

        <label>Status</label>
        <select id="editStatus">
          <option value="pending">Pending</option>
          <option value="completed">Completed</option>
        </select>
      </div>
      <div class="activity-details-buttons">
        <button id="editActivityBtn" class="finish-button" style="background-color: #ff9800;" onclick="toggleEditMode()">Edit</button>
        <button id="updateActivityBtn" class="finish-button" style="background-color: #4CAF50; display: none;" onclick="updateActivity()">Update</button>
        <button id="deleteActivityBtn" class="finish-button" style="background-color: #f44336;">Delete</button>
      </div>
    </div>
  </div>

  <!-- Create Activity Modal -->
  <div class="activity-modal" id="activityModal">
    <div class="modal-content">
      <span class="modal-close" onclick="document.getElementById('activityModal').style.display='none'">&times;</span>
      <h3>Create Activity</h3>
      <form method="post" action="<?= site_url('activity/create') ?>" id="createActivityForm">
        <label>Title</label>
        <input type="text" name="title" required>

        <label>Description</label>
        <textarea name="description"></textarea>

        <label>Date</label>
        <input type="date" name="date" required>

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

        <label>Status</label>
        <select name="status">
          <option value="pending" selected>Pending</option>
          <option value="completed">Completed</option>
        </select>

        <button type="submit" class="finish-button" style="width: 100%;">Save Activity</button>
      </form>
    </div>
  </div>

  <script>
    function showHolidayModal(title, description, date) {
      document.getElementById('holidayTitle').innerText = title;
      document.getElementById('holidayDate').innerText = new Date(date).toLocaleDateString('en-US', { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
      });
      document.getElementById('holidayDescription').innerText = description;
      document.getElementById('holidayModal').style.display = 'flex';
    }

    function closeHolidayModal() {
      document.getElementById('holidayModal').style.display = 'none';
    }

    // Function to show the Create Activity Modal
    function showActivityModal() {
      document.getElementById('activityModal').style.display = 'flex';
    }

    let currentActivity = null;

    function showActivityDetailsModal(activityData) {
      const activity = JSON.parse(activityData);
      currentActivity = activity;
      
      // Update view mode
      document.getElementById('activityTitle').innerText = activity.title;
      document.getElementById('activityDescription').innerText = activity.description;
      document.getElementById('activityDate').innerText = activity.date;
      document.getElementById('activityTime').innerText = activity.time;
      document.getElementById('activityStatus').innerText = activity.status;
      
      // Reset edit mode
      document.getElementById('viewMode').style.display = 'block';
      document.getElementById('editMode').style.display = 'none';
      document.getElementById('editActivityBtn').style.display = 'block';
      document.getElementById('updateActivityBtn').style.display = 'none';
      
      // Show the modal
      document.getElementById('activityDetailsModal').style.display = 'flex';
    }

    function closeActivityDetailsModal() {
      document.getElementById('activityDetailsModal').style.display = 'none';
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

    function toggleEditMode() {
      const viewMode = document.getElementById('viewMode');
      const editMode = document.getElementById('editMode');
      const editButton = document.getElementById('editActivityBtn');
      const updateButton = document.getElementById('updateActivityBtn');
      
      if (viewMode.style.display !== 'none') {
        // Switch to edit mode
        viewMode.style.display = 'none';
        editMode.style.display = 'block';
        editButton.style.display = 'none';
        updateButton.style.display = 'block';
        
        // Populate edit fields
        document.getElementById('editTitle').value = currentActivity.title;
        document.getElementById('editDescription').value = currentActivity.description;
        document.getElementById('editDate').value = currentActivity.date;
        document.getElementById('editStatus').value = currentActivity.status;
        
        // Handle time options
        const time = currentActivity.time;
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

    function updateActivity() {
      const formData = new FormData();
      formData.append('id', currentActivity.id);
      formData.append('title', document.getElementById('editTitle').value);
      formData.append('description', document.getElementById('editDescription').value);
      formData.append('date', document.getElementById('editDate').value);
      formData.append('status', document.getElementById('editStatus').value);
      
      // Handle time
      const timeOption = document.querySelector('input[name="editTimeOption"]:checked').value;
      if (timeOption === 'allDay') {
        formData.append('time', 'All Day');
      } else {
        const startTime = document.getElementById('editStartTime').value;
        const endTime = document.getElementById('editEndTime').value;
        formData.append('time', `${startTime} - ${endTime}`);
      }
      
      // Send update request
      fetch('<?= site_url('activity/update') ?>', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          window.location.reload();
        } else {
          throw new Error(data.error || 'Failed to update activity');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Failed to update activity. Please try again.');
      });
    }

    // Add form submission handler
    document.getElementById('createActivityForm').addEventListener('submit', function(e) {
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
      .then(response => {
        if (response.ok) {
          window.location.reload();
        } else {
          throw new Error('Failed to create activity');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Failed to create activity. Please try again.');
      });
    });

    window.onclick = function(event) {
      const holidayModal = document.getElementById('holidayModal');
      const activityModal = document.getElementById('activityModal');
      const activityDetailsModal = document.getElementById('activityDetailsModal');
      if (event.target === holidayModal) {
        holidayModal.style.display = 'none';
      }
      if (event.target === activityModal) {
        activityModal.style.display = 'none';
      }
      if (event.target === activityDetailsModal) {
        activityDetailsModal.style.display = 'none';
      }
    }
  </script>
</body>
</html>
