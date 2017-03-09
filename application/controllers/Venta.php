<?php
/**
 * Usuario.php
 * Creado: 10.08.16 / Rene Cutipa
 * Ultima Modificacion: 10.08.16 / Rene Cutipa
 */
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Venta extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Auth_model');
		$this->load->model('Producto_model');
		$this->load->model('Venta_model');
	}
	
	public function index() {
		$data['user'] = $this->Auth_model->getLogged();
		$data['caja'] = $this->Venta_model->getCaja();
		$data['titulo'] = "Ventas";
		$this->load->view ( 'sale/presale',$data);
	}
	public function getP(){
		$this->Producto_model->getListaProductos();
	}
	public function checkout(){
        $data['user'] = $this->Auth_model->getLogged();
		$data['caja'] = $this->Venta_model->getCaja();		
		$this->load->view ( 'sale/checkout',$data);	
	}

	public function vender(){
		$id = $this->input->post ( "id" );
		$cantidad = $this->input->post ( "cantidad" );
		$preciou = $this->input->post ( "preciou" );

		$desc = $this->input->post ( "desc" );
		$precioc = $this->input->post ("precioc");

		$tipo = $this->input->post("tipo");
		$nombre = $this->input->post ("nombre");
		$dni_ruc = $this->input->post ("dni_ruc");
		$direccion = $this->input->post ("direccion");

		$id_user = $this->Auth_model->getLogged()->id_user;

		$idVenta = $this->Venta_model->registrar_venta($tipo, $nombre, $dni_ruc, $direccion, $cantidad, $preciou, $desc, $id_user);

		$salida = $this->Producto_model->salida_stock($id,$cantidad,$preciou, $precioc, $desc, $idVenta);
		//COMPROBANTE

		$cmp = $this->Venta_model->emitir_comprobante($idVenta,array_sum($desc));

		if($salida){
			$response ['cmp'] = $cmp;
			$response ['status'] = "ok";
			$response ['message'] = "Operacion realizada con exito";
		}else{
			$response ['status'] = "fail";
			$response ['message'] = "Operacion fallida";
		}

		echo json_encode ( $response ); 
	}

	public function getTotal(){
		$cantidad = $this->input->post ( "cantidad" );
		$preciou = $this->input->post ( "preciou" );
		$desc = $this->input->post ( "desc" );

		echo $this->Venta_model->getTotal($cantidad, $preciou, $desc);
	}

	public function anular(){
		$id = $this->input->post ("id");

        $anular = $this->Venta_model->anular($id);

        if($anular){
            $response ['status'] = "ok";
            $response ['message'] = "Operacion realizada con exito";
        }else{
            $response ['status'] = "fail";
            $response ['message'] = "Operacion fallida";
        }

        echo json_encode ( $response );
    }
		
}

?>
