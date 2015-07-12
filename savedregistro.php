<?php 
	include('conex.php');
	$con = Conectarse();	
	session_start();	

    date_default_timezone_set('America/Argentina/Buenos_Aires');     	/* Seteo hora de Argentina */
    $dia_actual = date("y/m/d H:i:s");									/* Dia de hoy */

    /* Consulto si ya esta en uso el corre electronico */
    $sqlEmailExiste = 'SELECT 1 FROM users WHERE email = "'.$_POST['email'].'" LIMIT 1';
	$resEmailExiste = mysqli_query($con,$sqlEmailExiste);
	if (mysqli_fetch_row($resEmailExiste)) 
	{
		mysqli_free_result($resEmailExiste);
		mysqli_close($con);

		$_SESSION['nombre'] = $_POST['nombre'];
	    $_SESSION['apellido'] = $_POST['apellido'];
	    $_SESSION['username'] = $_POST['username'];
	    $_SESSION['telefono'] = $_POST['telefono'];
		$_SESSION['dia'] = $_POST['dia'];
		$_SESSION['mes'] = $_POST['mes'];
		$_SESSION['ano'] = $_POST['ano'];
		$_SESSION['nro_tarjeta'] = $_POST['nro_tarjeta'];

		$_SESSION['mensaje'] = 'El email ya esta en uso, por favor use otro';
		echo '<script type="text/javascript"> window.location = "registro.php"</script>';
		//header("Location: $pathbase/registro.php"); 
        die(); 
	}

	/* Consulto si ya esta en uso el nombre de usuario */
	$sqlUsernameExiste = 'SELECT 1 FROM users WHERE username = "'.$_POST['username'].'" LIMIT 1';
	$resUsernameExiste = mysqli_query($con,$sqlUsernameExiste);
	if (mysqli_fetch_row($resUsernameExiste)) 
	{
		mysqli_free_result($resUsernameExiste);
		mysqli_close($con);

		$_SESSION['nombre'] = $_POST['nombre'];
	    $_SESSION['apellido'] = $_POST['apellido'];
	    $_SESSION['email'] = $_POST['email'];
	    $_SESSION['telefono'] = $_POST['telefono'];
		$_SESSION['dia'] = $_POST['dia'];
		$_SESSION['mes'] = $_POST['mes'];
		$_SESSION['ano'] = $_POST['ano'];
		$_SESSION['nro_tarjeta'] = $_POST['nro_tarjeta'];

		$_SESSION['mensaje'] = 'El Usuario ya esta en uso, por favor use otro';
		echo '<script type="text/javascript"> window.location = "registro.php"</script>';
		die(); 
	}

	// Security 
    $password = md5($_POST['password']); 
    $fecha_nacimiento = $_POST['ano'].'-'.$_POST['mes'].'-'.$_POST['dia'];

	/* Guardo luego de pasar todas las validaciones */
	$sql = 'INSERT INTO users (nombre, apellido, username, password, email, telefono, fecha_nac, sexo, nro_tarjeta, es_admin, fecha_registro) ';
	$sql .= 'VALUES("'.$_POST['nombre'].'","'.$_POST['apellido'].'","'.$_POST['username'].'","'.$password.'","'.$_POST['email'].'","'.$_POST['telefono'].'","'.$fecha_nacimiento.'","'.$_POST['sexo'].'","'.$_POST['nro_tarjeta'].'","'.$_POST['es_admin'].'","'.$dia_actual.'")';
	$result = mysqli_query($con,$sql);

	if(!$result)
	{
		$_SESSION['mensaje'] = mysqli_error();
		mysqli_free_result($result);
		mysqli_close($con);
	}

	/* Redirecciones a Success.php con un lindo mensaje :-) */
	$_SESSION['mensaje'] = 'El registro se realizo exitosamente, ya puede publicar y comprar en Bestind';
	echo '<script type="text/javascript"> window.location = "success.php"</script>';
?>