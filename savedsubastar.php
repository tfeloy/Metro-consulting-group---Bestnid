<?php 
	include('conex.php');
	$con = Conectarse();	
	session_start();	

    date_default_timezone_set('America/Argentina/Buenos_Aires');     				/* Seteo hora de Argentina */
    $dia_actual = date('Y-m-d H:i:s');												/* Dia de hoy */

	$contador = 0;
	if (!empty($_FILES['archivo1']['name']))
	{
		$archivo1 = $_FILES['archivo1']['name'];
		$prefijo1 = substr(md5(uniqid(rand())),0,7);
		$tamano = $_FILES['archivo1']['size'];
		if ($tamano > 2000000){
		    $contador++;
		}
	}

	if($contador > 0)
	{
		$_SESSION['mensaje'] = 'El archivo Nro 1. supera los 2 Mb';
		echo '<script type="text/javascript"> window.location = "subastar.php"</script>';
	}
	else 
	{
	    $image_types = array
        ( 
			// JPEG 
			'image/jpeg'        => '.jpeg', 
			'image/jpg'        => '.jpg', 
			// (A)PNG (Animated) Portable Network Graphics 
			'image/png'        => '.png', 			
        );

	    $extension1 = $_FILES['archivo1']['type'];
		$nameArch1 = date("Y-m-d")."-P".$prefijo1."-Sub".$image_types[$extension1];		
		$destino =  "uploads/".$nameArch1;
		copy($_FILES['archivo1']['tmp_name'],$destino);
		
		$fecha_fin = strtotime( '+'.$_POST['dias'].' day', strtotime($dia_actual)); 	/* Incrementos los dias */
    	$fecha_fin = date('Y-m-d H:i:s', $fecha_fin);									/* Formateo fecha fin */

		/* Guardo luego de pasar todas las validaciones */
		$sql = 'INSERT INTO productos (id_categoria, id_vendedor, titulo, descripcion, imagen, precio, fecha_publicacion, fecha_fin, activo, vendido, comision ) ';
		$sql .= 'VALUES("'.$_POST['categoria'].'","'.$_SESSION['user'][0].'","'.$_POST['titulo'].'","'.$_POST['descripcion'].'","'.$nameArch1.'","NULL","'.$dia_actual.'","'.$fecha_fin.'","1","0","NULL")';
		$result = mysqli_query($con,$sql);

		if(!$result)
		{
			$_SESSION['mensaje'] = mysqli_error();
			mysqli_free_result($result);
			mysqli_close($con);
		}

		/* Redirecciones a Success.php con un lindo mensaje :-) */
		$_SESSION['mensaje'] = 'La publicación del producto se realizo exitosamente en Bestnid';
		echo '<script type="text/javascript"> window.location = "success.php"</script>';
	}
?>