<?php
class Producto_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}

	function addProducto($data){
		if ($this->db->insert ( 'products', $data ))
			return true;
		else
			return false;
	}

	function editProducto($id,$data){
		$this->db->where ( "id_product", $id );
		if ($this->db->update ( 'products', $data )) {
			return true;
		} else {
			return false;
		}
	}

	function getProducto($id) {
		$q = "SELECT * FROM products WHERE id_product = '" . $id . "'";
		$query = $this->db->query ( $q );
		
		if ($query->num_rows () == 1) {
			return $query->row ();
		}
	}

	function getMarca($id){
        $q = "SELECT * FROM brands WHERE id_brand = '".$id."'";
        $query = $this->db->query ( $q );

        if ($query->num_rows () == 1) {
            return $query->row ();
        }
    }

    function getModelo($id){
        $q = "SELECT * FROM models WHERE id_model = '".$id."'";
        $query = $this->db->query ( $q );

        if ($query->num_rows () == 1) {
            return $query->row ();
        }
    }

    function getCategoria($id){
        $q = "SELECT * FROM categories WHERE id_category = '".$id."'";
        $query = $this->db->query ( $q );

        if ($query->num_rows () == 1) {
            return $query->row ();
        }
    }

	function getMarcaArr() {
		$query = $this->db->query ( 'SELECT id_brand, name FROM brands');
		
		if ($query->num_rows () > 0) {
			foreach ( $query->result () as $row ) {
				$arrDatos [htmlspecialchars ( $row->id_brand, ENT_QUOTES )] = htmlspecialchars ( $row->name, ENT_QUOTES );
			}
			$query->free_result ();
			return $arrDatos;
		}
	}
	function getModeloArr($idMarca) {
		$query = $this->db->query ( 'SELECT id_model, name FROM models WHERE id_brand = '.$idMarca);
		
		if ($query->num_rows () > 0) {
			foreach ( $query->result () as $row ) {
				$arrDatos [htmlspecialchars ( $row->id_model, ENT_QUOTES )] = htmlspecialchars ( $row->name, ENT_QUOTES );
			}
			$query->free_result ();
			return $arrDatos;
		}
	}
	function getCategoriaArr($idModel) {
		$query = $this->db->query ( 'SELECT id_category, name FROM categories WHERE id_model = '.$idModel);
		
		if ($query->num_rows () > 0) {
			foreach ( $query->result () as $row ) {
				$arrDatos [htmlspecialchars ( $row->id_category, ENT_QUOTES )] = htmlspecialchars ( $row->name, ENT_QUOTES );
			}
			$query->free_result ();
			return $arrDatos;
		}
	}
	

	function getListaProductos(){
		// initilize all variable
		$params = $columns = $totalRecords = $data = array();
		
		$params = $_REQUEST;
		
		//define index of column
		$columns = array(
				0 =>'id_product',
				1 =>'code',
				2 => 'name',
				3 => 'brand',
				4 => 'model',
				5 => 'description',
				6 => 'creation_date',
				7 => 'unit',
				8 => 'min_stock',
				9 => 'location',
				10=> 'status'
		);
		
		$where = $sqlTot = $sqlRec = "";
		
		// check search value exist
		if( !empty($params['search']['value']) ) {
			$where .=" WHERE ";
			$where .=" ( p.id_product LIKE '".$params['search']['value']."%' ";
			$where .=" OR p.code LIKE '".$params['search']['value']."%' ";
			$where .=" OR p.name LIKE '".$params['search']['value']."%' ";
			$where .=" OR b.name LIKE '".$params['search']['value']."%' ";
			$where .=" OR m.name LIKE '%".$params['search']['value']."%' ";			
			$where .=" OR p.location LIKE '".$params['search']['value']."%' )";
			if(!empty($params['marca'])){
				$where.= " AND p.id_brand = '".$params['marca']."'";
			}
			if(!empty($params['marca'])){
				$where.= " AND p.id_model = '".$params['modelo']."'";
			}
			if(!empty($params['marca'])){
				$where.= " AND p.id_category = '".$params['categoria']."'";
			}
		}else{
			if(!empty($params['marca'])){
				$where.= " WHERE ";
				$where.= " p.id_brand = '".$params['marca']."'";
			}
			if(!empty($params['modelo'])){
				$where.= " AND p.id_model = '".$params['modelo']."'";
			}
			if(!empty($params['categoria'])){
				$where.= " AND p.id_category = '".$params['categoria']."'";
			}

		}
		
		// getting total number records without any search
		$sql = "SELECT p.*, b.name as brand_name, m.name as model_name, (IFNULL(SUM(e.cantidad),0)-IFNULL(SUM(d.cantidad),0)) as cantidad, r.cost_price, r.sale_price FROM products as p ";
		$sql.= "LEFT JOIN brands as b ON p.id_brand = b.id_brand ";
		$sql.= "LEFT JOIN models as m ON p.id_model = m.id_model ";
		$sql.= " LEFT JOIN view_entradas as e ON p.id_product = e.id_product ";
		$sql.= " LEFT JOIN view_salidas as d ON p.id_product = d.id_product ";
		$sql.= " LEFT JOIN prices as r ON p.id_product = r.id_product AND r.status = 1 ";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		//concatenate search sql if value exist
		if(isset($where) && $where != '') {
		
			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		$sqlTot .=  " GROUP BY p.id_product ";
		$sqlRec .=  " GROUP BY p.id_product ";
		$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";
		
		$queryTot = $this->db->query ($sqlTot);
		
		
		$totalRecords = $queryTot->num_rows();
		
		$queryRecords = $this->db->query ($sqlRec);
		//iterate on results row and create new index array of data
		$i=0;
		

		foreach( $queryRecords->result() as $row) {
			$hasImage = "";
			if($row->image != ""){
				$hasImage = $row->id_product;
			}
			$data[$i]=array(
					$row->id_product,
					$row->code,
					$hasImage,
					$row->name,
					$row->brand_name,
					$row->model_name,
					$row->unit,
					$row->cantidad,
					$row->cost_price,
					$row->sale_price,
					$row->location
					
			);
			$i++;
			
		}
		
		$json_data = array(
				"draw"            => intval( $params['draw'] ),
				"recordsTotal"    => intval( $totalRecords ),
				"recordsFiltered" => intval($totalRecords),
				"data"            => $data,   // total data array
				"sql"			  => $sqlRec
		);
		
		echo json_encode($json_data);  // send data as json format
	}


	function getListaProductosVenta(){
		// initilize all variable
		$params = $columns = $totalRecords = $data = array();
		
		$params = $_REQUEST;
		
		//define index of column
		$columns = array(
				0 =>'id_product',
				1 =>'code',
				2 => 'name',
				3 => 'brand',
				4 => 'model',
				5 => 'description',
				6 => 'creation_date',
				7 => 'unit',
				8 => 'min_stock',
				9 => 'location',
				10=> 'status'
		);
		
		$where = $sqlTot = $sqlRec = "";
		
		// check search value exist
		if( !empty($params['search']['value']) ) {
			$where .=" WHERE ";
			$where .=" ( p.id_product LIKE '".$params['search']['value']."%' ";
			$where .=" OR p.code LIKE '".$params['search']['value']."%' ";
			$where .=" OR p.name LIKE '".$params['search']['value']."%' ";
			$where .=" OR b.name LIKE '".$params['search']['value']."%' ";
			$where .=" OR m.name LIKE '%".$params['search']['value']."%' ";			
			$where .=" OR p.location LIKE '".$params['search']['value']."%' )";
			if(!empty($params['marca']) ){
				$where.= " AND p.id_brand = '".$params['marca']."'";
			}
			if(!empty($params['marca'])){
				$where.= " AND p.id_model = '".$params['modelo']."'";
			}
			if(!empty($params['marca'])){
				$where.= " AND p.id_category = '".$params['categoria']."'";
			}
		}else{
			if(!empty($params['marca'])){
				$where.= " WHERE ";
				$where.= " p.id_brand = '".$params['marca']."'";
			}
			if(!empty($params['modelo'])){
				$where.= " AND p.id_model = '".$params['modelo']."'";
			}
			if(!empty($params['categoria'])){
				$where.= " AND p.id_category = '".$params['categoria']."'";
			}

		}
		
		// getting total number records without any search
		$sql = "SELECT p.*, b.name as brand_name, m.name as model_name, (IFNULL(SUM(e.cantidad),0)-IFNULL(SUM(d.cantidad),0)) as cantidad, r.cost_price, r.sale_price FROM products as p ";
		$sql.= " LEFT JOIN brands as b ON p.id_brand = b.id_brand ";
		$sql.= " LEFT JOIN models as m ON p.id_model = m.id_model ";
		$sql.= " LEFT JOIN view_entradas as e ON p.id_product = e.id_product ";
		$sql.= " LEFT JOIN view_salidas as d ON p.id_product = d.id_product ";
		$sql.= " LEFT JOIN prices as r ON p.id_product = r.id_product AND r.status = 1 ";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		//concatenate search sql if value exist
		if(isset($where) && $where != '') {
		
			$sqlTot .= $where;
			$sqlRec .= $where;
		}
			

		$sqlTot .=  " GROUP BY p.id_product ";
		$sqlRec .=  " GROUP BY p.id_product ";
		$sqlRec .=  " ORDER BY p.". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";
		
		$queryTot = $this->db->query ($sqlTot);
		
		
		$totalRecords = $queryTot->num_rows();
		
		$queryRecords = $this->db->query ($sqlRec);
		//iterate on results row and create new index array of data
		$i=0;
		foreach( $queryRecords->result() as $row) {
			$hasImage = "";
			if($row->image != ""){
				$hasImage = $row->id_product;
			}
			$data[$i]=array(
					$row->id_product,
					$row->code,
					$hasImage,
					$row->name." - <b>".$row->brand_name."</b> - ".$row->model_name,
					$row->location,					
					$row->cantidad,
					$row->cost_price,
					$row->sale_price,
					$row->name			
			);
			$i++;
			
		}
		
		$json_data = array(
				"draw"            => intval( $params['draw'] ),
				"recordsTotal"    => intval( $totalRecords ),
				"recordsFiltered" => intval($totalRecords),
				"SQL"			  => $sqlTot,
				"data"            => $data   // total data array
		);
		
		echo json_encode($json_data);  // send data as json format
	}

	function getCategorias($modelo) {
		if($modelo != ""){
			$query = $this->db->query ("SELECT id_category, name FROM categories WHERE id_model=".$modelo);
		}
		else{
			$query = $this->db->query ("SELECT id_category, name FROM categories");
		}
		if ($query->num_rows () > 0) {
			$i = 0;
			foreach ( $query->result () as $row ) {
				$data [$i] ["codigo"] = $row->id_category;
				$data [$i] ["valor"] = $row->name;
				$i ++;
			}
			$query->free_result ();
			return json_encode ( $data );
		}
	}

	function getModelos($marca) {
		if($marca!=""){
			$query = $this->db->query ("SELECT id_model, name FROM models WHERE id_brand=".$marca);
		}else{
			$query = $this->db->query ("SELECT id_model, name FROM models");
		}
		if ($query->num_rows () > 0) {
			$i = 0;
			foreach ( $query->result () as $row ) {
				$data [$i] ["codigo"] = $row->id_model;
				$data [$i] ["valor"] = $row->name;
				$i ++;
			}
			$query->free_result ();
			return json_encode ( $data );
		}
	}

	function getMarcas() {
		$query = $this->db->query ("SELECT id_brand, name FROM brands");
		if ($query->num_rows () > 0) {
			$i = 0;
			foreach ( $query->result () as $row ) {
				$data [$i] ["codigo"] = $row->id_brand;
				$data [$i] ["valor"] = $row->name;
				$i ++;
			}
			$query->free_result ();
			return json_encode ( $data );
		}
	}

	function ingresar_stock($id,$cantidad,$precioc,$preciov, $income_data, $id_user){

        $this->db->insert('incomes', $income_data);
        $id_income = $this->db->insert_id();

		for($i=0; $i<count($id); $i++){
		    if($cantidad[$i] > 0 ){
                $data = array (
                    'type' => 1,
                    'id_store' => '1',
                    'id_income' => $id_income,
                    'id_product' => $id[$i],
                    'quantity' => $cantidad[$i],
                    'date' => date('Y-m-d h:i:s'),
                    'status' => '1',
                    'id_user' => $id_user

                );
                $this->db->insert ( 'stock', $data );
		    }
		}	



		for($i=0; $i<count($id); $i++){

			$data = array('status' => '0');

			$this->db->where("id_product",$id[$i]);	
			$this->db->update ( 'prices', $data );

			$data = array(
				'id_product' => $id[$i],
				'cost_price' => $precioc[$i],
				'sale_price' => $preciov[$i],
				'modified' => date('Y-m-d h:i:s'),
				'status' => '1',
                'id_user' => $id_user
			);
			$this->db->insert ( 'prices', $data );
		}

		return true;
	}

	function salida_stock($id,$cantidad,$preciou, $precioc, $desc, $id_sale, $id_user){
		for($i=0; $i<count($id); $i++){
			$unit_price = $preciou[$i] - ($preciou[$i] * $desc[$i]/100); //CALCULANDO PRECIO DESCONTADO
			$data = array (
			    'type' => 2,
				'id_store' => '1',
				'id_product' => $id[$i],
                'id_sale' => $id_sale,
				'quantity' => $cantidad[$i],
                'date' => date('Y-m-d h:i:s'),
                'cost_price' => $precioc[$i],
                'sale_price' => $preciou[$i],
                'saled_price' => $unit_price,
                'discount' => $desc[$i],
				'status' => '1',
				'id_user' => $id_user

			);
			$this->db->insert ( 'stock', $data );
		}
		return true;
	}


    function getKardex($id) {
        $query = $this->db->query ("SELECT type,id_product, id_sale, id_income, quantity, date, cost_price, saled_price FROM stock WHERE status = 1");

        $data="";
        if ($query->num_rows () > 0) {
            $i = 0;
            foreach ( $query->result () as $row ) {
                $data [$i] ["type"] = $row->type;
                $data [$i] ["id_sale"] = $row->id_sale;
                $data [$i] ["id_income"] = $row->id_income;
                $data [$i] ["quantity"] = $row->quantity;
                $data [$i] ["date"] = $row->date;
                $data [$i] ["cost_price"] = $row->cost_price;
                $data [$i] ["saled_price"] = $row->saled_price;

                $i ++;
            }
        }
        if($data){
            $response ['datos'] = $data;
            $response ['status'] = "ok";
            $response ['message'] = "Operacion realizada con exito";
        }else{
            $response ['status'] = "fail";
            $response ['message'] = "No se obtuvieron datos";
        }

        return json_encode($response);
    }
}

?>