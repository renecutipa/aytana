<?php
if (isset($user->username)) {
} else {
    header("location: auth");
}
?>
<?php $this->load->view('top');?>
<!-- - - - - - - - - - - CONTENIDO - - - - - - - - - - -->

<div>
    <div class="tabs-vertical-env">
    <ul class="nav tabs-vertical"><!-- available classes "bordered", "right-aligned" -->
        <li class="active">
            <a href="#venta_dia" data-toggle="tab">
                <span>VENTA DIARIA</span>
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
        <div class="tab-pane" id="cardex"></div>
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