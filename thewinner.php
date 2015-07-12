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
                                <li><a href="ajustes.php"><i class="fa fa-cogs"></i> Ajustes</a></li>
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

                /* Obtengo el precio */
                $sqlPrecio = 'SELECT * FROM ofertas_realizadas WHERE id_usuario = '.$_GET['id_usuario'].' AND id_producto = '.$_GET['id_producto'].' LIMIT 1';
                $resPrecio = mysqli_query($con,$sqlPrecio);
                if (!$resPrecio)
                {
                    mysqli_free_result($resPrecio);
                    mysqli_close($con);
                    $_SESSION['mensaje'] = 'No se encontro al ganador';
                    echo '<script type="text/javascript"> window.location = "success.php"</script>';
                    die();    
                }
                else
                {
                    $rowprice = mysqli_fetch_array($resPrecio, MYSQLI_ASSOC);
                    $precio_ofertado_win = $rowprice['precio_ofertado'];   
                    //Calculo el 30% de comision
                    $comision = (double)$precio_ofertado_win * 0.3; 
                    var_dump($comision);
                }

                $queryOf2 = 'UPDATE productos set precio = "'.$precio_ofertado_win.'", comision = "'.$comision.'", activo = 0, vendido = 1 WHERE id = '.$_GET['id_producto'];
                $resOf2 = mysqli_query($con,$queryOf2);
                if(!$resOf2)
                {
                    $_SESSION['mensaje'] = mysqli_error();
                    mysqli_free_result($resOf2);
                    mysqli_close($con);
                }

                /* Obtengo el ganador */
                $sqlWinOK = 'SELECT * FROM users WHERE id = "'.$_GET['id_usuario'].'" LIMIT 1';
                $resWinOK = mysqli_query($con,$sqlWinOK);
                if (!$resWinOK)
                {
                    mysqli_free_result($resWinOK);
                    mysqli_close($con);
                    $_SESSION['mensaje'] = 'No se encontro al ganador';
                    echo '<script type="text/javascript"> window.location = "success.php"</script>';
                    die(); 
                }
                else 
                {
                    $myrow = mysqli_fetch_array($resWinOK, MYSQLI_ASSOC);

                    /* Redirecciones a Success.php con un lindo mensaje :-) */
                    $cuerpo = 'El ganador del producto fue: '.$myrow['username'].' y oferto por el producto $'.$precio_ofertado_win.'. Bestnid cobro el 30% de comision que serian $'.$comision;

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
                    $mail->Subject = "Lo seleccionaron como ganador de la subasta";
                    $mail->AddAddress("ytagcom@gmail.com","Eres el ganador de la subasta en Bestnid");
                    $mail->IsHtml(true);
                    $mail->WordWrap = 50;

                    $mail->Body = $cuerpo;

                    /* 
                    // Lo dejo comentado asi no manda muchos mails                    

                    if(!$mail->Send())
                    {
                        mysqli_free_result($result);
                        mysqli_close($con);

                        $_SESSION['mensaje'] = $mail->ErrorInfo;
                        echo '<script type="text/javascript"> window.location = "success.php"</script>';
                    die(); 
                    }
                    else
                    {
                        $_SESSION['mensaje'] = $cuerpo;
                        echo '<script type="text/javascript"> window.location = "success.php"</script>';
                        die(); 
                    }
                    */

                    $_SESSION['mensaje'] = $cuerpo;
                    echo '<script type="text/javascript"> window.location = "success.php"</script>';

                }                
            ?>
        </div>

    </div>
</body>
</html>