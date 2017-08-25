<?php
@session_start();
if( $_SESSION['pasaporte'] != 1){?>
<script type="text/javascript">
	alert("La sesion caduco vuelve a iniciar sesion");
	document.location.href = 'index.php';
</script>
<?php	} ?>