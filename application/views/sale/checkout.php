<?php
if (isset($user->username)) {
} else {
    header("location: auth");
}
?>
<div class="main-content">
<!-- ----------------   CONTENIDO ----------------------- -->
<fieldset>
	<div class="form-group col-xs-6 col-sm-6">
		<label>Documento</label>
		<select class="form-control" id="sale_type">
			<option value="1">NOTA DE VENTA</option>
			<option value="2">TICKET DE VENTA</option>
		</select>
	</div>
	<div class="form-group col-xs-6 col-sm-6">
		<label>Nombre o Razon Social</label>
		<input id="sale_name" name="name" class="form-control" type="text" />
	</div>
	<div class="form-group col-xs-6 col-sm-6">
		<label>Direccion</label>
		<input id="sale_address" name="address" class="form-control" type="text" />
	</div>
	<div class="form-group col-xs-6 col-sm-6">
		<label>DNI/RUC</label>
		<input id="sale_doc" name="dni_ruc" class="form-control" type="text" />
	</div>

</fieldset>
<!-- --------------   FIN CONTENIDO --------------------- -->
			
</div>