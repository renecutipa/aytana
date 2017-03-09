<?php
class Venta_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	
	function registrar_venta($nombre, $dni_ruc, $direccion, $cantidad, $preciou, $desc, $id_user) {
		$total = 0;
		for($i=0; $i<count($cantidad); $i++){
			$pu = $preciou[$i] - ($preciou[$i] * $desc[$i]/100);

			$total += $cantidad[$i]*$pu;
		}

		$data = array(
			'id_store' => '1',
			'total_products' => count($cantidad),
			'total_price' => $total,
			'name' => $nombre,
			'dni_ruc' => $dni_ruc,
			'address' => $direccion,
			'document_type' => 'NOTA DE VENTA',
			'document_number' => '1',
			'status' => '1',
			'sale_date' => date('Y-m-d h:i:s'),
			'id_user' => $id_user
		);
		$this->db->insert ( 'sales', $data );
		$idVenta = $this->db->insert_id();

		return $idVenta;
	}

	function getCaja(){
		$sql = "SELECT SUM(total_price) as caja FROM sales WHERE status = '1' AND DATE(sale_date) = CURDATE()";
		$query = $this->db->query ( $sql );
		$row = $query->row();

		return $row->caja;
	}

	function listar_ventas($fecha){
		$sql = "SELECT * FROM sales WHERE DATE(sale_date) = '".$fecha."' ORDER BY id_sale DESC";
		$query = $this->db->query ( $sql );
		$data="";
		if ($query->num_rows () > 0) {
			$i = 0;
			foreach ( $query->result () as $row ) {
				$data [$i] ["id_sale"] = str_pad($row->id_sale, 6, "0", STR_PAD_LEFT);
				$data [$i] ["name"] = $row->name;
				$data [$i] ["dni_ruc"] = $row->dni_ruc;
				$data [$i] ["address"] = $row->address;
				$data [$i] ["total_price"] = $row->total_price;
				$data [$i] ["id_user"] = "1";
				$data [$i] ["sale_date"] = $row->sale_date;
				$data [$i] ["status"] = $row->status;

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

		echo json_encode($response);
	}

	function getTotal($cantidad, $preciou, $desc) {
		$total = 0;
		for($i=0; $i<count($cantidad); $i++){
			$pu = $preciou[$i] - ($preciou[$i] * $desc[$i]/100);

			$total += $cantidad[$i]*$pu;
		}

		return $total;
	}

	function emitir_comprobante($idVenta, $hasDiscounts){

		if($hasDiscounts == 0){
			$cmp = "";

			$sql = "SELECT *  FROM sales WHERE id_sale='".$idVenta."'";
			$query = $this->db->query ( $sql );

			$venta = $query->row();

			$sql = "SELECT LPAD(d.id_product,5,0) as id ,p.name, d.quantity, d.unit_price FROM departures as d 
	LEFT JOIN products as p ON d.id_product = p.id_product WHERE id_sale='".$idVenta."'";
			$query = $this->db->query ( $sql );



			$cmp.="----------------------------------------\n";
			$cmp.=str_pad("NOTA DE VENTA", 40, " ", STR_PAD_BOTH)."\n"; 
			$cmp.="----------------------------------------\n";
			$cmp.="COD   DESCRIPCION           Cant Importe\n";
			$cmp.="----------------------------------------\n";
			//     1234567890123456789012345678901234567890
			if ($query->num_rows () > 0) {
				$i = 0;

				foreach ( $query->result () as $row ) {
					$cmp.=str_pad($row->id, 6).substr(str_pad($row->name, 22),0,21).str_pad($row->quantity,4,' ',STR_PAD_LEFT).str_pad(number_format($row->quantity*$row->unit_price,2),9,' ',STR_PAD_LEFT)."\n";
					$i++;
				}
			}
			$cmp.="----------------------------------------\n";
			$cmp.=str_pad("TOTAL :",30,' ',STR_PAD_LEFT).str_pad(number_format($venta->total_price, 2), 10, ' ',STR_PAD_LEFT)."\n";

			$cmp.=$venta->sale_date."\n";


			return $cmp;
		}else{
			$cmp = "";

			$sql = "SELECT *  FROM sales WHERE id_sale='".$idVenta."'";
			$query = $this->db->query ( $sql );

			$venta = $query->row();

			$sql = "SELECT LPAD(d.id_product,4,0) as id ,p.name, d.quantity, d.unit_price, d.discount FROM departures as d 
	LEFT JOIN products as p ON d.id_product = p.id_product WHERE id_sale='".$idVenta."'";
			$query = $this->db->query ( $sql );



			$cmp.="----------------------------------------\n";
			$cmp.=str_pad("NOTA DE VENTA", 40, " ", STR_PAD_BOTH)."\n"; 
			$cmp.="----------------------------------------\n";
			$cmp.="COD  DESCRIPCION   %D   P.U. Can. Subtot\n";
			$cmp.="----------------------------------------\n";
			//     1234567890123456789012345678901234567890
			if ($query->num_rows () > 0) {
				$i = 0;

				foreach ( $query->result () as $row ) {
					$cmp.=str_pad($row->id, 5)
					.str_pad(substr(str_pad($row->name, 14),0,13),14)
					.str_pad($row->discount,2,' ',STR_PAD_LEFT)
					.str_pad(number_format($row->unit_price,2),7,' ',STR_PAD_LEFT)
					.str_pad($row->quantity,4,' ',STR_PAD_LEFT)
					.str_pad(number_format($row->quantity*$row->unit_price,2),8,' ',STR_PAD_LEFT)
					."\n";
					$i++;
				}
			}
			$cmp.="----------------------------------------\n";
			$cmp.=str_pad("TOTAL :",30,' ',STR_PAD_LEFT).str_pad(number_format($venta->total_price, 2), 10, ' ',STR_PAD_LEFT)."\n";

			$cmp.=$venta->sale_date."\n";


			return $cmp;
		}

	}
}

?>
