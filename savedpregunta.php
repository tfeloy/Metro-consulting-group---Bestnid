<?php 
	include('conex.php');
	$con = Conectarse();	
	session_start();	

    date_default_timezone_set('America/Argentina/Buenos_Aires');     				/* Seteo hora de Argentina */
    $dia_actual = date('Y-m-d H:i:s');												/* Dia de hoy */
	
	/* Guardo luego de pasar todas las validaciones */
	$sql = 'INSERT INTO consultas (id_producto, id_usuario, pregunta, fecha_pregunta, id_vendedor, respuesta, fecha_respuesta ) ';
	$sql .= 'VALUES("'.$_POST['id_producto'].'","'.$_SESSION['user'][0].'","'.$_POST['pregunta'].'","'.$dia_actual.'","NULL","NULL","NULL")';
	$result = mysqli_query($con,$sql);

	if(!$result)
	{
		$_SESSION['mensaje'] = mysqli_error();
		mysqli_free_result($result);
		mysqli_close($con);
	}

	echo '<script type="text/javascript"> window.location = "versubasta.php?id='.$_POST['id_producto'].'"</script>';
?>