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
        <div class="jumbotron col-lg-10 col-lg-offset-1">
            <form action="verEstadisticas.php" class="form-horizontal form-inline" method="post" id="editPerfil-form">
                <legend>Elegir Fechas</legend>    
                <div class="form-group col-lg-5">
                    <label for="fechaDesde" class="control-label">Fecha Desde</label>
                    <input class="form-control" type="date" name="fechaDesde" placeholder="Fecha Desde..." value="<?php if(isset($_POST['fechaDesde'])){ echo $_POST['fechaDesde'];} ?>">
                </div>
                <div class="form-group col-lg-5 col-lg-offset-6">
                    <label for="fechaHasta" class="control-label">Fecha Desde</label>
                    <input class="form-control" type="date" name="fechaHasta" placeholder="Fecha Hasta..." value="<?php if(isset($_POST['fechaHasta'])){ echo $_POST['fechaHasta'];} ?>">
                </div>
                <div class="form-group col-lg-2 col-lg-offset-8">
                    <input type="submit" class="btn btn-success" value="Ver Estadisticas" /> 
                </div>
            </form>

        </div>
        <?php
        //USUARIOS REGISTRADOS
        /*
            $sql = 'SELECT COUNT(*) AS totUsers FROM users WHERE fecha_registro >= "1910-01-01" AND fecha_registro <= curdate()';
            $result = mysqli_query($con,$sql);
            if (mysqli_num_rows($result) > 0)                           
            {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $UserTotal = $row['totUsers'];
                mysqli_free_result($result);
            }
        //PUBLICACIONES ACTIVAS
            $sql = 'SELECT COUNT(*) AS totPublicaciones FROM productos WHERE fecha_publicacion >= "1910-01-01"';
            $result = mysqli_query($con,$sql);
            if (mysqli_num_rows($result) > 0)                           
            {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $PublicacionesActivas = $row['totPublicaciones'];
                mysqli_free_result($result);
            }
        //PUBLICACIONES VENDIDAS
            $sql = 'SELECT COUNT(*) AS totPublicaciones FROM productos WHERE fecha_publicacion >= "1910-01-01" AND fecha_fin <= curdate() AND vendido = 1';
            $result = mysqli_query($con,$sql);
            if (mysqli_num_rows($result) > 0)                           
            {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $PublicacionesVendidas = $row['totPublicaciones'];
                mysqli_free_result($result);
            }
        */
        //---------------------------------

             if (isset($_POST['fechaDesde']))
            {
                if ($_POST['fechaDesde'] != '') {
                    $initDate = $_POST['fechaDesde'];    
                }
                else
                {
                    $initDate = '1910-01-01';
                }                
            }
            else
            {
                $initDate = '1910-01-01';
            }
            if(isset($_POST['fechaHasta']))
            {
                if ($_POST['fechaHasta'] != '') {
                    $endDate = '"'.$_POST['fechaHasta'].'"';
                }
                else
                {
                    $endDate = '2030-02-02';
                }
            }
            else
            {
                $endDate = '2030-02-02';
            }
            
        
                //USUARIOS REGISTRADOS
                $sql = 'SELECT COUNT(*) AS cantUsers FROM users WHERE fecha_registro >="'.$initDate.'" AND fecha_registro <='.$endDate;
                $result = mysqli_query($con,$sql);

                if ($endDate == '2030-02-02') {
                    $endDate = (string)(date('d').'-'.date('m').'-'.date('Y'));
                }
                else
                {
                    $endDate = str_replace('"','',$endDate);
                }
            ?>
                         
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart"></i> Estadísticas <?php echo ' (Del '.$initDate.' al '.$endDate.')'; ?></h3>
                            </div>
                            <div class="panel-body">   

                            <?php    

                                if (mysqli_num_rows($result) > 0)                           
                                {
                                    $rowUsers = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                   
                                    

                                    echo '<legend>Cantidad de Usuarios Registrados</legend>
                                          <div class="col-sm-10 col-sm-offset-1">
                                            <p><i style="color:#d9230f" class="fa fa-square "></i> Cantidad de Usuarios Registrados: '.$rowUsers['cantUsers'].'</p>
                                            </br></br>
                                          </div>';
                            
                                }
                                /*
                                else
                                {
                                    echo '<legend>Cantidad de Usuarios Registrados </legend>
                                          <div class="col-sm-10 col-sm-offset-1">
                                            <p><i style="color:#469408" class="fa fa-square "></i> Cantidad Total de Usuarios Registrados: '.$UserTotal.'</p>
                                            </br></br>
                                          </div>';
                                }
                                */
                                mysqli_free_result($result);

                                //PUBLICACIONES ACTIVAS
                                $sql = 'SELECT COUNT(*) AS totPublicaciones FROM productos WHERE fecha_publicacion >="'.$initDate.'"';
                                $result = mysqli_query($con,$sql);
                                 if (mysqli_num_rows($result) > 0)                           
                                {
                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    echo '<legend>Cantidad de Publicaciones Realizadas</legend>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <p><i style="color:#d9230f" class="fa fa-square "></i> Cantidad de Publicaciones Realizadas: '.$row['totPublicaciones'].'</p>
                                            </br></br>
                                          </div>';
                            
                                }
                                /*
                                else
                                {
                                    echo '<legend>Cantidad de Publicaciones Realizadas </legend>
                                          <div class="col-sm-10 col-sm-offset-1">
                                            <p><i style="color:#469408" class="fa fa-square "></i> Cantidad Total de Publicaciones Realizadas: '.$PublicacionesActivas.'</p>
                                            </br></br>
                                          </div>';
                                }
                                */
                                mysqli_free_result($result);

                                //PUBLICACIONES VENDIDAS
                                 $sql = 'SELECT COUNT(*) AS totPub FROM productos WHERE fecha_publicacion >="'.$initDate.'" AND fecha_fin <="'.$endDate.'" AND vendido = 1';
                                 $result = mysqli_query($con,$sql);
                                 if (mysqli_num_rows($result) > 0)                           
                                {
                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                                    echo '<legend>Cantidad de Productos Vendidos</legend>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <p><i style="color:#d9230f" class="fa fa-square "></i> Cantidad de Productos Vendidos: '.$row['totPub'].'</p>
                                            </br></br>
                                          </div>';
                                }
                                /*
                                else
                                {
                                    echo '<legend>Cantidad de Publicaciones Activas </legend>
                                          <div class="col-sm-10 col-sm-offset-1">
                                            <p><i style="color:#469408" class="fa fa-square "></i> Cantidad Total Productos Vendidos: '.$PublicacionesVendidas.'</p>
                                            </br></br>
                                          </div>';
                                }
                                */
                                mysqli_free_result($result);

                            ?>
                           
                        
                        </div>
                    </div>
                </div>
            </div>
         </div>
         <?php
            
        
        ?>
    </div>
</body>
</html>