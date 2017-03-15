<?php
if (isset($user->username)) {
} else {
    header("location: auth");
}
?>
<?php $this->load->view('top');?>
<!-- ----------------   CONTENIDO ----------------------- -->

<div>
    <div class=" col-md-6 col-xs-6">
        <div class="panel panel-dark" data-collapsed="0">

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">Productos</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">
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
                        <th style="width:10%">ID</th>
                        <th style="width:10%">Codigo</th>
                        <th style="width:1%">IMG</th>
                        <th style="width:33%">Descripcion</th>
                        <th style="width:7%">Ub.</th>
                        <th style="width:4%">Cant.</th>
                        <th style="width:5%">V.C.</th>
                        <th style="width:5%">V.V.</th>
                        <th style="width:0%"></th>
                        <th style="width:1%"></th>

                    </tr>
                    </thead>

                </table>
            </div>

        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="panel panel-dark" data-collapsed="0">

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">Cotizaci&oacute;n</div>
            </div>

            <!-- panel body -->
            <div class="panel-body">

                <button type="button" class="btn btn-success btn-lg" onclick="javascript:generarBarcode()"><strong>CODIGO DE BARRAS</strong></button>


                <hr/>
                    <table class="table table-bordered stripe oscuro" id="item_barcode">
                        <thead>
                        <tr class="encabezado">
                            <th style="width:10%">Codigo</th>
                            <th style="width:35%">Descripcion</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                    <div id="img_barcode">
                        <img src="" id="barcode_img" width="500">

                    </div>
                    <div id="barcode_print_view">

                    </div>
            </div>

        </div>
    </div>
</div>


<script type="text/javascript">
    var responsiveHelper;
    var breakpointDefinition = {
        tablet: 1024,
        phone : 480
    };
    var tableContainer;

    jQuery(document).ready(function($)
    {
        tableContainer = jQuery("#table-1");

        var table = tableContainer.DataTable({
            "columnDefs": [ {
                "targets": 9,
                "data": 0,
                "render": function(data, type, full, meta){
                    return "<button class='btn btn-blue btn-xs' id='btnBarcode"+data+"'>Barcode</button>";
                }
            },
                {
                    "targets": 2,
                    "data": 2,
                    "render": function(data, type, full, meta){
                        if(data ==""){
                            return "";
                        }else{
                            return "<a class='btn btn-success' onclick='detalleProducto("+data+")'><i class='entypo-picture'></i></a> ";
                        }

                    }
                }

            ],
            "bLengthChange": false,
            "bProcessing": true,
            "serverSide": true,
            "sPaginationType": "bootstrap",
            "ajax":{
                url :"producto/getStocks", // json datasource
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
            //"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "bStateSave": true,
            "fnRowCallback":function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
                $(nRow).attr("id",'alarmNum'+aData[0]);
                return nRow;
            }
        });

        table.column( 0 ).visible( false );
        table.column( 8 ).visible( false );

        jQuery('#table-1 tbody').on( 'click', 'button', function () {
            var data = table.row( jQuery(this).parents('tr') ).data();
            setBarcode(data[0], data[1],data[8],data[2]);
            //WELP! ocultar boton
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

    });

    function recargarTabla(){
        tableContainer = $("#table-1").DataTable();
        tableContainer.ajax.reload();
    }

    getMarcas();

</script>

<!-- --------------   FIN CONTENIDO --------------------- -->
<!-- Footer -->
<?php $this->load->view('bottom');?>
<!-- FIN TODO -->