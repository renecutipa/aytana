<style>
.modal-dialog{
	width:1024px;
}
</style>
<div class="main-content">
	<fieldset>
		<form id="form_product" enctype="multipart/form-data" role="form">
			<div class="col-xs-8 col-sm-8">
                <div>
                    <div class="form-group col-xs-1 col-sm-1">
                        <input name="autocode" class="form-control" type="checkbox" id="autocode"
                            <?php if(!isset($producto)) echo "checked"?> />
                    </div>
                    <div class="form-group col-xs-3 col-sm-3">
                        <label>Codigo</label>
                        <input name="code" id="code" class="form-control" type="text"
                            <?php if(isset($producto)) echo "value = '".$producto->code."'"?>
                            <?php if(!isset($producto)) echo "disabled"?> />
                    </div>
                    <div class="form-group col-xs-8 col-sm-8">
                        <label>Descripci&oacute;n</label>
                        <input name="name" class="form-control" type="text"
                        <?php if(isset($producto)) echo "value = '".$producto->name."'"?>/>
                    </div>

                </div>
                <div>
					<div class="form-group col-xs-6 col-sm-6">
						<select name="id_brand" class="form-control" id="modal_brand" onchange="getModelosModal()">
							<option value="">- Marca -</option>
							<?php
							if(isset($marca)){					
							foreach ( $marca as $i => $id_brand ) {
								if ($producto->id_brand == $i) {
									echo '<option value="', $i, '" selected>', $id_brand, '</option>';
								} else {
									echo '<option value="', $i, '">', $id_brand, '</option>';
								}
							}}
							?>
						</select>
					</div>
					<div  class="form-group col-xs-6 col-sm-6">
						<select name="id_model" class="form-control" id="modal_model" onchange="getCategoriasModal()">
							<option value="">- Modelo -</option>
							<?php		
							if(isset($modelo)){					
							foreach ( $modelo as $i => $id_model ) {
								if ($producto->id_model == $i) {
									echo '<option value="', $i, '" selected>', $id_model, '</option>';
								} else {
									echo '<option value="', $i, '">', $id_model, '</option>';
								}
							}}
							?>
						</select>
					</div>
                </div>
					<div class="form-group col-xs-11 col-sm-11">
						<select name="id_category" class="form-control" id="modal_category" >
							<option value="">- Categoria -</option>
							<?php
							if(isset($categoria)){							
							foreach ( $categoria as $i => $id_category ) {
								if ($producto->id_category == $i) {
									echo '<option value="', $i, '" selected>', $id_category, '</option>';
								} else {
									echo '<option value="', $i, '">', $id_category, '</option>';
								}
							}}
							?>
						</select>
					</div>
					<div class="form-group col-xs-6 col-sm-6">
						<label>Ubicacion</label>
						<input name="location" class="form-control" type="text"
						<?php if(isset($producto)) echo "value = '".$producto->location."'"?>/>
					</div>
					<div class="form-group col-xs-6 col-sm-6">
						<label>Stock M&iacute;nimo</label>
						<input name="min_stock" class="form-control" type="text"
						<?php if(isset($producto)) echo "value = '".$producto->min_stock."'"?>/>
					</div>
					<div class="form-group col-xs-11 col-sm-11">
						<label>Observaciones</label>
						<textarea name="description" class="form-control"><?php if(isset($producto)) echo $producto->description;?></textarea>
					</div>
				
			</div>
			<div class="col-xs-4 col-sm-4">
				<div>MARCA</div>
				<?php if(!isset($producto) || $producto->image == ""){?>
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 300px; height: 300px;" data-trigger="fileinput">
						<img src="http://placehold.it/300x300" alt="...">
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 300px; line-height: 6px;"></div>
					<div>
						<span class="btn btn-white btn-file">
							<span class="fileinput-new">Seleccionar</span>
							<span class="fileinput-exists">Cambiar</span>
							<input type="file" name="file" accept="image/*">
						</span>
						<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Quitar</a>
					</div>
				</div>

				<?php 
				}
				else{

				?>

				<div class="fileinput fileinput-exists" data-provides="fileinput"><input type="hidden" value="" name="">
					<div class="fileinput-new thumbnail" style="width: 300px; height: 300px;" data-trigger="fileinput">
						<img src="http://placehold.it/300x300" alt="...">
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 300px; line-height: 6px;">
						<img src="<?php echo "uploads/".$producto->image;?>" style="max-height:300px;">

					</div>
					<div>
						<span class="btn btn-white btn-file">
							<span class="fileinput-new">Seleccionar</span>
							<span class="fileinput-exists">Cambiar</span>
							<input type="file" name="file" accept="image/*">
						</span>
						<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Quitar</a>
					</div>
				</div>
				<?php }?>


			</div>
		</form>
        <script>
            $('#autocode').change(function(){
                if ($('#autocode').is(':checked') == true){
                    $('#code').val('').prop('disabled', true);
                } else {
                    $('#code').val('').prop('disabled', false);
                }
            });
        </script>
	</fieldset>
</div>
