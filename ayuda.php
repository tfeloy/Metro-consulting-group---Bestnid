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
        <div class="row">
            <div class="col-lg-12">
                <h1>PREGUNTAS FRECUENTES </h1>

                <blockquote>
                  <p>Bestnid es considerado un remate, pero un tanto particular. En Bestnid el bien subastado no se adjudica al postor que más dinero haya ofrecido por él, sino que cada postor comunica por qué necesita dicho producto, y el subastador elegirá un ganador.</p>
                  <small>¿Cómo funciona Bestnid?</small>
                </blockquote>

                <blockquote>
                  <p>Si no recuerda su nombre de usuario, puede iniciar sesión con el mail que proporcionó a Bestnid al registrarse. También puede, desde la ventana de inicio de sesión, solicitar la recuperación de su contraseña simplemente ingresando su dirección de e-mail y le enviaremos un correo con la nueva contraseña. </p>
                  <small>¿Cómo recuperar mi usuario o contraseña?</small>
                </blockquote>

                <blockquote>
                  <p>Arriba a la derecha, haciendo click en tu nombre, se desplegará un menú. Selecciona “ajustes” y luego “Cambiar contraseña”.</p>
                  <small>¿Cómo cambiar mi contraseña?</small>
                </blockquote>


                <blockquote>
                  <p>Primero debes haber iniciado sesión. Selecciona el producto por el que desees ofertar, y presiona “Ofertar”, luego expresa porqué te consideras merecedor del producto y haz tu oferta. </p>
                  <small>¿Cómo ofertar por un producto?</small>
                </blockquote>

                <blockquote>
                  <p>Si. Siempre que no tenga ofertas activas, puedes modificarla. Para ello sólo debes ir a “Mi cuenta”,”Mis publicaciones”, “Editar Publicación”.</p>
                  <small>¿Se puede modificar una publicación mía?</small>
                </blockquote>
            </div>
            <div class="col-lg-12">
                <center>
                    <a href="index.php" class="btn btn-primary">Volver</a>
                </center>
            </div> 
        </div>     
    </div>
</body>
</html>