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
                if (!empty($_SESSION['mensaje']))
                {
                    echo'<div class="col-lg-12">
                            <div class="alert alert-dismissible alert-success">
                            <center>
                                <strong>'.$_SESSION['mensaje'].'</strong>
                            </center>
                            </div>
                        </div>';
                    unset($_SESSION['mensaje']); //Elimino la variable de session luego de imprimirla
                }
            
                // UPDATE ofertas_realizadas set es_ganador = 1 WHERE id_usuario = 9 AND id_producto = 15          
                $queryOf = 'SELECT p.titulo, p.descripcion, o.* FROM productos p INNER JOIN ofertas_realizadas o ON p.id=o.id_producto WHERE p.id = '.$_GET['id'].' AND o.activo = 1 AND DATE(p.fecha_fin) < DATE(NOW())';
                $resOf = mysqli_query($con,$queryOf);

                if (mysqli_num_rows($resOf) > 0)                           
                {
                    $query = 'SELECT * FROM ofertas_realizadas WHERE id_producto = '.$_GET['id'].' AND activo = 1 AND es_ganador = 0';
                    $result = mysqli_query($con,$query);

                    if (mysqli_num_rows($resOf) == mysqli_num_rows($result))
                    {
                        echo '
                        <table class="table table-striped table-hover ">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Necesidades</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                        <tbody>';

                        while ($row = mysqli_fetch_array($resOf, MYSQLI_ASSOC))                               
                        {
                                                                        
                            $gano = 'thewinner.php?id_producto='.$row['id_producto'].'&id_usuario='.$row['id_usuario'];
                            echo '
                            <tr>
                                <td>'.utf8_encode($row['titulo']).'</td>
                                <td>'.utf8_encode($row['necesidad_ofertada']).'</td>
                                <td><a href="'.$gano.'" class="btn btn-primary btn-xs">Seleccionar como ganador</a></td>
                            </tr>';

                        }
                        echo '</tbody></table>';
                    }
                    else
                    {
                        echo '
                        <h3>Ya eligio un ganador</h3>
                        <table class="table table-striped table-hover ">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Necesidades</th>
                                    <th>Ganador</th>
                                    <th>Gano</th>
                                </tr>
                            </thead>
                        <tbody>';

                        while ($row = mysqli_fetch_array($resOf, MYSQLI_ASSOC))                               
                        {
                            $query2 = 'SELECT * FROM users WHERE id = '.$row['id_usuario'];
                            $resultUser = mysqli_query($con,$query2);
                            $rowUser = mysqli_fetch_array($resultUser, MYSQLI_ASSOC);

                            echo '
                            <tr>
                                <td>'.utf8_encode($row['titulo']).'</td>
                                <td>'.utf8_encode($row['necesidad_ofertada']).'</td>';
                                if ($row['es_ganador'] == 1) {
                                    echo '<td>'.$rowUser['username'].' (<a href="mailto:'.$rowUser['email'].'?Subject=Gano%20la%20oferta%20en%20Bestnid" target="_top">'.$rowUser['email'].'</a>)</td>';
                                    echo '<td><i class="fa fa-check text-success"></i> $'.$row['precio_ofertado'].'</td>';
                                }
                                else
                                {
                                    echo '<td><i class="fa fa-minus text-danger"></i></td>';
                                    echo '<td><i class="fa fa-times text-danger"></i></td>';
                                }
                                echo '
                            </tr>';

                        }
                        echo '</tbody></table>';
                    }
                }
                else
                {
                    echo 'Aun no puede elegir un ganador';
                }

                echo '
                <div class="row">
                    <center>
                        <a href="myaccount.php" class="btn btn-danger btn-lg">Volver</a>
                    </center>
                </div>';

            ?>
        </div>

    </div>
</body>
</html>