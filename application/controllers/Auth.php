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
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );

        $result = $this->Auth_model->login($data);
        if ($result != false) {
            $result = $this->Auth_model->getChecked($result->id_user);
            $groups = $this->Auth_model->getGroups($result->id_user);
            if ($result != false) {
                $session_data = array(
                    'id_user' => $result->id_user,
                    'username' => $result->user_name,
                    'id_store' => $result->id_store,
                    'groups' => $groups
                );

                $this->session->set_userdata($session_data);

                $login_status = SUCCESS;
                $response['redirect_url'] = base_url().'board';
            }else{
                $login_status = INVALID;
            }
        } else {
            $login_status = INVALID;
        }
        $response['login_status'] = $login_status;
        echo json_encode($response);

    }

    public function logout() {

        $this->session->sess_destroy();
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('auth/login_form', $data);
    }

}
