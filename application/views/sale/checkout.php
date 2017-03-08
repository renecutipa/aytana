<?php
if (isset($user)) {
} else {
    header("location: login");
}
?>
<div class="main-content">
<!-- ----------------   CONTENIDO ----------------------- -->
<fieldset>
	<div class="form-group col-xs-6 col-sm-6">
		<label>Documento</label>
		<select class="form-control">
			<option>PROFORMA</option>
			<option>TICKET DE VENTA</option>
			<option>NOTA DE VENTA</option>
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