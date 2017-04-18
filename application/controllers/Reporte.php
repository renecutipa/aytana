<?php
/**
 * Usuario.php
 * Creado: 10.08.16 / Rene Cutipa
 * Ultima Modificacion: 10.08.16 / Rene Cutipa
 */
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Reporte extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Auth_model');
		$this->load->model('Producto_model');
		$this->load->model('Venta_model');
	}
	
	public function index() {
		$data['user'] = $this->Auth_model->getLogged();
		$data['caja'] = $this->Venta_model->getCaja($this->Auth_model->getLogged()->id_store);
		$data['titulo'] = "Reportes";
		$this->load->view ( 'report/venta_diaria',$data);
	}

	public function listar_ventas(){
		$fecha = $this->input->post( 'fecha');
        $id_store = $this->Auth_model->getLogged()->id_store;

		if($fecha == ""){
			$fecha = date('Y-m-d');
		}
		$data = $this->Venta_model->listar_ventas($fecha, $id_store);

		return $data;
	}
	
}

?>
