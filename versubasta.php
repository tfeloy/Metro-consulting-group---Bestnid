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
        <br>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    $query = 'SELECT p.id, p.id_vendedor, p.titulo, p.descripcion, p.imagen, DATE(p.fecha_fin) AS vigencia, c.nombre AS catName FROM productos p INNER JOIN categorias c ON p.id_categoria = c.id WHERE p.activo = 1 AND fecha_fin >= curdate()';
                    if(isset($_GET['id']))
                    {
                        $query .= ' AND p.id = '.$_GET['id'];
                    }

                    $result = mysqli_query($con,$query);
                    if (mysqli_num_rows($result) > 0)                           
                    {                                
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))                               
                        {
                            $verSubasta = 'versubasta.php?id='.$row['id'];
                            echo '<div class="row">
                                <div class="col-sm-12">
                                    <center>
                                        <h1 class="list-group-item-heading">'.utf8_encode($row['titulo']).'</h1>
                                    </center>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <center>
                                        <img alt="" class="img-responsive sizeimage140" src="uploads/'.$row['imagen'].'">
                                    </center>
                                </div>
                                <div class="col-sm-10">                                            
                                    <p class="list-group-item-text lead">'.utf8_encode($row['descripcion']).'</p>    
                                    <p class="text-success">Activo hasta: <em>'.date("d-m-Y", strtotime($row['vigencia'])).'</em></p>
                                    <p class="text-info">'.utf8_encode($row['catName']).'</p>';
                                    if(empty($_SESSION['user'])) 
                                    {
                                        echo '<div class="row"><a href="registro.php" class="btn btn-lg btn-success">Regístrese para ofertar</a></div>';
                                    }
                                    else
                                    {
                                        $idvendedor = $row['id_vendedor'];
                                        if ($_SESSION['user'][0] == $idvendedor) 
                                        {
                                            echo '<div class="row"><a class="btn btn-lg btn-warning">No puede ofertar su producto</a></div>';
                                        }
                                        else
                                        {
                                            echo '<div class="row"><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ofertar">Ofertar</button></div>';
                                        }
                                    }
                                    echo '
                                </div>
                            </div>';

                            ?>

                            <!-- Modal -->
                            <div class="modal fade" id="ofertar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Ofertar</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="#" class="form-horizontal" method="post" id="register-form"> 
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <textarea name="necesidad" placeholder="Necesidad" class="necesidad form-control" id='necesidad' rows="4"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span>
                                                            <input class="form-control" type="text" name="precio" placeholder="150,30">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <button type="button" class="btn btn-primary btn-block">Ofertar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="row">
                            <?php
                            $queryPreg = 'SELECT c.id_producto, c.id_usuario, c.pregunta, c.fecha_pregunta AS fecha_pregunta, c.id_vendedor, c.respuesta, c.fecha_respuesta AS fecha_respuesta FROM consultas c ';
                            if(isset($_GET['id']))
                            {
                                $queryPreg .= ' WHERE c.id_producto = '.$_GET['id'].' ORDER BY fecha_pregunta DESC';
                            }

                            $resultPreg = mysqli_query($con,$queryPreg);
                            if (mysqli_num_rows($resultPreg) > 0)                           
                            {                                
                                echo "<h2>Preguntas</h2>";
                                while ($rowPreg = mysqli_fetch_array($resultPreg, MYSQLI_ASSOC))                               
                                {
                                    ?>
                                    <table class="table table-striped table-hover ">
                                        <tbody>
                                            <tr class="danger">
                                                <td> <?php echo $rowPreg['fecha_pregunta']; ?> | <i class="fa fa-comment"></i> <strong> <?php echo utf8_encode($rowPreg['pregunta']); ?></strong></td>
                                            </tr>

                                            <?php if ($rowPreg['id_vendedor'] != 0) { ?>
                                                <tr class="active">
                                                    <td> <?php echo $rowPreg['fecha_respuesta']; ?> | <i class="fa fa-comments"></i> <strong> <?php echo utf8_encode($rowPreg['respuesta']); ?> </strong></td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<center><h3>No hay preguntas. Se el primero.</h3></center><br>";
                            }

                            if(empty($_SESSION['user'])) 
                            {
                                echo '
                                <div class="row">
                                    <center>
                                    <a href="index.php" class="btn btn-danger btn-lg">Volver</a>
                                    <a href="registro.php" class="btn btn-lg btn-success">Regístrese para preguntar</a>
                                    </center>
                                </div>';
                            }
                            else
                            {
                                if ($_SESSION['user'][0] == $idvendedor) 
                                {
                                    echo '<div class="row"><center><a class="btn btn-lg btn-warning">No puedes preguntar por tus producto</a></center></div>';
                                }
                                else
                                {
                                    echo '
                                    <div class="row">
                                        <center>
                                        <a href="index.php" class="btn btn-danger btn-lg">Volver</a>
                                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#preguntar">Preguntar</button>
                                        </center>
                                    </div>';
                                }
                            }
                            ?>

                            <!-- Modal -->
                            <div class="modal fade" id="preguntar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Deje su pregunta</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="savedpregunta.php" class="form-horizontal" method="post" id="pregunta-form"> 
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <textarea name="pregunta" placeholder="Deje su pregunta" class="pregunta form-control" id='pregunta' rows="4"></textarea>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id_producto" value="<?php echo $_GET['id']; ?>">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <input type="submit" class="btn btn-primary btn-block" value="Preguntar" /> 
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    else
                    {
                        echo "<h3>No hay resultados para mostrar.</h3>";
                    }
                    mysqli_free_result($result);
                    mysqli_free_result($resultPreg);
                ?>
            </div>
        </div>
        <br>
    </div>
</body>
</html>