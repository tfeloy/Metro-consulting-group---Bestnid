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
        <div class="row">
            <div class="col-sm-2">
                <a href="index.php">
                    <img alt="" class="img-responsive" src="assets/img/logo.jpg">
                </a>
            </div>
            <div class="col-sm-10">
                <h1>Bestnid</h1>
                <p>Donde todo lo que necesitas lo podes encontrar solo acá</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <form action="subastas.php" class="form-horizontal" method="POST">
                    <div class="input-group">
                        <input class="form-control" name="search" id="search" type="text">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" onclick="submit()"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-4">
                <h3>Categorias</h3>
                <?php
                    $query = 'SELECT id, nombre FROM categorias ORDER BY nombre';
                    $result = mysqli_query($con,$query);
                    if (mysqli_num_rows($result) > 0)                           
                    {                               
                        echo '<div class="list-group">';                                                             
                        while ($row_cat = mysqli_fetch_array($result, MYSQLI_ASSOC))                               
                        {
                            $verCat = 'subastas.php?id='.$row_cat['id'];
                            echo '<a href="'.$verCat.'" class="list-group-item">'.utf8_encode($row_cat['nombre']).'</a>';
                        }
                        echo "</div>";
                    }
                    mysqli_free_result($result);
                ?>
            </div>
            <div class="col-md-8">
                <h3>Publicaciones Destacadas</h3>
                <div class="row">
                    <?php
                        $query2 = 'SELECT p.id, p.titulo, p.descripcion, p.imagen, DATE(p.fecha_fin) AS vigencia, c.nombre AS catName FROM productos p INNER JOIN categorias c ON p.id_categoria = c.id WHERE p.activo = 1 AND fecha_fin >= curdate() ORDER BY vigencia ASC LIMIT 4';
                        $result2 = mysqli_query($con,$query2);
                        if (mysqli_num_rows($result2) > 0)                           
                        {                               
                            while ($row_prod = mysqli_fetch_array($result2, MYSQLI_ASSOC))                               
                            {
                                echo '<div class="col-lg-6"><div class="panel panel-default"><div class="panel-body"><center>';
                                echo '<h4>'.utf8_encode($row_prod['titulo']).'</h4>';
                                $verSubasta = 'versubasta.php?id='.$row_prod['id'];
                                echo '<img alt="" class="img-responsive sizeimage250" src="uploads/'.$row_prod['imagen'].'">';
                                echo '<a href="'.$verSubasta.'" class="btn btn-primary">Ver Publicación</a>';
                                echo "</center></div></div></div>";
                            }
                        }
                        mysqli_free_result($result2);
                    ?>
                </div>                  
            </div>
            <div class="col-lg-12">
                <center>
                    <a href="subastas.php" class="btn btn-primary btn-block">Ver todas las publicaciones</a>
                </center>
            </div>
        </div>
    </div>
    <br>

    <script>
        $("[data-toggle=popover]").popover();
    </script>
</body>
</html>