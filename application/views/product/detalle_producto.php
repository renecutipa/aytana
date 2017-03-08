<style>
.modal-dialog{
	width:540px;
}
</style>
<div class="main-content">
	<fieldset>
		<div>
			<img src="<?php echo base_url()."uploads/".$producto->image; ?>" width="450" height="450" />
		</div>
        <div style="font-size: 14px; color: #000;">
            <?php echo "<b>".$modelo->name ." - ".$modelo->name ." - ".$categoria->name."</b><br>".$producto->description;?>
        </div>
        </div>
		<!--div class="col-xs-4">
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

		</div-->
	</fieldset>
</div>
