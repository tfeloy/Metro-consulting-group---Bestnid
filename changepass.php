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
            <form action="savedchange.php" class="form-horizontal" method="post" id="change-form"> 
                <legend>Cambiar Contraseña de Usuario</legend>
                <div class="form-group">
                    <label for="inputContraseña" class="col-lg-2 control-label">Contraseña Vieja</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="password" name="oldpassword">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputContraseña" class="col-lg-2 control-label">Contraseña Nueva</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="password" name="newpassword">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputContraseña" class="col-lg-2 control-label">Repita Contraseña la Nueva</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="password" name="renewpassword">
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
                        <input type="submit" class="btn btn-success" value="Cambiar" /> 
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>