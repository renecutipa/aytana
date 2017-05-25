<?php
if (isset($user->username)) {
} else {
    header("location: auth");
}
?>
<div class="main-content">
<!-- ----------------   CONTENIDO ----------------------- -->
<fieldset>
	<div>
		<div class="form-group col-xs-6 col-sm-6">
			<label>Documento</label>
			<select class="form-control" id="sale_type">
				<option value="1">NOTA DE VENTA</option>
				<option value="2">TICKET DE VENTA</option>
			</select>
		</div>
		<div class="form-group col-xs-5 col-sm-5">
			<label>DNI/RUC</label>
			<input id="sale_doc" name="dni_ruc" class="form-control" type="text" />
		</div>
		<div class="form-group col-xs-1 col-sm-1">
			<label></label>
			<span id="isClient" class="entypo-check btn 	btn-success"></span>
		</div>
		<div class="form-group col-xs-12">
			<label>Nombre o Razon Social</label>
			<input id="sale_name" name="name" class="form-control" type="text" />
		</div>
		<div class="form-group col-xs-6 col-sm-6">
			<label>Direccion</label>
			<input id="sale_address" name="address" class="form-control" type="text" />
		</div>
		<div class="form-group col-xs-6 col-sm-6">
			<label>PUNTOS</label>
			<input id="points" name="puntos" class="form-control" type="text" />
		</div>
	</div>
	<div style="text-align: center">* * * * * * * * * *</div>
	<div>
		<div class="form-group col-xs-6 col-sm-6">
			<label>MONTO ENTREGADO</label>
			<input id="monto_entregado" class="form-control" type="text" />
		</div>
		<div class="form-group col-xs-6 col-sm-6">
			<label>VUELTO</label>
			<input id="monto_entregado" class="form-control" type="text" />
		</div>
	</div>

</fieldset>
<!-- --------------   FIN CONTENIDO --------------------- -->
			
</div>