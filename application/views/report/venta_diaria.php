<?php
if (isset($user->username)) {
} else {
    header("location: auth");
}
?>
<?php $this->load->view('top');?>
<!-- - - - - - - - - - - CONTENIDO - - - - - - - - - - -->

<div>
	<div>
		<div class="panel panel-dark" data-collapsed="0">
			
			<!-- panel head -->
			<div class="panel-heading">
				<div class="panel-title">Lista de VENTAS <button class="btn btn-default">Imprimir</button></div>
			</div>
			
			<!-- panel body -->

			<div class="panel-body">
                <h2>Monto Vendido: <span id="total_sale"></span></h2>
				<table class="table table-bordered stripe oscuro" id="sales_list">
					<thead>
			            <tr class="encabezado">
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