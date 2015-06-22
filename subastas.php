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
            <div class="col-sm-2 col-lg-offset-10">
                <form id="order-form" class="form-horizontal" action="subastas.php" method="POST">
                  <div class="form-group">
                    <label class="control-label" for="order-list">Ordenar por</label>
                    <select id="order-list" name="order-list" class="form-control input-sm" onchange="this.form.submit()">
                      <option value="" <?php if(isset($_POST['order-list'])){echo ' hidden';} ?> >Sin Orden</option>
                      <option value="nombre" <?php if(isset($_POST['order-list'])){ if($_POST['order-list'] == "nombre"){echo ' selected';}} ?> >Nombre</option>
                      <option value="fecha" <?php if(isset($_POST['order-list'])){ if($_POST['order-list'] == "fecha"){echo ' selected';}} ?> >Fecha</option>
                    </select>   
                    <?php
                        if(isset($_POST['search']))
                        {
                            echo '<input name="search" id="search" type="hidden" value="'.$_POST['search'].'">';
                        }
                        if(isset($_GET['id']))
                        {
                            echo '<input name="id" id="id" type="hidden" value="'.$_GET['id'].'">';
                        }
                        if(isset($_POST['id']))
                        {
                            echo '<input name="id" id="id" type="hidden" value="'.$_POST['id'].'">';
                        }
                    ?>
                  </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    $query = 'SELECT p.id, p.titulo, p.descripcion, p.imagen, DATE(p.fecha_fin) AS vigencia, c.nombre AS catName FROM productos p INNER JOIN categorias c ON p.id_categoria = c.id WHERE p.activo = 1 AND fecha_fin >= curdate()';
                    if(isset($_GET['id']))
                    {
                        $query .= ' AND p.id_categoria = '.$_GET['id'];
                    }
                    if(isset($_POST['id']))
                    {
                        $query .= ' AND p.id_categoria = '.$_POST['id'];
                    }
                    if(isset($_POST['search']))
                    {
                        $query .= ' AND (p.titulo LIKE "%'.$_POST['search'].'%" OR p.descripcion LIKE "%'.$_POST['search'].'%" OR c.nombre LIKE "%'.$_POST['search'].'%")';
                        echo "<p>Esta buscando: <strong>".$_POST['search']."</strong></p>";
                    }

                    if(isset($_POST['order-list']))
                    {
                        if($_POST['order-list'] == "nombre")
                        {
                            $query .= ' ORDER BY p.titulo';    
                        }
                        else
                        {
                            $query .= ' ORDER BY vigencia DESC, p.titulo';
                        }
                    }

                    $result = mysqli_query($con,$query);
                    if (mysqli_num_rows($result) > 0)                           
                    {                                
                        echo '<div class="list-group">';                                                             
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))                               
                        {
                            $verSubasta = 'versubasta.php?id='.$row['id'];
                            echo '<a href="'.$verSubasta.'" class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <center>
                                                <img alt="" class="img-responsive sizeimage140" src="uploads/'.$row['imagen'].'">
                                            </center>
                                        </div>
                                        <div class="col-sm-10">
                                            <h2 class="list-group-item-heading">'.utf8_encode($row['titulo']).'</h2>
                                            
                                            <p class="list-group-item-text lead">'.utf8_encode($row['descripcion']).'</p>    
                                            <p class="text-success">Activo hasta: <em>'.date("d-m-Y", strtotime($row['vigencia'])).'</em></p>
                                            <p class="text-info">'.utf8_encode($row['catName']).'</p>

                                        </div>
                                    </div>
                                </a>';
                        }
                        echo "</div>";
                    }
                    else
                    {
                        echo "<h3>No hay resultados para mostrar.</h3>";
                    }
                    mysqli_free_result($result);
                ?>
            </div>
            <div class="col-lg-12">
                <center>
                    <a href="index.php" class="btn btn-primary">Volver</a>
                </center>
            </div>
        </div>
    </div>
    <br>
</body>
</html>