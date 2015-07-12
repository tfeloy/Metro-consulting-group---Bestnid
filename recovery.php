<?php 
	include('conex.php');
	$con = Conectarse();	
	session_start();	

    /* Consulto si el email ingresado esta en la DB */
	$sqlMailOK = 'SELECT 1 FROM users WHERE email = "'.$_POST['email'].'" LIMIT 1';
	$resMailOK = mysqli_query($con,$sqlMailOK);
	if (!(mysqli_fetch_row($resMailOK)))
	{
		mysqli_free_result($resMailOK);
		mysqli_close($con);
		$_SESSION['mensaje'] = 'El email ingresado no existe en el sistema';
		echo '<script type="text/javascript"> window.location = "login.php"</script>';
        die(); 
	}

	/* Guardo la nueva contraseña luego de pasar todas las validaciones */
    $password = md5("bestnid"); 
	$sql = 'UPDATE users SET password = "'.$password.'" WHERE email = "'.$_POST['email'].'"';
	$result = mysqli_query($con,$sql);

	if(!$result)
	{
		$_SESSION['mensaje'] = mysqli_error();
		mysqli_free_result($result);
		mysqli_close($con);
	}

	include "class.phpmailer.php";
	include "class.smtp.php";

	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->Mailer="smtp";
	$mail->Host = 'smtp.gmail.com';
	$mail->Port=587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "contactobestnid@gmail.com";
	$mail->Password = "bestnid1234";
	$mail->From = "contactobestnid@gmail.com";
	$mail->FromName = "Notificaciones Bestnid";
	$mail->Subject = "Recuperacion de contraseña";
	$mail->AddAddress($_POST['email'],"Recuperacion de contraseña Bestnid");
	$mail->IsHtml(true);
	$mail->WordWrap = 50;

	$cuerpo = "Su nueva contraseña es bestnid";

	$mail->Body = $cuerpo;

	if(!$mail->Send())
	{
		mysqli_free_result($result);
		mysqli_close($con);

		$_SESSION['mensaje'] = $mail->ErrorInfo;
		echo '<script type="text/javascript"> window.location = "login.php"</script>';
		exit;
	}
	else
	{
		/* Redirecciones a success.php con un lindo mensaje :-) */
		$_SESSION['mensaje'] = 'Se genero una nueva contraseña y se le envio a su email';
		echo '<script type="text/javascript"> window.location = "success.php"</script>';
	}	
?>