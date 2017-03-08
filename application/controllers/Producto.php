<?php
/**
 * Usuario.php
 * Creado: 10.08.16 / Rene Cutipa
 * Ultima Modificacion: 10.08.16 / Rene Cutipa
 */
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Producto extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Producto_model');
        $this->load->model('Auth_model');
		//$this->load->model('Venta_model');
		$this->load->helper(array('form', 'url'));
	}
	
	public function index() {
        $data['user'] = $this->Auth_model->getLogged();
		//$data['caja'] = $this->Venta_model->getCaja();
		$data['titulo'] = "Productos";
		$this->load->view ( 'product/lista_productos',$data);
	}
	public function getP(){
		$this->Producto_model->getListaProductos();
	}

	public function getStocks(){
		$this->Producto_model->getListaProductosVenta();
	}

	public function handleProduct(){
		$id = $this->input->get ( 'id') or "";
		$data['producto'] = $this->Producto_model->getProducto($id);
		$data['marca'] = $this->Producto_model->getMarcaArr();
		if($id != ""){			
			$data['modelo'] = $this->Producto_model->getModeloArr($data['producto']->id_brand);
			$data['categoria'] = $this->Producto_model->getCategoriaArr($data['producto']->id_model);
		}
		$this->load->view('product/form_producto',$data);
	}

	public function getCategorias(){
    	$model = $this->input->get('sale_model') or "No existe";
    	echo $this->Producto_model->getCategorias($model);
    	
    }
    public function getMarcas(){
    	echo $this->Producto_model->getMarcas();    	 
    }

    public function getModelos(){
    	$brand = $this->input->get('sale_brand') or "No existe";
    	echo $this->Producto_model->getModelos($brand);    	 
    }

    public function detalleProducto(){
    	$id = $this->input->get ('id');
    	$data['producto'] = $this->Producto_model->getProducto($id);
    	 //var_dump($data['producto']);
    	//xit;
    	$data['marca'] = $this->Producto_model->getMarca($data['producto']->id_brand);
        $data['modelo'] = $this->Producto_model->getModelo($data['producto']->id_model);
        $data['categoria'] = $this->Producto_model->getCategoria($data['producto']->id_category);
    	$this->load->view('product/detalle_producto',$data);
    }

    public function CRUDProducto(){
    	$datos = $this->input->post ();
    	$id = $this->input->post ( 'id' ) or "";
		$oper = $this->input->post ( 'oper' );
		
		$datos ['id_user'] = 1;

		unset ( $datos ['id'] );
		unset ( $datos ['oper'] );

//---------------------------------------------------------
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048'; // 2MB
		$config['max_width']  = '3000';
		$config['max_height']  = '2000       ';
		$config['file_name']  = $datos['code'];
		
		$this->load->library('upload', $config);
		$data = "";
	
		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());
			$data['error'] = $error['error'];
		}
		else
		{	
			$data = $this->upload->data();
			$ruta = $data['file_name'];
			$tamanio = $data['file_size'];
			$extension = $data['file_ext'];
			$datos['image'] = $data['file_name'];
		}
//---------------------------------------------------------


		if ($oper == "add") {
			$result = $this->Producto_model->addProducto ( $datos );
		} else if ($oper == "edit" && $id != "") {
			$result = $this->Producto_model->editProducto ( $id, $datos );
		} else {
			$result = false;
		}




		if ($result) {
			$response ['image'] = $data;
			$response ['status'] = "ok";
			$response ['message'] = "Operacion realizada con exito";
		} else {
			$response ['status'] = "fail";
		}
		
		echo json_encode ( $response );
	}
}

?>
