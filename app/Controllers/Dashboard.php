<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function admin() {
        $this->load->view('admin_dashboard_view');
    }

    public function supervisor() {
        $this->load->view('supervisor_dashboard_view');
    }

    public function amr() {
        $this->load->view('amr_dashboard_view');
    }

    public function cataloguer() {
        $this->load->view('cataloguer_dashboard_view');
    }
}
