
<?php
if (isset($user->username)) {
} else {
    header("location: auth");
}
?>



<?php $this->load->view('top');?>
<!-- ----------------   CONTENIDO ----------------------- -->
<div class="row">

</div>
<!-- --------------   FIN CONTENIDO --------------------- -->
<!-- Footer -->
<?php $this->load->view('bottom');?>
<!-- FIN -->
