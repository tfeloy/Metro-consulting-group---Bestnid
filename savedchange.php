<?php 
	include('conex.php');
	$con = Conectarse();	
	session_start();	

    /* Consulto si la contraseña coincide con el usuario logueado */
	$sqlPassOK = 'SELECT 1 FROM users WHERE email = "'.$_SESSION['user'][4].'" and password = "'.md5($_POST['oldpassword']).'"  LIMIT 1';
	$resPassOK = mysqli_query($con,$sqlPassOK);
	if (!(mysqli_fetch_row($resPassOK)))
	{
		mysqli_free_result($resPassOK);
		mysqli_close($con);
		$_SESSION['mensaje'] = 'La contraseña actual ingresada es incorrecta';
		echo '<script type="text/javascript"> window.location = "changepass.php"</script>';
        die(); 
	}

	if (md5($_POST['newpassword']) != md5($_POST['renewpassword']))
	{
		$_SESSION['mensaje'] = 'Las contraseñas nuevas ingresada no coinciden';
		echo '<script type="text/javascript"> window.location = "changepass.php"</script>';
        die(); 
	}

	/* Guardo la nueva contraseña luego pasar todas las validaciones */
    $password = md5($_POST['newpassword']); 
	$sql = 'UPDATE users SET password = "'.$password.'" WHERE id = "'.$_SESSION['user'][0].'"';
	$result = mysqli_query($con,$sql);

	if(!$result)
	{
		$_SESSION['mensaje'] = mysqli_error();
		mysqli_free_result($result);
		mysqli_close($con);
	}

	/* Redirecciones a Success.php con un lindo mensaje :-) */
    unset($_SESSION['user']);
	$_SESSION['mensaje'] = 'La contraseña se cambio de manara exitosa. Inicie sesión con la nueva contraseña para volver a operar';
	echo '<script type="text/javascript"> window.location = "success.php"</script>';
?>