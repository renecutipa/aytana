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
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="javascript:imprimir_div('venta_dia')">Imprimir</a>
                        </li>
                        <!--li>
                            <a href="#">Link</a>
                        </li-->

                    </ul>
                </div>
            </nav>

            <h2>Monto Vendido: <span id="total_sale"></span></h2>
            <table class="table table-bordered stripe oscuro" id="sales_list">
                <thead>
                <tr class="encabezado">
                    <th>-</th>
                    <th style="width:10%">Venta Nro.</th>
                    <th style="width:10%">Ticket</th>
                    <th style="width:35%">Cliente</th>
                    <th style="width:15%">P. Total</th>
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
            <button class="btn btn-success" onclick="getKardex();">Get</button>
            <table width="100%" class="table table-bordered stripe oscuro" id="kardex">
                <thead>
                    <tr>
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
                    </tr>
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
                <tr>
                    <td>25/12/2017</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>a</td>
                </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td>INVENTARIO FINAL</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
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