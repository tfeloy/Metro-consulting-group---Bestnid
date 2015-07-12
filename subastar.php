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
        <div class="jumbotron">
            <form action="savedsubastar.php" class="form-horizontal" method="post" id="subastar-form" enctype="multipart/form-data"> 
                <legend>Subastar Producto</legend>
                <div class="form-group">
                    <label for="inputTitulo" class="col-lg-2 control-label">Titulo</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="text" name="titulo" placeholder="Increible cuadro">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCategoria" class="col-lg-2 control-label">Categoria</label>
                    <div class="col-lg-10">
                        <select name="categoria" class="categoria form-control" id="categoria">
                            <option value="">Seleccione una Categoria</option>
                            <?php
                                $query = 'SELECT id, nombre FROM categorias';
                                $result = mysqli_query($con,$query);
                                if (mysqli_num_rows($result) > 0)                           
                                {                               
                                    echo '<div class="list-group">';                                                             
                                    while ($row_cat = mysqli_fetch_array($result, MYSQLI_ASSOC))                               
                                    {
                                        echo '<option value="'.$row_cat['id'].'">'.utf8_encode($row_cat['nombre']).'</option>';
                                    }
                                    echo "</div>";
                                }
                                mysqli_free_result($result);
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDescripcion" class="col-lg-2 control-label">Descripción</label>
                    <div class="col-lg-10">
                        <textarea name="descripcion" placeholder="Descripción" class="descripcion form-control" id='descripcion' rows="4"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputImagen" class="col-lg-2 control-label">Imagen</label>
                    <div class="col-lg-10">
                        <input name="archivo1" type="file" id="archivo1" class="archivo1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputFecha" class="col-lg-2 control-label">Días que durará la publicación</label>
                    <div class="col-lg-10">
                        <select name="dias" class="dias form-control" id="dias">
                            <option value="">Días</option>
                            <option value="15">15 días</option>
                            <option value="16">16 días</option>
                            <option value="17">17 días</option>
                            <option value="18">18 días</option>
                            <option value="19">19 días</option>
                            <option value="20">20 días</option>
                            <option value="21">21 días</option>
                            <option value="22">22 días</option>
                            <option value="23">23 días</option>
                            <option value="24">24 días</option>
                            <option value="25">25 días</option>
                            <option value="26">26 días</option>
                            <option value="27">27 días</option>
                            <option value="28">28 días</option>
                            <option value="29">29 días</option>
                            <option value="30">30 días</option>
                        </select>
                    </div>
                </div>

                <?php
                    if (!empty($_SESSION['sub']))
                    {
                        echo'
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <div class="alert alert-dismissible alert-danger">
                                    <strong>'.$_SESSION['sub'].'</strong>
                                </div>
                            </div>
                        </div>
                        ';
                        unset($_SESSION['sub']); //Elimino la variable de session luego de imprimirla
                    }
                ?>

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <input type="submit" class="btn btn-success" value="Vender" /> 
                    </div>
                </div>
            </form>
        </div>        
    </div>
</body>
</html>