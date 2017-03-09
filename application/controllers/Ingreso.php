<?php
/**
 * Ingreso.php
 * Creado: 10.08.16 / Rene Cutipa
 * Ultima Modificacion: 10.08.16 / Rene Cutipa
 */
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Ingreso extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Auth_model');
		$this->load->model('Producto_model');
		$this->load->model('Venta_model');
	}
	
	public function index() {
		$data['user'] = $this->Auth_model->getLogged();
		$data['caja'] = $this->Venta_model->getCaja();
		$data['titulo'] = "Ingresos";
		$this->load->view ( 'entrance/lista',$data);
	}
	public function getP(){
		$this->Producto_model->getListaProductos();
	}

	public function entrance(){
		$id = $this->input->post ( "id" );
		$cantidad = $this->input->post ( "cantidad" );
		$precioc = $this->input->post ( "precioc" );
		$preciov = $this->input->post ( "preciov" );

        $id_user = $this->Auth_model->getLogged()->id_user;

		$result = $this->Producto_model->ingresar_stock($id,$cantidad,$precioc,$preciov, $id_user);

        if ($result) {
            $response ['status'] = "ok";
            $response ['message'] = "Operacion realizada con exito";
        } else {
            $response ['status'] = "fail";
        }

        echo json_encode ( $response );
	}
	
	
}

?>
