<?php
if (isset($user)) {
} else {
    header("location: login");
}
?>
<?php $this->load->view('top');?>
<!-- - - - - - - - - - - CONTENIDO - - - - - - - - - - -->

<h2><i class="entypo-tag"></i> PRODUCTOS</h2>
<div>
<button type="button" class="btn btn-success btn-icon icon-left" onclick="CRUDProducto('add',0)">
	Agregar
	<i class="entypo-plus"></i>
</button>
<button type="button" class="btn btn-info btn-icon icon-left" id="editar_producto">
	Editar
	<i class="entypo-feather"></i>
</button>
<!--button type="button" class="btn btn-danger btn-icon icon-left">
	Desactivar
	<i class="entypo-cancel"></i>
</button-->
<button type="button" class="btn btn-default btn-icon icon-left" onclick="CRUDProducto('show',0)">
	Mostrar
	<i class="entypo-eye"></i>
</button>
</div>
<br />
<div class="form-group">
	<div class="col-sm-3">
		<select class="form-control input-lg" id="sale_brand" onchange="getModelos()">
			<option value="">- Marca -</option>
		</select>
	</div>
	<div class="col-sm-3">
		<select class="form-control input-lg" id="sale_model" onchange="getCategorias()">
			<option value="">- Modelo -</option>
		</select>
	</div>
	<div class="col-sm-6">
		<select class="form-control input-lg" id="sale_category" onchange="recargarTabla()">
			<option value="">- Categoria -</option>
		</select>
	</div>
</div>
<table class="table table-bordered datatable stripe oscuro" id="table-1">
	<thead>
            <tr class="encabezado">
                <th style="width:7%">ID</th>
                <th style="width:10%">Codigo</th>
                <th style="width:1%">IMG</th>
                <th style="width:33%">Descripcion</th>
                <th style="width:10%">Marca</th>
                <th style="width:10%">Modelo</th>
                <th style="width:6%">Und.</th>
                <th style="width:4%">Cant.</th>
                <th style="width:5%">V.C.</th>
                <th style="width:5%">V.V.</th>
                <th style="width:7%">Ubicacion</th>
                
            </tr>
        </thead>
        
</table>


<script type="text/javascript">
var responsiveHelper;
var breakpointDefinition = {
    tablet: 1024,
    phone : 480
};
var tableContainer;

	jQuery(document).ready(function($)
	{
		tableContainer = $("#table-1");
		
		tableContainer.dataTable({
			select: {
	            style:    'single',
	        },
	        columnDefs: [ {
	            "targets": 2,
	            "data": 2,
	            "render": function(data, type, full, meta){
	            	if(data ==""){
	            		return "";
	            	}else{
	            		return "<button class='btn btn-success' onclick='detalleProducto("+data+")'><i class='entypo-picture'></i></button> ";
	            	}

	            }
	        }],
	        "bProcessing": true,
	        "serverSide": true,
	        "ajax":{
	             url :"producto/getP", // json datasource
	             type: "post",  // type of method  ,GET/POST/DELETE
	             data: function(data) {
						    data.marca = $("#sale_brand").val();
						    data.modelo = $("#sale_model").val();
						    data.categoria = $("#sale_category").val();
					  	},
	             error: function(){
	               $("#table-1_processing").css("display","none");
	             }
	         },
			"sPaginationType": "bootstrap",
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"bStateSave": true,	

			// Responsive Settings
		    bAutoWidth     : false,
		    fnPreDrawCallback: function () {
		        // Initialize the responsive datatables helper once.
		        if (!responsiveHelper) {
		            responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
		        }
		    },
		    fnRowCallback  : function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
		        responsiveHelper.createExpandIcon(nRow);
		    },
		    fnDrawCallback : function (oSettings) {
		        responsiveHelper.respond();
		    }	   
		});

		
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});




	});


function recargarTabla(){
	tableContainer = $("#table-1").DataTable();
	tableContainer.ajax.reload();
}

function ultimaPagina(){
	tableContainer = $("#table-1").DataTable();
	tableContainer.page( 'last' ).draw( 'page' );
}

$('#editar_producto').click(function () {
	tableContainer = $("#table-1").DataTable();
	var row = tableContainer.rows('.selected').data();
    
    if(row === undefined){
    	alert("Seleccione un producto para poder editar");
    }else{
    	CRUDProducto('edit',row[0][0]);
    }
});

getMarcas();


</script>

<!--  - - - - - - - - - -   FIN CONTENIDO  - - - - - - - - - - -->
<!-- Footer -->
<?php $this->load->view('bottom');?>
<!-- FIN TODO -->