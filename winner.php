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
                
                //$queryOf = 'SELECT COUNT(o.id_usuario) AS cant FROM productos p INNER JOIN ofertas_realizadas o ON p.id=o.id_producto WHERE p.id="'.$row[id].'" AND o.activo=1';
                $queryOf = 'SELECT p.titulo, p.descripcion, o.* FROM productos p INNER JOIN ofertas_realizadas o ON p.id=o.id_producto WHERE p.id = '.$_GET['id'].' AND o.activo = 1';
                $resOf = mysqli_query($con,$queryOf);

                if (mysqli_num_rows($resOf) > 0)                           
                {
                    echo '
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>Necesidades</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                    <tbody>';

                    while ($row = mysqli_fetch_array($resOf, MYSQLI_ASSOC))                               
                    {
                        echo '
                        <tr>
                            <td>'.utf8_encode($row['necesidad_ofertada']).'</td>
                            <td>Column content</td>
                        </tr>';

                    }
                    echo '</tbody></table>';
                }

            ?>
        </div>

    </div>
</body>
</html>