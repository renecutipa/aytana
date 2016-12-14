<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Auth_model');
    }

    public function index()
    {
        $this->load->view('auth/login_form');
    }

    public function login(){
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            if(isset($this->session->userdata['logged_in'])){
                $this->load->view('board/admin');
            }else{
                $this->load->view('auth/login_form');
            }
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );

            $result = $this->Auth_model->login($data);
            if ($result != false) {
                $result = $this->Auth_model->getChecked($result->id_user);
                if ($result != false) {
                    $session_data = array(
                        'id_user' => $result->id_user,
                        'username' => $result->user_name,
                    );

                    $this->session->set_userdata('logged_in', $session_data);

                    $this->load->view('board/admin');
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('auth/login_form', $data);
            }
        }
    }

    public function logout() {

        $session_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $session_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('auth/login_form', $data);
    }

}
