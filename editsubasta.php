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

            <?php
            if (!$_POST['envio'])
            {
                /* BUSCO LOS DATOS DEL REGISTRO QUE VOY A EDITAR */

                $sql = "SELECT * FROM productos WHERE id = ".$_GET['id']." and id_vendedor = ".$_SESSION['user'][0];
                $result = mysqli_query($con,$sql);

                if (mysqli_num_rows($result) > 0)                           
                {
                    $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    ?>
                        <form action="editsubasta.php" class="form-horizontal" method="post" id="editsubastar-form" enctype="multipart/form-data"> 
                            <legend>Subastar Producto</legend>
                            <div class="form-group">
                                <label for="inputTitulo" class="col-lg-2 control-label">Titulo</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="text" name="titulo" placeholder="Increible cuadro" value="<?php echo $myrow['titulo']; ?>">
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
                                                    if ($row_cat['id'] == $myrow['id_categoria']) {
                                                        echo '<option value="'.$row_cat['id'].'" selected>'.utf8_encode($row_cat['nombre']).'</option>';
                                                    } else {
                                                        echo '<option value="'.$row_cat['id'].'">'.utf8_encode($row_cat['nombre']).'</option>';
                                                    }
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
                                    <textarea name="descripcion" placeholder="Descripción" class="descripcion form-control" id='descripcion' rows="4" ><?php echo $myrow['descripcion']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputImagen" class="col-lg-2 control-label">Imagen</label>
                                <div class="col-lg-10">
                                    <input name="archivo1" type="file" id="archivo1" class="archivo1">
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
                            <input type="text" name="art_imagen" value="<?php echo $myrow['imagen']; ?>">                            
                            <input type="hidden" name="id_art" value="<?php echo $_GET['id']; ?>">

                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <input type="submit" class="btn btn-success" name="envio" value="Modificar" /> 
                                </div>
                            </div>
                        </form>
                    <?php
                }
                else
                {
                    echo '<script type="text/javascript"> window.location = "index.php"</script>';
                }
            }
            else
            {
                $contador = 0;
                if (!empty($_FILES['archivo1']['name']))
                {
                    $archivo1 = $_FILES['archivo1']['name'];
                    $prefijo1 = substr(md5(uniqid(rand())),0,7);
                    $tamano = $_FILES['archivo1']['size'];
                    if ($tamano > 2000000){
                        $contador++;
                    }
                }
                else
                {
                    $imagenvieja = 1;
                }

                if($contador > 0)
                {
                    $_SESSION['mensaje'] = 'El archivo Nro 1. supera los 2 Mb';
                    echo '<script type="text/javascript"> window.location = "success.php"</script>';
                }
                else 
                {
                    if ($imagenvieja == 1) {
                        $nameArch1 = $_POST['art_imagen'];
                    }
                    else
                    {
                        $image_types = array
                        ( 
                            // JPEG 
                            'image/jpeg'        => '.jpeg', 
                            'image/jpg'        => '.jpg', 
                            // (A)PNG (Animated) Portable Network Graphics 
                            'image/png'        => '.png',           
                        );

                        $extension1 = $_FILES['archivo1']['type'];
                        $nameArch1 = date("Y-m-d")."-P".$prefijo1."-Sub".$image_types[$extension1];     
                        $destino =  "uploads/".$nameArch1;
                        copy($_FILES['archivo1']['tmp_name'],$destino);
                    }

                    /* ARMO EL UPDATE */

                    $sqlUpdate = 'UPDATE productos SET titulo = "'.$_POST['titulo'].'", descripcion = "'.$_POST['descripcion'].'", id_categoria = "'.$_POST['categoria'].'", imagen = "'.$nameArch1.'" WHERE id = '.$_POST['id_art'];
                    $resultUpdate = mysqli_query($con,$sqlUpdate);

                    if(!$resultUpdate)
                    {
                        $_SESSION['mensaje'] = mysqli_error();
                        mysqli_free_result($resultUpdate);
                        mysqli_close($con);
                    }

                    /* Redirecciones a Success.php con un lindo mensaje :-) */
                    $_SESSION['mensaje'] = 'La publicación del producto se modifico exitosamente';
                    echo '<script type="text/javascript"> window.location = "success.php"</script>';
                }
            }

            ?>

        </div>        
    </div>
</body>
</html>