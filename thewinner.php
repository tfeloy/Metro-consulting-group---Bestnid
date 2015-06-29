<?php
    include('conex.php');
    $con = Conectarse();    
    session_start();    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bestnid - Mi Cuenta</title>
    <meta name="author" content="https://github.com/tfeloy/Metro-consulting-group---Bestnid/wiki">
    <link rel="shortcut icon" href="assets/img/favicon.ico" />
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <script src="assets/js/jquery-1.7.2.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Bestnid</a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse"> 
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if(empty($_SESSION['user'])) 
                    {
						echo '<script type="text/javascript"> window.location = "login.php"</script>';
                    }
                    else
                    {
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo htmlentities($_SESSION['user'][3], ENT_QUOTES, 'UTF-8') ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="myaccount.php"><i class="fa fa-child"></i> Mi Cuenta</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Cerrar Sesión</a></li>
                            </ul>
                        </li>
                        <li><a href="subastar.php">Subastar</a></li>
                        <?php
                    }
                ?>
                <li><a href="ayuda.php"><i class="fa fa-life-ring"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="container">   
        <div class="col-lg-12">
            <?php       
                
                $queryOf = 'UPDATE ofertas_realizadas set es_ganador = 1 WHERE id_usuario = '.$_GET['id_usuario'].' AND id_producto = '.$_GET['id_producto'];
                $resOf = mysqli_query($con,$queryOf);

                if(!$resOf)
                {
                    $_SESSION['mensaje'] = mysqli_error();
                    mysqli_free_result($resOf);
                    mysqli_close($con);
                }


                /* Envio el mail */ 

                /*
                
                // Lo comento sino me tapa la casilla de mails jaja

                $to = 'nrejep@e-gate.com.ar';
                $subject = 'Notificaciones Bestnid';
                $message = 'Es el ganador del producto';
                $from = "From: Notificaciones Bestnid <ytagcom@gmail.com>";
                mail($to,$subject,$message,$from);
                */

                /* Redirecciones a Success.php con un lindo mensaje :-) */
                $_SESSION['mensaje'] = 'Se eligio al ganador del producto';
                echo '<script type="text/javascript"> window.location = "success.php"</script>';

            ?>
        </div>

    </div>
</body>
</html>