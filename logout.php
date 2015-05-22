<?php 
	session_start();	
    unset($_SESSION['user']);
	echo '<script type="text/javascript"> window.location = "login.php"</script>';
?>