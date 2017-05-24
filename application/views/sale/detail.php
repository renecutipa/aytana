<style>
.modal-dialog{
    width:720px;
}
</style>
<?php
if (isset($user->username)) {
} else {
    header("location: auth");
}
?>
<div class="main-content">
<!-- ----------------   CONTENIDO ----------------------- -->
<fieldset>
    Cliente  :
	<table class="table table-bordered stripe oscuro" id="saleList">
		<thead>
            <tr class="encabezado">
                <th style="width:10%">Codigo</th>
                <th style="width:50%">Descripcion</th>
                <th style="width:10%">Cantidad</th>
                <th style="width:10%">P.Unitario</th>
                <th style="width:10%">Desc.%</th>
                <th style="width:15%">Importe</th>
            </tr>
        </thead>
        <tbody>
           <?php 

            $total = 0.00;
            for($i = 0; $i < count($datos); $i++){
                echo "<tr>";
                echo "<td>".$datos[$i]["code"]."</td>";
                echo "<td>".$datos[$i]["name"]."</td>";
                echo "<td text-align='right'>".$datos[$i]["quantity"]."</td>";
                echo "<td text-align='right'>".$datos[$i]["saled_price"]."</td>";
                $total += (float)($datos[$i]["saled_price"]);                
                echo "<td text-align='right'>".$datos[$i]["discount"]."</td>";
                echo "<td text-align='right'>".$datos[$i]["total"]."</td>";
                echo "</tr>";
            }

           ?>
        </tbody>

        <tfoot>
        <tr>
            <td colspan="5"> TOTAL</td>
            <td style="text-align: right; font-size: 20px;"><?php echo number_format($total, 2)?></td>

        </tr>
        </tfoot>
	        
	</table>

</fieldset>
<!-- --------------   FIN CONTENIDO --------------------- -->
			
</div>