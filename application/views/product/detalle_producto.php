<style>
.modal-dialog{
	width:950px;
}
</style>
<div class="main-content">
	<fieldset>
		<div class="col-xs-8">
			<img src="<?php echo base_url()."uploads/".$producto->image; ?>" width="550" height="550" />
		</div>
		<div class="col-xs-4">
            <div class="row">
                <img src="<?php echo $marca->image;?>"/>
            </div>
            <div class="row">
                <?php echo $modelo->name;?>
            </div>
            <div class="row">
                <?php echo $categoria->name;?>
            </div>
            <div class="row">
                <?php echo $producto->description;?>
            </div>

		</div>
	</fieldset>
</div>
