<?php
class Webservice extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
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

    public function consume() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
            return;
        }

        $data['weather'] = $this->getWeatherData();
        $this->load->view('wsconsume', $data);
    }

    public function calendar() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
            return;
        }

        $this->load->view('calendar_view');
    }

    public function about() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
            return;
        }

        $this->load->view('about_view');
    }
}
?>
