<?php
    include('conex.php');
    $con = Conectarse();    
    session_start();    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bestnid</title>
    <meta name="author" content="https://github.com/tfeloy/Metro-consulting-group---Bestnid/wiki">
    <link rel="shortcut icon" href="assets/img/favicon.ico" />
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <script src="assets/js/jquery-1.7.2.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script src="assets/js/validate.js"></script>
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
                        ?>
                        <li><a href="registro.php">Registrarse</a></li>
                        <li><a href="login.php">Iniciar Sesión</a></li>
                        <?php
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
        <div class="jumbotron">

            <?php
            if (!$_POST['envio'])
            {
                /* BUSCO LOS DATOS DEL REGISTRO QUE VOY A EDITAR */

                $sql = "SELECT * FROM ofertas_realizadas WHERE id_producto = ".$_GET['id']." and id_usuario = ".$_SESSION['user'][0];
                $result = mysqli_query($con,$sql);

                if (mysqli_num_rows($result) > 0)                           
                {
                    $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    ?>
                        <form action="editMonto.php" class="form-horizontal" method="post" id="editarMonto-form" enctype="multipart/form-data"> 
                            <legend>Editar Oferta</legend>
                            <div class="form-group">
                               <div class="col-lg-2"><label for="inputMonto" class="control-label">Necesidad Ofertada</label></div>
                                <div class="col-lg-10">
                                   <p><?php echo $myrow['necesidad_ofertada']; ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-2"><label for="inputMonto" class="control-label">Precio Ofertado</label></div>
                                <div class="col-lg-10">
                                    <div class="input-group" name="inputMonto">
                                        <input class="form-control" type="text" name="precio" value=<?php echo '"'.$myrow['precio_ofertado'].'"' ?>>
                                    </div>
                                </div>
                            </div>
                            <?php
                                if (!empty($_SESSION['sub']))
                                {
                                    echo'<div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <div class="alert alert-dismissible alert-danger">
                                                <strong>'.$_SESSION['sub'].'</strong>
                                            </div>
                                        </div>
                                    </div>
                                    ';
                                    unset($_SESSION['sub']); //Elimino la variable de session luego de imprimirla
                                }
                            ?>
                            <input type="hidden" name="id_producto" value=<?php echo '"'.$myrow['id_producto'].'"' ?>>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <input type="submit" class="btn btn-success" name="envio" value="Modificar" /> 
                                </div>
                            </div>
                        </form>
                    <?php
                }
                else
                {
                    echo '<script type="text/javascript"> window.location = "index.php"</script>';
                }
            }
            else
            {
                /* ARMO EL UPDATE */

                    $sqlUpdate = 'UPDATE ofertas_realizadas SET precio_ofertado = "'.$_POST['precio'].'" WHERE id_producto = "'.$_POST['id_producto'].'" and id_usuario = "'.$_SESSION['user'][0].'"';
                    $resultUpdate = mysqli_query($con,$sqlUpdate);

                    if(!$resultUpdate)
                    {
                        $_SESSION['mensaje'] = mysqli_error();
                        mysqli_free_result($resultUpdate);
                        mysqli_close($con);
                    }

                    /* Redirecciones a Success.php con un lindo mensaje :-) */
                    $_SESSION['mensaje'] = 'La publicación del producto se modifico exitosamente';
                    echo '<script type="text/javascript"> window.location = "success.php"</script>';
            }
           

        ?>

        </div>        
    </div>
</body>
</html>