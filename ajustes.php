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
        
        <?php
            $sql = "SELECT count(p.id) AS Cant FROM users AS u LEFT JOIN productos AS p ON u.id = p.id_vendedor WHERE u.id = ".$_SESSION['user'][0];
            $result = mysqli_query($con,$sql);
            $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
        ?>

		<div class="row">
            <div class="col-sm-6">
                <div class="well well-lg">
                    <center>
                        <a href="changepass.php" class="btn btn-link"><i class="fa fa-5x fa-key"></i></a>
                        <a href="changepass.php"><h2>Cambiar Contraseña</h2></a>
                    </center>
                </div>
            </div>
            <?php 
            if ($myrow['Cant'] != 0) {
                echo '
                <div class="col-sm-6">
                    <div class="well well-lg">
                        <center>                            
                            <a href="#" class="btn btn-link"><i class="fa fa-5x fa-trash-o"></i></a>
                            <h4>Para eliminar su cuenta no debe tener ninguna publicación activa</h4>
                        </center>
                    </div>
                </div>';
            }
            else
            {
                echo '
                <div class="col-sm-6">
                    <div class="well well-lg">
                        <center>
                            <a title="Eliminar Usuario" data-toggle="modal" data-target="#myModalDelete" class="btn btn-link"><i class="fa fa-5x fa-trash-o"></i></a>
                            <a title="Eliminar Usuario" data-toggle="modal" data-target="#myModalDelete"><h2>Eliminar Mi Cuenta</h2></a>
                        </center>
                    </div>
                </div>'; 

                echo '
                <!-- MODAL PARA LA CONFIRMACION DE ELIMINAR EL USUARIO -->
                <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Eiminar el Usuario</h4>
                            </div>
                            <div class="modal-body">
                                <form action="deleteaccount.php" method="post"> 
                                    <center>
                                        <p class="lead">¿Está seguro que desea su cuenta: <strong>"'.htmlentities($_SESSION['user'][3], ENT_QUOTES, 'UTF-8').'"</strong>?</p>
                                        <input type="hidden" name="id_usuario" value="'.$_SESSION['user'][0].'">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                                        <input type="submit" class="btn btn-primary" value="Eliminar" /> 
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</body>
</html>