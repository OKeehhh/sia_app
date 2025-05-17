<?php
class Webservice extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Activity_model');
    }

    private function getWeatherData() {
        $lat = "14.5995";
        $lon = "120.9842";
        $apiUrl = "https://api.open-meteo.com/v1/forecast?latitude={$lat}&longitude={$lon}&daily=temperature_2m_max,temperature_2m_min,weathercode&timezone=auto";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function forecast() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
            return;
        }

        $user_id = $this->session->userdata('user_id');
        $data['weather'] = $this->getWeatherData();

        // Get current year and month
        $currentYear = date('Y');
        $currentMonth = date('n'); // 'n' gives month without leading zeros

        $data['activities'] = $this->Activity_model->get_activities_by_user($user_id, $currentYear, $currentMonth);
        
        // Get current month's holidays
        $data['holidays'] = $this->getPhilippineHolidays($currentYear, $currentMonth);
        $data['current_month_name'] = date('F'); // Get current month name
        
        $this->load->view('dashboard_view', $data);
    }

    private function getPhilippineHolidays($year, $month) {
        // Google Calendar API endpoint for Philippine holidays
        $calendarId = 'en.philippines%23holiday%40group.v.calendar.google.com';
        $apiKey = 'AIzaSyCnoUQpu7FV8qjymfhzcWelnN0rAcyqs3I'; // Replace with your Google API key
        
        // Calculate start and end dates for the month
        $startDate = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
        $endDate = date('Y-m-t', mktime(0, 0, 0, $month, 1, $year));
        
        $url = "https://www.googleapis.com/calendar/v3/calendars/{$calendarId}/events";
        $url .= "?key={$apiKey}&timeMin={$startDate}T00:00:00Z&timeMax={$endDate}T23:59:59Z";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $holidays = json_decode($response, true);
        
        // Format holidays for our calendar view
        $formattedHolidays = [];
        if (isset($holidays['items'])) {
            foreach ($holidays['items'] as $holiday) {
                $date = date('Y-m-d', strtotime($holiday['start']['date']));
                $day = (int)date('j', strtotime($date));
                $formattedHolidays[$day] = [
                    'title' => $holiday['summary'],
                    'description' => 'Philippine Holiday',
                    'date' => $date,
                    'time' => 'All Day',
                    'is_holiday' => true
                ];
            }
        }
        
        return $formattedHolidays;
    }

    public function calendar($year = null, $month = null) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
            return;
        }

        $user_id = $this->session->userdata('user_id');
        
        // Set default year and month if not provided
        if ($year === null || $month === null) {
            $year = date('Y');
            $month = date('n'); // 'n' gives month without leading zeros
        }

        $data['current_year'] = $year;
        $data['current_month'] = $month;
        $data['activities'] = $this->Activity_model->get_activities_by_user($user_id, $year, $month);
        $data['holidays'] = $this->getPhilippineHolidays($year, $month);

        $this->load->view('calendar_view', $data);
    }

    public function about() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
            return;
        }

        $this->load->view('about_view');
    }

    public function change_password() {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['success' => false, 'error' => 'User not logged in']);
            return;
        }

        // Get POST data
        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');
        $user_id = $this->input->post('user_id');

        // Validate input
        if (empty($current_password) || empty($new_password) || empty($user_id)) {
            echo json_encode(['success' => false, 'error' => 'Missing required fields']);
            return;
        }

        // Load the user model
        $this->load->model('User_model');

        // Verify current password
        $user = $this->User_model->get_user_by_id($user_id);
        if (!$user || !password_verify($current_password, $user->password)) {
            echo json_encode(['success' => false, 'error' => 'Current password is incorrect']);
            return;
        }

        // Hash new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password
        $update_data = [
            'password' => $hashed_password
        ];

        if ($this->User_model->update_user($user_id, $update_data)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update password']);
        }
    }
}
?>
