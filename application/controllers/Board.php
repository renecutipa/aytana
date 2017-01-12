<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {
    public $titulo = "Panel";

    public function __construct() {
        parent::__construct();

        $this->load->model('Auth_model');
    }

    public function index()
    {
        $data['titulo'] = $this->titulo;
        $data['user'] = $this->session->userdata['logged_in'];
        $this->load->view('board/admin',$data);
    }



}
