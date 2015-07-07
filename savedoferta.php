<?php 
	include('conex.php');
	$con = Conectarse();	
	session_start();	

    date_default_timezone_set('America/Argentina/Buenos_Aires');     				/* Seteo hora de Argentina */
    $dia_actual = date('Y-m-d H:i:s');												/* Dia de hoy */


    $sqlOfertaExiste = 'SELECT 1 FROM ofertas_realizadas WHERE id_usuario = "'.$_SESSION['user'][0].'" and id_producto = "'.$_POST['id_producto'].'" LIMIT 1';
	$resOfertaExiste = mysqli_query($con,$sqlOfertaExiste);
	if (mysqli_fetch_row($resOfertaExiste)) 
	{
		mysqli_free_result($resOfertaExiste);
		mysqli_close($con);
		$_SESSION['mensaje'] = 'Ya oferto por este producto';
		echo '<script type="text/javascript"> window.location = "versubasta.php?id='.$_POST['id_producto'].'"</script>';
        die(); 
	}

	if((real)($_POST['precio']) < 1)
	{
		$_SESSION['mensaje'] = 'El precio mínimo permitido es $1';
		echo '<script type="text/javascript"> window.location = "versubasta.php?id='.$_POST['id_producto'].'"</script>';
        die();
	}

	/* Guardo luego de pasar todas las validaciones */
	$sql = 'INSERT INTO ofertas_realizadas (id_usuario, id_producto, precio_ofertado, necesidad_ofertada, fecha_oferta, activo, es_ganador ) ';
	$sql .= 'VALUES("'.$_SESSION['user'][0].'","'.$_POST['id_producto'].'","'.$_POST['precio'].'","'.$_POST['necesidad'].'","'.$dia_actual.'","1","0")';
	$result = mysqli_query($con,$sql);

	if(!$result)
	{
		$_SESSION['mensaje'] = mysqli_error();
		mysqli_free_result($result);
		mysqli_close($con);
		echo '<script type="text/javascript"> window.location = "versubasta.php?id='.$_POST['id_producto'].'"</script>';
        die(); 
	}
	
	mysqli_free_result($result);
	mysqli_close($con);
	$_SESSION['mensaje'] = 'La oferta se registro de manera correcta';
	echo '<script type="text/javascript"> window.location = "versubasta.php?id='.$_POST['id_producto'].'"</script>';
?>