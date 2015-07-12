<?php
    session_start();    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bestnid - Registrarse</title>
    <meta name="author" content="https://github.com/tfeloy/Metro-consulting-group---Bestnid/wiki">
    <link rel="shortcut icon" href="assets/img/favicon.ico" />
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <script src="assets/js/jquery-1.7.2.min.js"></script>
    <script src="assets/js/jquery-ui-1.8.21.custom.min.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script src="assets/js/validate.js"></script>
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
                    if($_SESSION['user'][9] == 0)
                    {
                        echo '<script type="text/javascript"> window.location = "index.php"</script>';
                    }
                    else
                    {
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo htmlentities($_SESSION['user'][3], ENT_QUOTES, 'UTF-8') ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="myaccount.php"><i class="fa fa-child"></i> Mi Cuenta</a></li>
                                <li><a href="changepass.php"><i class="fa fa-key"></i> Cambiar Contraseña</a></li>
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
            <form action="savedregistro.php" class="form-horizontal" method="post" id="registeradmin-form"> 
                <legend>Registro de Usuario</legend>
                <div class="form-group">
                    <label for="inputNombre" class="col-lg-2 control-label">Nombre</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="text" name="nombre" placeholder="Marcos">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputApellido" class="col-lg-2 control-label">Apellido</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="text" name="apellido" placeholder="Valdivia">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUsuario" class="col-lg-2 control-label">Usuario</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="text" name="username" placeholder="acebreak">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="text" name="email" placeholder="mi@correo.com.ar">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputContraseña" class="col-lg-2 control-label">Contraseña</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="password" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputTelefono" class="col-lg-2 control-label">Telefono</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="text" name="telefono" placeholder="2215034511">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputFechaNac" class="col-lg-2 control-label">Fecha Nacimiento</label>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-xs-3">
                                <input class="form-control" type="dia" name="dia" placeholder="Día">
                            </div>
                            <div class="col-xs-3">
                                <input class="form-control" type="mes" name="mes" placeholder="Mes">
                            </div>
                            <div class="col-xs-6">
                                <input class="form-control" type="ano" name="ano" placeholder="Año">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSexo" class="col-lg-2 control-label">Sexo</label>
                    <div class="col-lg-10">
                        <select name="sexo" class="sexo form-control" id="sexo">
                            <option value="">Sexo</option>
                            <option value="0">Mujer</option>
                            <option value="1">Hombre</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputNroTarjeta" class="col-lg-2 control-label">Nº Tarjeta</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="text" name="nro_tarjeta" placeholder="1243568790094578">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputAdmin" class="col-lg-2 control-label">¿Es Administrador?</label>
                    <div class="col-lg-10">
                        <input type="checkbox" name="es_admin" value="1">
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
                        <input type="submit" class="btn btn-success" value="Registrarse" /> 
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>