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
       
        <?php
            if (!$_POST['envio'])
            {
                echo ' <div class="jumbotron">';
                $sql = "SELECT nombre, apellido, email, telefono, DAY(fecha_nac) AS dia, MONTH(fecha_nac) AS mes, YEAR(fecha_nac) AS ano, nro_tarjeta FROM users WHERE id =".$_SESSION['user'][0];
                $result = mysqli_query($con,$sql);
                 if (mysqli_num_rows($result) > 0)                           
                {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        ?>
                     <form action="editPerfil.php" class="form-horizontal" method="post" id="editPerfil-form">
                        <legend>Perfil de Usuario</legend>
                        <div class="form-group">
                            <label for="inputNombre" class="col-lg-2 control-label">Nombre</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" name="nombre" placeholder="<?php echo $row['nombre']; ?>" value="<?php echo $row['nombre']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputApellido" class="col-lg-2 control-label">Apellido</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" name="apellido" placeholder="<?php echo $row['apellido']; ?>" value="<?php echo $row['apellido']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" name="email" placeholder="<?php echo $row['email']; ?>" value="<?php echo $row['email']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTelefono" class="col-lg-2 control-label">Telefono</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" name="telefono" placeholder="<?php echo $row['telefono']; ?>" value="<?php echo $row['telefono']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputFechaNac" class="col-lg-2 control-label">Fecha Nacimiento</label>
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <input class="form-control" type="text" name="dia" placeholder="dia" value="<?php echo $row['dia']; ?>">
                                    </div>
                                    <div class="col-xs-3">
                                        <input class="form-control" type="text" name="mes" placeholder="mes" value="<?php echo $row['mes']; ?>">
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control" type="text" name="ano" placeholder="año" value="<?php echo $row['ano']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNroTarjeta" class="col-lg-2 control-label">Nº Tarjeta</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" name="nro_tarjeta" placeholder="<?php echo $row['nro_tarjeta']; ?>" value="<?php echo $row['nro_tarjeta']; ?>">
                            </div>
                        </div>
                        <?php
                            if (!empty($_SESSION['mensaje']))
                            {
                                echo'
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <div class="alert alert-dismissible alert-danger">
                                            <strong>'.$_SESSION['mensaje'].'</strong>
                                        </div>
                                    </div>
                                </div>
                                ';
                                unset($_SESSION['mensaje']); //Elimino la variable de session luego de imprimirla
                            }
                        ?>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <input type="submit" class="btn btn-success" name="envio" value="Modificar" /> 
                            </div>
                        </div>
                     </form>
                     </div>
        <?php
                     mysqli_free_result($result);
                }
                else
                {
                    echo '<script type="text/javascript"> window.location = "index.php"</script>';
                }
            }
            else
            {
                /* ARMO EL UPDATE */
                    $fecha_nacimiento = $_POST['ano'].'-'.$_POST['mes'].'-'.$_POST['dia'];
                    $sqlUpdate = 'UPDATE users SET nombre="'.$_POST['nombre'].'", apellido="'.$_POST['apellido'].'",email="'.$_POST['email'].'",telefono="'.$_POST['telefono'].'",fecha_nac="'.$fecha_nacimiento.'",nro_tarjeta="'.$_POST['nro_tarjeta'].'" WHERE id="'.$_SESSION['user'][0].'"';
                    $resultUpdate = mysqli_query($con,$sqlUpdate);

                    if(!$resultUpdate)
                    {
                        $_SESSION['mensaje'] = mysqli_error();
                        mysqli_free_result($resultUpdate);
                        mysqli_close($con);
                    }

                    /* Redirecciones a Success.php con un lindo mensaje :-) */
                    $_SESSION['mensaje'] = 'El perfil se modifico exitosamente';
                    echo '<script type="text/javascript"> window.location = "success.php"</script>';
                

            }
        ?>
    </div>
</body>
</html>