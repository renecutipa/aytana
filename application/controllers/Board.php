<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {
    public $titulo = "Panel";

    public function __construct() {
        parent::__construct();

        $this->load->model('Auth_model');
        $this->load->model('Venta_model');
    }

    public function index()
    {
        $data['titulo'] = $this->titulo;
        $data['user'] = $this->Auth_model->getLogged();
        $data['caja'] = $this->Venta_model->getCaja();
        //echo $data['caja']; exit;
        $this->load->view('board/admin',$data);
    }

    public function getMenu(){
        $this->load->model('Base_model');
        $menu = $this->Base_model->getMenu();

        header('Content-Type: application/json');
        echo $menu;

    }
}
