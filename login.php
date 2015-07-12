<?php
    include('conex.php');
    $con = Conectarse();    
    session_start();    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bestnid - Iniciar Sesión</title>
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
            <form action="checklogin.php" class="form-horizontal" method="post"> 
                <legend>Iniciar Sesión</legend>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Email o Username</label>
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
                
                
                <?php
                    if (!empty($_SESSION['checklogin']))
                    {
                        echo'
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <div class="alert alert-dismissible alert-danger">
                                    <strong>'.$_SESSION['checklogin'].'</strong>
                                </div>
                            </div>
                        </div>
                        ';
                        unset($_SESSION['checklogin']); //Elimino la variable de session luego de imprimirla
                    }
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
                        <input type="submit" class="btn btn-success" value="Iniciar Sesión" /> 
                    </div>
                </div>
            </form>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a title="Olvide la contraseña" data-toggle="modal" data-target="#myModalPass"><h5>Recuperar Contraseña</h5></a>
                </div>

                <!-- MODAL PARA LA CONFIRMACION DE ELIMINAR EL USUARIO -->
                <div class="modal fade" id="myModalPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Recuperar Contraseña</h4>
                            </div>
                            <div class="modal-body">
                                <form action="recovery.php" method="post" id="recovery-form"> 
                                    <div>
                                        <input class="form-control" type="text" name="email" placeholder="Ingrese su email">    
                                    </div>
                                    <br>
                                    <div>
                                        <center>
                                            <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                                            <input type="submit" class="btn btn-primary" value="Recuperar" /> 
                                        </center>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>