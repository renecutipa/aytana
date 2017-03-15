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
		<select class="form-control" id="document_type">
			<option value="FACTURA">FACTURA</option>
			<option value="BOLETA">BOLETA</option>
            <option value="OTRO">OTRO</option>
		</select>
	</div>
	<div class="form-group col-xs-6 col-sm-6">
		<label>Numero Documento</label>
		<input id="document_number" class="form-control" type="text" />
	</div>
	<div class="form-group col-xs-6 col-sm-6">
		<label>Proveedor</label>
		<input id="provider" class="form-control" type="text" />
	</div>
	<div class="form-group col-xs-6 col-sm-6">
		<label>RUC</label>
		<input id="ruc" class="form-control" type="text" />
	</div>

</fieldset>
<!-- --------------   FIN CONTENIDO --------------------- -->
			
</div>