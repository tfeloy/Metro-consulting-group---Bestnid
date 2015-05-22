<?php 
	include('conex.php');
	$con = Conectarse();	
	session_start();	

    $sqlLogin = 'SELECT id, nombre, apellido, username, email, telefono, fecha_nac, sexo, nro_tarjeta, es_admin, fecha_registro FROM users WHERE email = "'.$_POST['email'].'" and password = "'.md5($_POST['password']).'"  LIMIT 1';
	$resultLogin = mysqli_query($con,$sqlLogin);
	$row = mysqli_fetch_row($resultLogin);
	$login_ok = false; 

	if ($row) {
        $login_ok = true;
	}

	if($login_ok) { 
        $_SESSION['user'] = $row;
        /*
		[0]=> ID
		[1]=> NOMBRE
		[2]=> APELLIDO
		[3]=> USERNAME
		[4]=> EMAiL
		[5]=> TELEFONO
		[6]=> FECHA_NACIMIENTO
		[7]=> SEXO
		[8]=> NRO_TARJETA
		[9]=> ES_ADMIN
		[10]=> FECHA_REGISTRO
        */  
		echo '<script type="text/javascript"> window.location = "index.php"</script>';
    } 
    else {     
		$_SESSION['checklogin'] = 'Inicio de sesión incorrecto';
		echo '<script type="text/javascript"> window.location = "login.php"</script>';
    }
?>