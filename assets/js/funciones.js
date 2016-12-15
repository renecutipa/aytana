/**
 * funciones.js
 * Creado: 17.08.16 / Rene Cutipa
 * Modificado: 
 */

 /* UTILIDADES */

 function getCategorias() {
	var str = "";
	var idModelo = $("#sale_model").val();
	$("#sale_category").html("<option value=''>- Categoria -</option>");
	$.ajax({
		url : UrlBase + "producto/getCategorias",
		type : 'GET',
		data : "sale_model=" + idModelo,
		success : function(data) {
			var response = jQuery.parseJSON(data);
			for (var i = 0; i < response.length; i++) {
				str += "<option value='" + response[i].codigo + "'>"
						+ response[i].valor + "</option>";
			}
			$("#sale_category").append(str);
		}
	});
}

function getModelos() {
	var str = "";
	var idMarca = $("#sale_brand").val();
	$("#sale_model").html("<option value=''>- Modelo -</option>");
	$("#sale_category").html("<option value=''>- Categoria -</option>");
	$.ajax({
		url : UrlBase + "producto/getModelos",
		type : 'GET',
		data : "sale_brand=" + idMarca,
		success : function(data) {
			var response = jQuery.parseJSON(data);
			for (var i = 0; i < response.length; i++) {
				str += "<option value='" + response[i].codigo + "'>"
						+ response[i].valor + "</option>";
			}
			$("#sale_model").append(str);
			recargarTabla()
		}
	});
}

function getMarcas() {
	var str = "";
	$("#sale_model").html("<option value=''>- Modelo -</option>");
	$("#sale_category").html("<option value=''>- Categoria -</option>");
	$.ajax({
		url : UrlBase + "producto/getMarcas",
		type : 'GET',
		success : function(data) {
			var response = jQuery.parseJSON(data);
			for (var i = 0; i < response.length; i++) {
				str += "<option value='" + response[i].codigo + "'>"
						+ response[i].valor + "</option>";
			}
			$("#sale_brand").append(str);
			recargarTabla()
		}
	});
}



function getCategoriasModal() {
	var str = "";
	var idModelo = $("#modal_model").val();
	$("#modal_category").html("<option value=''>- Categoria -</option>");
	$.ajax({
		url : UrlBase + "producto/getCategorias",
		type : 'GET',
		data : "sale_model=" + idModelo,
		success : function(data) {
			var response = jQuery.parseJSON(data);
			for (var i = 0; i < response.length; i++) {
				str += "<option value='" + response[i].codigo + "'>"
						+ response[i].valor + "</option>";
			}
			$("#modal_category").append(str);
		}
	});
}

function getModelosModal() {
	var str = "";
	var idMarca = $("#modal_brand").val();
	$("#modal_model").html("<option value=''>- Modelo -</option>");
	$("#modal_category").html("<option value=''>- Categoria -</option>");
	$.ajax({
		url : UrlBase + "producto/getModelos",
		type : 'GET',
		data : "sale_brand=" + idMarca,
		success : function(data) {
			var response = jQuery.parseJSON(data);
			for (var i = 0; i < response.length; i++) {
				str += "<option value='" + response[i].codigo + "'>"
						+ response[i].valor + "</option>";
			}
			$("#modal_model").append(str);
		}
	});
}

function getMarcasModal() {
	var str = "";
	$("#modal_model").html("<option value=''>- Modelo -</option>");
	$("#modal_category").html("<option value=''>- Categoria -</option>");
	$.ajax({
		url : UrlBase + "producto/getMarcas",
		type : 'GET',
		success : function(data) {
			var response = jQuery.parseJSON(data);
			for (var i = 0; i < response.length; i++) {
				str += "<option value='" + response[i].codigo + "'>"
						+ response[i].valor + "</option>";
			}
			$("#modal_brand").append(str);
		}
	});
}

function CRUDProducto(op,id) {
	var route = "producto/handleProduct";
	var titulo = "Producto";
	if(op=="add"){
		titulo = "Agregar Producto";
		id="";
	}else if(op == "edit"){
		titulo = "Editar Producto";
		route+="?id="+id;
	}

	var dialog = new BootstrapDialog({
		title : titulo,
		message : $("<div></div>").load(route),
		buttons : [{
			label : 'Guardar',
			icon : 'glyphicon glyphicon-floppy-disk',
			cssClass : 'btn btn-primary',
			action : function(d) {
				var frm = $('#form_product');

				var form = $('form')[0]; // You need to use standart javascript object here
				var formData = new FormData(form);
				var oper = op;
				formData.append('oper', oper);
				formData.append('id', id);
				$.ajax({
					url : UrlBase + "producto/CRUDProducto",
					type : 'POST',
					data : formData,
					contentType: false,
    				processData: false,
					dataType : "json",
					success : function(data) {
						if (data.status == "ok") {
							d.close();
							recargarTabla();
							if(oper=="add"){
								ultimaPagina();
							}
						} else {
						}
					}
				});
			}
		}, {
			label : 'Cerrar',
			cssClass : 'btn-red',
			icon : 'glyphicon glyphicon-ban-circle',
			action : function(d) {
				d.close();
			}
		} ]
	});
	setTimeout(function() {
		dialog.open();
	}, 300);
}

/* ---------------- VENTAS ---------------- */
function addVenta(id, codigo,nombre,precio,cantidad,precioc,hasImage){
	if(precio == null){
		precio=0.0;
	}
	if(precioc == null){
		precioc=0.0;
	}
	
	cantidad = 1;
	
	str = "";
	str+= "<tr id='saleItem"+id+"'>";
		str+= "<td><i>";
		str+= "<input name='id[]' type='hidden' value='"+id+"'/>"
		str+= codigo;
		str+= "</i></td>";
		if(!hasImage){
			str+= "<td><strong>";
			str+= nombre;
			str+= "</strong></td>";
		}else{
			str+= "<td><strong><a onclick='detalleProducto("+id+")'>";
			str+= "<i class='entypo-picture'></i> "+nombre;
			str+= "</a></strong></td>";
		}
		str+= "<td>";
		str+= "<a href='javascript:down_quantity("+id+")'><i class='sale_btns glyphicon glyphicon-circle-arrow-down'></i></a>";
		str+= "<input id='quantity_prod_"+id+"' onchange='calcular_importe("+id+")' name='cantidad[]' class='btn btn-default sale_input_text_quantity' value='"+cantidad+"'/>";
		str+= "<a href='javascript:up_quantity("+id+")'><i class='sale_btns glyphicon glyphicon-circle-arrow-up'></i></a>";
		str+= "</td>";
		str+= "<td>";
		str+= "<input type='hidden' name='precioc[]' value='"+precioc+"'/>"
		str+= "<input id='price_prod_"+id+"' onchange='calcular_importe("+id+")' name='preciou[]' class='btn btn-default sale_input_text_price' value='"+parseFloat(precio).toFixed(2)+"'/>";
		str+= "</td>";
		str+= "<td>";
		str+= "<input id='desc_prod_"+id+"' type='number' name='desc[]' class='btn btn-gold sale_input_text_price'";
		str+= " value='0' min='0' max='20'  onchange='calcular_importe("+id+")'r/>";
		str+= "</td>";
		str+= "<td>";
		str+= "<input id='importe_prod_"+id+"' class='btn btn-success sale_input_text_price' value='";
		str+= (parseFloat(cantidad)*parseFloat(precio)).toFixed(2)+"' readonly/>";
		str+= "</td>";
		str+= "<td><a href='javascript:removeVenta("+id+")'><i class='sale_btns text-danger glyphicon glyphicon-remove'></i></a></td>"
	str+= "</tr>";

	$("#btnSale"+id).hide();

	$("#saleList tbody").append(str);
	calcular_total();
}

function removeVenta(id){
	$("#saleItem"+id).detach();
	$("#btnSale"+id).show();
}


/* - - - - - - - */
function venta() {
	var route = "venta/checkout";
	var titulo = "Confirmar Venta";

	var dialog = new BootstrapDialog({
		title : titulo,
		message : $("<div></div>").load(route),
		buttons : [ {
			label : 'Vender',
			icon : 'glyphicon glyphicon-send',
			cssClass : 'btn btn-primary',
			action : function(d) {
				var frm = $('#form_venta');
				var nombre = $('#sale_name').val();
				var doc = $('#sale_doc').val();
				var address = $('#sale_address').val();
				
				$.ajax({
					url : UrlBase + "venta/vender",
					type : 'POST',
					data : 'nombre='+nombre+'&dni_ruc='+doc+'&direccion='+address+"&"+frm.serialize(),
					dataType : "json",
					success : function(data) {
						if (data.status == "ok") {
							d.close();
							$("#saleList tbody").html("");
							recargarTabla();
							$("#sale_total").val("0.00");
							imprimir(data.cmp);
							alert(data.message);

						} else {
							alert(data.message);
						}
					}
				});
			}
		}, {
			label : 'Cerrar',
			cssClass : 'btn-red',
			icon : 'glyphicon glyphicon-ban-circle',
			action : function(d) {
				d.close();
			}
		} ]
	});
	setTimeout(function() {
		dialog.open();
	}, 300);
}

function imprimir(datos){
	var uri = 'http://localhost/imprimir/prt.php';
    jQuery.ajax({
        type:"GET",
        url: uri,
        data: "a="+datos,
        success: function(d){
        }
    });
}

function up_quantity(id){
	$('#quantity_prod_'+id).val((parseInt($('#quantity_prod_'+id).val())+1));
	calcular_importe(id);

}
function down_quantity(id){
	if($('#quantity_prod_'+id).val()>'1'){
		$('#quantity_prod_'+id).val((parseInt($('#quantity_prod_'+id).val())-1));
	}
	calcular_importe(id);
}

function calcular_importe(id){

	precio = parseFloat($('#price_prod_'+id).val());
	console.log(precio);
	descuento = (parseFloat($('#desc_prod_'+id).val())/100).toFixed(2);
	console.log(descuento);
	precio_descontado = precio - (precio * descuento);
	console.log(precio_descontado);

	precio_final = (parseFloat($('#quantity_prod_'+id).val())*precio_descontado).toFixed(2);
	$('#importe_prod_'+id).val(precio_final);
	
	calcular_total();
}
function calcular_total(){
	var frm = $('#form_venta');	
	$.ajax({
		url : UrlBase + "venta/getTotal",
		type : 'POST',
		data : frm.serialize(),
		success : function(data) {
			$('#sale_total').val(parseFloat(data).toFixed(2));
		}
	});
}


























/* INGRESOS
/* ---------------- VENTAS ---------------- */
function addEntrance(id, codigo,nombre,precioc,preciov,cantidad){
	if(precioc == null){
		precioc=0.0;	
	}
	if(preciov == null){
		preciov=0.0;	
	}
	cantidad = 0;
	str = "";
	str+= "<tr id='entranceItem"+id+"'>";
		str+= "<td><i>";
		str+= "<input name='id[]' type='hidden' value='"+id+"'/>"
		str+= codigo;
		str+= "</i></td>";
		str+= "<td><strong>";
		str+= nombre;
		str+= "</strong></td>";
		str+= "<td>";
		str+= "<a href='javascript:down_quantity("+id+")'><i class='sale_btns glyphicon glyphicon-circle-arrow-down'></i></a>";
		str+= "<input id='quantity_prod_"+id+"'name='cantidad[]' class='btn btn-default sale_input_text_quantity' value='"+cantidad+"'/>";
		str+= "<a href='javascript:up_quantity("+id+")'><i class='sale_btns glyphicon glyphicon-circle-arrow-up'></i></a>";
		str+= "</td>";
		str+= "<td>";
		str+= "<input name='precioc[]' class='btn btn-default sale_input_text_price' value='"+parseFloat(precioc).toFixed(2)+"'/>";
		str+= "</td>";
		str+= "<td>";
		str+= "<input name='preciov[]' class='btn btn-default sale_input_text_price' value='"+parseFloat(preciov).toFixed(2)+"'/>";
		str+= "</td>";
		str+= "<td><a href='javascript:removeEntrance("+id+")'><i class='sale_btns text-danger glyphicon glyphicon-remove'></i></a></td>"
	str+= "</tr>";

	$("#btnEntrance"+id).hide();

	$("#entranceList tbody").append(str);
}

function removeEntrance(id){
	$("#entranceItem"+id).detach();
	$("#btnEntrance"+id).show();
}



function entrance(){
	$.ajax({
		url : UrlBase + "ingreso/entrance",
		type : 'POST',
		data : $("#form_entrance").serialize(),
		dataType : "json",
		success : function(data) {
			
		}
	});
	$("#entranceList tbody").html("");
	recargarTabla();
	alert("Ingresos correctos");
}

function cargarVentaDiaria(){
	$.ajax({
		url : UrlBase + "reporte/listar_ventas",
		type : 'POST',
		data : 'fecha=',
		dataType : "json",
		success : function(datos) {
			response = datos.datos;
			str = "";
			for (var i = 0; i < response.length; i++) {
				str+="<tr>"
	        	str+="	<td>"+response[i].id_sale+"</td>"
	        	str+="	<td>"+response[i].name+"</td>"
	        	str+="	<td style='text-align:right !important'>"+response[i].total_price+"</td>"
	        	str+="	<td>"+response[i].id_user+"</td>"
	        	str+="	<td>"+response[i].sale_date+"</td>"
	        	if(response[i].status == 1){
	        		str+="	<td><span class='label label-success'>CORRECTO</span></td>"
	        	}else{
	        		str+="	<td><span class='label label-warning'>ANULADO</span></td>"
	        	}
	        	
	        	str+="</tr>"
			}

			$('#sales_list tbody').html(str);
		}
	});
}






//-----------------------------------------------------------------------

function detalleProducto(id) {
	var route = "producto/detalleProducto?id="+id;
	var titulo = "Producto";
	var dialog = new BootstrapDialog({
		title : titulo,
		message : $("<div></div>").load(route),
		buttons : [{
			label : 'Cerrar',
			cssClass : 'btn-red',
			icon : 'glyphicon glyphicon-ban-circle',
			action : function(d) {
				d.close();
			}
		} ]
	});
	setTimeout(function() {
		dialog.open();
	}, 300);
}
