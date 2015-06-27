<?php 
	include('conex.php');
	$con = Conectarse();	
	session_start();												
	
	/* Guardo luego de pasar todas las validaciones */
	$sql = 'UPDATE productos SET activo=0 WHERE id="'.$_POST['id'].'"';
	$result = mysqli_query($con,$sql);

	if(!$result)
	{
		$_SESSION['mensaje'] = mysqli_error();
		mysqli_free_result($result);
		mysqli_close($con);
	}

	echo '<script type="text/javascript"> window.location = "myaccount.php"</script>';
?>