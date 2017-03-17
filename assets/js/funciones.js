/**
 * funciones.js
 * Creado: 17.08.16 / Rene Cutipa
 * Modificado: 
 */

function getCaja(){
    $.ajax({
        url : UrlBase + "venta/getCaja",
        type : 'GET',
		data: '',
        success : function(data) {
            $("#caja_valor").html(data);
        }
    });
}



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
				var tipo = $('#sale_type').val();
				var nombre = $('#sale_name').val();
				var doc = $('#sale_doc').val();
				var address = $('#sale_address').val();
				
				$.ajax({
					url : UrlBase + "venta/vender",
					type : 'POST',
					data : 'nombre='+nombre+'&dni_ruc='+doc+'&direccion='+address+"&tipo="+tipo+"&"+frm.serialize(),
					dataType : "json",
					success : function(data) {
						if (data.status == "ok") {
							d.close();
							$("#saleList tbody").html("");
							recargarTabla();
							getCaja();
							$("#sale_total").val("0.00");
							imprimir(data.cmp);
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
	descuento = (parseFloat($('#desc_prod_'+id).val())/100).toFixed(2);
	precio_descontado = precio - (precio * descuento);

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

function anular_venta(id) {
    var route = "venta/anular";
    var titulo = "Anular Venta";

    var dialog = new BootstrapDialog({
        title : titulo,
        message : "¿Desea anular la venta?",
        buttons : [ {
            label : 'Anular',
            cssClass : 'btn btn-red right',
            action : function(d) {
                var frm = $('#form_venta');

                $.ajax({
                    url : UrlBase + "venta/anular",
                    type : 'POST',
                    data : 'id='+id,
                    dataType : "json",
                    success : function(data) {
                        if (data.status == "ok") {
                            d.close();
                            getCaja();
                            cargarVentaDiaria();
                        } else {
                        	d.close();
                        	alert("error");
                        }
                    }
                });
            }
        }, {
            label : 'Cerrar',
            cssClass : 'btn btn-default',
            action : function(d) {
                d.close();
            }
        } ]
    });
    setTimeout(function() {
        dialog.open();
    }, 300);
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




function income() {
    var route = "ingreso/income";
    var titulo = "Confirmar Ingreso";

    var dialog = new BootstrapDialog({
        title : titulo,
        message : $("<div></div>").load(route),
        buttons : [ {
            label : 'Ingresar',
            icon : 'glyphicon glyphicon-send',
            cssClass : 'btn btn-primary',
            action : function(d) {
                var frm = $('#form_entrance');
                var document_type = $('#document_type').val();
                var document_number = $('#document_number').val();
                var provider = $('#provider').val();
                var ruc = $('#ruc').val();
                $.ajax({
                    url : UrlBase + "ingreso/entrance",
                    type : 'POST',
                    data : 'document_type='+document_type+'&document_number='+document_number+'&provider='+provider+"&ruc="+ruc+"&"+frm.serialize(),
                    dataType : "json",
                    success : function(data) {
                        if (data.status == "ok") {
                            d.close();
                            $("#entranceList tbody").html("");
                            recargarTabla();
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



function cargarVentaDiaria(){
	fecha = $("#fecha_reporte").val();
	$.ajax({
		url : UrlBase + "reporte/listar_ventas",
		type : 'POST',
		data : 'fecha='+fecha,
		dataType : "json",
		success : function(datos) {
			if(datos.status == "ok"){
				response = datos.datos;
				str = "";
				suma = 0;
				for (var i = 0; i < response.length; i++) {
					str+="<tr>"
					str+= "<td><button class='btn btn-success' onclick='anular_venta("+response[i].id+")'><i class='entypo-popup'></i></button></td>"
					str+="	<td style='text-align:right !important'> "+response[i].id_sale+"</td>"
					if(response[i].ticket == null || response[i].ticket == 0){
						str+="	<td></td>"
					}else{
						str+="	<td style='text-align:right !important'>"+response[i].ticket+"</td>"
					}
					str+="	<td>"+response[i].name+"<br>"+response[i].dni_ruc+"<br>"+response[i].address+"</td>"
					str+="	<td style='text-align:right !important; font-size: 16px'>"+response[i].total_price+"</td>"
					str+="	<td>"+response[i].id_user+"</td>"
					str+="	<td>"+response[i].sale_date+"</td>"
					if(response[i].status == 1){
						str+="	<td><span class='label label-success'>CORRECTO</span></td>"
					}else{
						str+="	<td><span class='label label-danger'>ANULADO</span></td>"
					}

					str+="</tr>"
					if(response[i].status == 1){
						suma += parseFloat(response[i].total_price);
					}
				}

				$('#total_sale').html("S/. "+suma.toFixed(2));

				$('#sales_list tbody').html(str);
			}else{
                $('#total_sale').html("S/. 0.00");
                $('#sales_list tbody').html("<tr><td colspan='8'>No se registran datos</td></tr>");
			}
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


function getKardex(id,month,year){
    $.ajax({
        url : UrlBase + "producto/getKardex",
        type : 'GET',
        data : 'id='+id+'&month='+month+'&year='+year,
        dataType : "json",
        success : function(data) {
        	if(data.status == "ok"){
				response = data.datos;
				str = "";
				last_quantity = parseInt(data.saldo_cantidad);
				last_unit_price = parseFloat(data.saldo_costo).toFixed(2);
				last_total_val = last_quantity * last_unit_price;

				for (var i = 0; i < response.length; i++) {
					str+="<tr>";
					str+="<td>"+response[i].date+"</td>";
					if(response[i].id_income == null) {
						last_quantity -=  parseInt(response[i].quantity);
                        str+="<td style='font-size: 10px;'>["+response[i].susername+"] VENTA "+response[i].id_sale+"<br>"+response[i].sdocument_type+"</td>";
						str += "<td style='text-align: right'></td>";
						str += "<td style='text-align: right'></td>";
						str += "<td style='text-align: right'></td>";
						str += "<td style='text-align: right'>"+response[i].quantity+"</td>";
						str += "<td style='text-align: right'>"+response[i].saled_price+"</td>";
						str += "<td style='text-align: right'>"+(parseFloat(response[i].quantity)*parseFloat(response[i].saled_price)).toFixed(2)+"</td>";
						str += "<td style='text-align: right'>"+last_quantity+"</td>";
						str += "<td style='text-align: right'>"+response[i].cost_price+"</td>";
						str += "<td style='text-align: right'>"+(parseFloat(last_quantity)*parseFloat(response[i].cost_price)).toFixed(2)+"</td>";
					}else if (response[i].id_sale == null){
                        str+="<td style='font-size: 10px;'>["+response[i].iusername+"] COMPRA "+response[i].id_income+"<br>"+response[i].idocument_type+" "+response[i].idocument_number+" - "+response[i].provider+"</td>";
						last_quantity +=  parseInt(response[i].quantity);
						str += "<td style='text-align: right'>"+response[i].quantity+"</td>";
						str += "<td style='text-align: right'>"+response[i].cost_price+"</td>";
						str += "<td style='text-align: right'>"+(parseFloat(response[i].quantity)*parseFloat(response[i].cost_price)).toFixed(2)+"</td>";
						str += "<td style='text-align: right'></td>";
						str += "<td style='text-align: right'></td>";
						str += "<td style='text-align: right'></td>";
						str += "<td style='text-align: right'>"+last_quantity+"</td>";
						str += "<td style='text-align: right'>"+response[i].cost_price+"</td>";
						str += "<td style='text-align: right'>"+(parseFloat(last_quantity)*parseFloat(response[i].cost_price)).toFixed(2)+"</td>";
					}
					str+="</tr>";

                    last_unit_price = response[i].cost_price;
                    last_total_val = (parseFloat(last_quantity)*parseFloat(response[i].cost_price)).toFixed(2);
				}

				$('#kardex tbody').html(str);
				saldo = "";
                saldo += "<tr>";
                saldo += "<td>"+data.fecha_saldo+"</td>";
                saldo += "<td>SALDO ANTERIOR</td>";
                saldo += "<td></td>";
                saldo += "<td></td>";
                saldo += "<td></td>";
                saldo += "<td></td>";
                saldo += "<td></td>";
                saldo += "<td></td>";
                saldo += "<td style='text-align: right'>"+data.saldo_cantidad+"</td>";
                saldo += "<td style='text-align: right'>"+data.saldo_costo+"</td>";
                saldo += "<td style='text-align: right'>"+(parseFloat(data.saldo_cantidad)*parseFloat(data.saldo_costo)).toFixed(2)+"</td>";
                saldo += "</tr>";
                $('#kardex tbody').prepend(saldo);

				var foot = "";
				foot += "<tr>"
				foot += "<td></td>";
				foot += "<td style='color: #000; font-size: 20px; ' colspan='7'>INVENTARIO FINAL</td>";
				foot += "<td style='color: #000; font-size: 20px; text-align: right'>"+last_quantity+"</td>";
				foot += "<td style='color: #000; font-size: 20px; text-align: right'>"+last_unit_price+"</td>";
				foot += "<td style='color: #000; font-size: 20px; text-align: right'>"+last_total_val+"</td>";
				foot += "</tr>";
				$('#kardex tfoot').html(foot);
        	}else{
                $('#kardex tbody').html("<tr><td colspan='11'>"+data.message+"</td></tr>");
                $('#kardex tfoot').html("");
			}
        }
    });
}














function imprimir_div(idDiv)
{

    var divToPrint=document.getElementById(idDiv);

    var newWin=window.open('','Imprimir');

    newWin.document.open();

    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

    newWin.document.close();

    setTimeout(function(){newWin.close();},10);

}

























function setBarcode(id, codigo,nombre,hasImage){
    str = "";
    str+= "<tr id='barcode_item'>";
    str+= "<td><i>";
    str+= "<input id='id_product' type='hidden' value='"+id+"'/>"
    str+= "<input id='code_barcode' type='hidden' value='"+codigo+"'/>"
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

    str+= "</tr>";

    $("#item_barcode tbody").html(str);
    $("#barcode_img").attr("src", "");
}

function generarBarcode(){

	code = $("#code_barcode").val();
    id = $("#id_product").val();
	if(code != undefined){
	$.ajax({
		url : UrlBase + "barcode/barcode",
		type : 'GET',
		data : 'id='+code,
		dataType : "json",
		success : function(data) {
		}
	});
        d = new Date();
        $("#barcode_img").attr("src", "codebar/"+code+".png?"+d.getTime());

        $("#barcode_print_view").html("<a class='btn btn-success btn-lg' target='_new' href='barcode/pdf_barcode?id="+id+"'>Imprimir</a>");
	}else{
		alert("Seleccionar elemento");
	}
}


function getProductByCode(){
	codigo = $("#search_codigo").val();
	if(codigo != undefined){
        $.ajax({
            url : UrlBase + "producto/getProductByCode",
            type : 'GET',
            data : 'codigo='+codigo,
            dataType : "json",
            success : function(data) {
            	if(data != false){
            		str = "";
                	str += "<tr id='product_info'>";
                    str += "<td ><b>CODIGO</b></td>";
                    str += "<td colspan='3'>"+data.code+"</td>";
                    str += "<td colspan='1'><b>PRODUCTO</b></td>";
                    str += "<td colspan='6'>"+data.name+"</td>";
                    str += "</tr>";
                    $("#product_info").remove();
            		$("#kardex thead").prepend(str);

					var month = $("#search_month").val();
					var year = $("#search_year").val();
					if(month != "" && year != ""){
						getKardex(data.id_product, month, year);
					}

				}else{
            		alert("No se encuentra el producto");
				}
            }
        });
	}else{
        alert("Debe de ingresar el c&oacute;digo");
    }
}