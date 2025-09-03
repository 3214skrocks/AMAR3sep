<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        $this->load->view('login_view');
        $this->load->helper('visitor');
    
    }
    public function submit() {
        $this->load->model('User_model');

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $department = $this->input->post('department');

        $user = $this->User_model->get_user($username, $password, $department);

        if ($user) {
            $this->session->set_userdata('username', $username);
            $this->session->set_userdata('password', $password);
            $this->session->set_userdata('department', $user->Department);
            $this->_redirect_to_dashboard($department);
        } else {
            $data['error'] = "Invalid username, password, or department";
            $this->load->view('login_view', $data);
        }
    }

    private function _redirect_to_dashboard($department) {
        switch ($department) {
            case 'Admin':
                redirect('dashboard/admin');
                break;
            case 'Supervisor':
                redirect('dashboard/supervisor');
                break;
            case 'AMR':
                redirect('dashboard/amr');
                break;
            case 'Cataloguer':
                redirect('dashboard/cataloguer');
                break;
                case 'Registerar':
                    redirect('dashboard/registerar');
                    break;
            default:
                redirect('dashboard/search');
                break;
        }
    }
}
