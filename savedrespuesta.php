<?php 
	include('conex.php');
	$con = Conectarse();	
	session_start();	

    date_default_timezone_set('America/Argentina/Buenos_Aires');     				/* Seteo hora de Argentina */
    $dia_actual = date('Y-m-d H:i:s');												/* Dia de hoy */
	
	$id = $_POST['id_consulta'];

	/* Guardo luego de pasar todas las validaciones */
	$sql = 'UPDATE consultas SET respuesta="'.$_POST['respuesta'].'", fecha_respuesta="'.$dia_actual.'" WHERE id="'.$id.'"';
	$result = mysqli_query($con,$sql);

	if(!$result)
	{
		$_SESSION['mensaje'] = mysqli_error();
		mysqli_free_result($result);
		mysqli_close($con);
	}

	echo '<script type="text/javascript"> window.location = "versubasta.php?id='.$_POST['id_producto'].'"</script>';
?>