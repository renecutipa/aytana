<?php
if (isset($user->username)) {
} else {
    header("location: auth");
}
?>
<?php $this->load->view('top');?>
<!-- - - - - - - - - - - CONTENIDO - - - - - - - - - - -->

<div>
    <div >
    <ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
        <li class="active">
            <a href="#venta_dia" data-toggle="tab">
                <span>VENTA DIARIA</span>
            </a>
        </li>

        <li>
            <a href="#kardex" data-toggle="tab">
                <span>KARDEX</span>
            </a>
        </li>

        <li>
            <a href="#utilidades" data-toggle="tab">
                <span>UTILIDADES</span>
            </a>
        </li>

    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="venta_dia">            
            <div class="form-group">
                <label class="col-sm-1 control-label">FECHA DE REPORTE</label>

                <div class="col-sm-2">
                    <div class="input-group">
                        <input id="fecha_reporte" type="text" onchange="cargarVentaDiaria()" class="form-control datepicker" data-format="yyyy-mm-dd" value="<?php echo date("Y-m-d")?>">

                        <div class="input-group-addon">
                            <a href="#"><i class="entypo-calendar"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <h2>Total: <span id="total_sale"></span> -- Neto: <span id="total_neto"></span> -- Ganancia: <span id="ganancia"></span></h2>
            <table class="table table-bordered stripe oscuro" id="sales_list">
                <thead>
                <tr class="encabezado">
                    <th>-</th>
                    <th style="width:10%">Venta Nro.</th>
                    <th style="width:10%">Ticket</th>
                    <th style="width:30%">Cliente</th>
                    <th style="width:10%">P. Neto</th>
                    <th style="width:10%">Ganancia</th>
                    <th style="width:10%">P. Total</th>
                    <th style="width:15%">Vendedor</th>
                    <th style="width:10%">Fecha</th>
                    <th style="width:5%">Estado</th>
                </tr>
                </thead>
                <tbody>

                </tbody>

            </table>

        </div>
        <div class="tab-pane" id="kardex">
            <fieldset>
                <div class="form-group col-xs-6 col-sm-6">
                    <label>C&oacute;digo</label>
                    <input id="search_codigo" class="form-control" type="text" />
                </div>
                <div class="form-group col-xs-2 col-sm-2">
                    <label>Mes</label>
                    <select id="search_month" class="form-control">
                        <option value=""> - Seleccione - </option>
                        <option value="01">Enero    </option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Setiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
                <div class="form-group col-xs-2 col-sm-2">
                    <label>A&ntilde;o</label>
                    <input id="search_year" class="form-control" type="text" />
                </div>
                <div class="form-group col-xs-2 col-sm-2">
                    <br>
                    <button class="btn btn-success btn-lg" onclick="getProductByCode();">Buscar</button>
                </div>

            </fieldset>

            <!--button class="btn btn-success" onclick="getKardex();">Get</button-->
            <table width="100%" class="table table-bordered stripe oscuro" id="kardex">

                <thead>
                    <!--tr>
                        <td colspan="2" width="25%">Articulo</td>
                        <td colspan="3" width="25%">AAA</td>
                        <td colspan="3" width="25%">Existencia Mínima</td>
                        <td colspan="3" width="25%">10</td>
                    </tr>
                    <tr>
                        <td colspan="2" width="25%">Método</td>
                        <td colspan="3" width="25%">f</td>
                        <td colspan="3" width="25%">Existencia Máxima</td>
                        <td colspan="3" width="25%">f</td>
                    </tr-->
                    <tr>
                        <td rowspan="2" width="8%">FECHA</td>
                        <td rowspan="2">DETALLE</td>
                        <td colspan="3">ENTRADAS</td>
                        <td colspan="3">SALIDAS</td>
                        <td colspan="3">EXISTENCIAS</td>
                    </tr>
                    <tr>

                        <td>Cantidad</td>
                        <td>V/Unitario</td>
                        <td>V/Total</td>
                        <td>Cantidad</td>
                        <td>V/Unitario</td>
                        <td>V/Total</td>
                        <td>Cantidad</td>
                        <td>V/Unitario</td>
                        <td>V/Total</td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>

                </tfoot>



            </table>

        </div>
        <div class="tab-pane" id="vendidos"></div>
        <div class="tab-pane" id="utilidades"></div>

    </div>
    </div>



</div>
<script type="text/javascript">
	cargarVentaDiaria()
</script>

<!--  - - - - - - - - - -   FIN CONTENIDO  - - - - - - - - - - -->
<!-- Footer -->
<?php $this->load->view('bottom');?>
<!-- FIN TODO -->