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
		$data['caja'] = $this->Venta_model->getCaja($this->Auth_model->getLogged()->id_store);
		$data['titulo'] = "Ingresos";
		$this->load->view ( 'entrance/lista',$data);
	}
	public function getP(){
		$this->Producto_model->getListaProductos();
	}

    public function income(){
        $data['user'] = $this->Auth_model->getLogged();
        $data['caja'] = $this->Venta_model->getCaja($this->Auth_model->getLogged()->id_store);
        $this->load->view ( 'entrance/provider',$data);
    }

	public function entrance(){
		$id = $this->input->post ( "id" );
		$cantidad = $this->input->post ( "cantidad" );
		$precioc = $this->input->post ( "precioc" );
		$preciov = $this->input->post ( "preciov" );
		$document_type = $this->input->post ("document_type");
        $document_number = $this->input->post ("document_number");
        $provider = $this->input->post ("provider");
        $ruc = $this->input->post ("ruc");

        $id_user = $this->Auth_model->getLogged()->id_user;
        $id_store = $this->Auth_model->getLogged()->id_store;

        $income_data = array (
        	'id_store' => 1,
            'document_type' => $document_type,
            'document_number' => $document_number,
            'provider' => $provider,
			'ruc' => $ruc,
            'date' => date('Y-m-d h:i:s'),
            'status' => '1',
            'id_user' => $id_user,
			'id_store' => $id_store

        );


		$result = $this->Producto_model->ingresar_stock($id,$cantidad,$precioc,$preciov, $income_data, $id_user, $id_store);

        if ($result) {
            $response ['status'] = "ok";
            $response ['message'] = "Operacion realizada con exito";
        } else {
            $response ['status'] = "fail";
            $response ['message'] = "Error, No se pudo hacer el ingreso de los productos";
        }

        echo json_encode ( $response );
	}
	
	
}

?>
