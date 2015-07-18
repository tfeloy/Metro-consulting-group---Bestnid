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
        // Si es 1 es ADMIN sino si es 0 USER NORMAL
        if($_SESSION['user'][9] == 1)
        {
        ?>
        <div class="jumbotron col-lg-10 col-lg-offset-1">
            <form action="verEstadisticas2.php" class="form-horizontal form-inline" method="post" id="estFechas-form">
                <legend>Elegir Fechas</legend>    
                <div class="form-group col-lg-5">
                    <label for="fechaDesde" class="control-label">Fecha Desde</label>
                    <input class="form-control" type="date" name="fechaDesde" placeholder="Fecha Desde..." value="<?php if(isset($_POST['fechaDesde'])){ echo $_POST['fechaDesde'];} ?>">
                </div>
                <div class="form-group col-lg-5 col-lg-offset-6">
                    <label for="fechaHasta" class="control-label">Fecha Hasta</label>
                    <input class="form-control" type="date" name="fechaHasta" placeholder="Fecha Hasta..." value="<?php if(isset($_POST['fechaHasta'])){ echo $_POST['fechaHasta'];} ?>">
                </div>
                <div class="form-group col-lg-2 col-lg-offset-8">
                    <input type="submit" class="btn btn-success" value="Ver Estadisticas" /> 
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-4">
             
            <?php
                //Usuarios registrados
                $sql = 'SELECT COUNT(*) AS cantUsers FROM users WHERE 1=1';
                if(isset($_POST['fechaDesde']))
                {
                    if($_POST['fechaDesde'] != '')
                    {
                        $sql .= ' AND fecha_registro >= "'.$_POST['fechaDesde'].'"';
                    }
                }
                 if(isset($_POST['fechaHasta']))
                {
                    if($_POST['fechaHasta'] != '')
                    {
                        $sql .= ' AND fecha_registro <= "'.$_POST['fechaHasta'].'"';
                    }
                }
                $result = mysqli_query($con,$sql);
                if (mysqli_num_rows($result) > 0)                           
                {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    echo '<div class="col-lg-12">
                            <form action="verEstadisticas2.php" method="post" class="form-horizontal" id="estUsers-form">';
                    if(isset($_POST['fechaDesde']))
                    {
                        echo '<input type="hidden" name="fechaDesde" value="'.$_POST['fechaDesde'].'">';
                    }
                    if(isset($_POST['fechaHasta']))
                    {
                        echo '<input type="hidden" name="fechaHasta" value="'.$_POST['fechaHasta'].'">';
                    }
                    echo '<input type="hidden" name="usuarios" value="1">
                        <button class="btn btn-primary col-lg-10" type="submit" name="usuarios"';
                        if($row['cantUsers'] == 0)
                        {
                            echo 'disabled="disabled"';
                        }
                        echo '>
                            Usuarios Registrados <span class="badge">'.$row['cantUsers'].'</span>
                        </button></form></div>';
                }
                mysqli_free_result($result);
                ?>
            </div>
            <div class="col-lg-4">
                <?php
                //Productos Publicados
                $sql = 'SELECT COUNT(*) AS cantPublic FROM productos WHERE 1=1';
                if(isset($_POST['fechaDesde']))
                {
                    if($_POST['fechaDesde'] != '')
                    {
                        $sql .= ' AND fecha_publicacion >= "'.$_POST['fechaDesde'].'"';
                    }
                }
                 if(isset($_POST['fechaHasta']))
                {
                    if($_POST['fechaHasta'] != '')
                    {
                        $sql .= ' AND fecha_publicacion <= "'.$_POST['fechaHasta'].'"';
                    }
                }
                $result = mysqli_query($con,$sql);
                if (mysqli_num_rows($result) > 0)                           
                {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    echo '<div class="col-lg-12">
                            <form action="verEstadisticas2.php" method="post" class="form-horizontal" id="prodPublicados-form">';
                    if(isset($_POST['fechaDesde']))
                    {
                        echo '<input type="hidden" name="fechaDesde" value="'.$_POST['fechaDesde'].'">';
                    }
                    if(isset($_POST['fechaHasta']))
                    {
                        echo '<input type="hidden" name="fechaHasta" value="'.$_POST['fechaHasta'].'">';
                    }
                    echo '<input type="hidden" name="publicados" value="1">
                        <button class="btn btn-primary col-lg-10" type="submit" name="publicados"';
                        if($row['cantPublic'] == 0)
                        {
                            echo 'disabled="disabled"';
                        }
                        echo '>
                            Productos Publicados <span class="badge">'.$row['cantPublic'].'</span>
                        </button></form></div>';
                }
                mysqli_free_result($result);
            ?>
            </div>
            <div class="col-lg-4">
                <?php
                //Productos Vendidos
                $sql = 'SELECT COUNT(*) AS cantVendidos FROM productos WHERE vendido = 1';
                if(isset($_POST['fechaDesde']))
                {
                    if($_POST['fechaDesde'] != '')
                    {
                        $sql .= ' AND fecha_fin >= "'.$_POST['fechaDesde'].'"';
                    }
                }
                 if(isset($_POST['fechaHasta']))
                {
                    if($_POST['fechaHasta'] != '')
                    {
                        $sql .= ' AND fecha_fin <= "'.$_POST['fechaHasta'].'"';
                    }
                }
                $result = mysqli_query($con,$sql);
                if (mysqli_num_rows($result) > 0)                           
                {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                     echo '<div class="col-lg-12">
                            <form action="verEstadisticas2.php" method="post" class="form-horizontal" id="prodVendidos-form">';
                    if(isset($_POST['fechaDesde']))
                    {
                        echo '<input type="hidden" name="fechaDesde" value="'.$_POST['fechaDesde'].'">';
                    }
                    if(isset($_POST['fechaHasta']))
                    {
                        echo '<input type="hidden" name="fechaHasta" value="'.$_POST['fechaHasta'].'">';
                    }
                    echo '<input type="hidden" name="vendidos" value="1">
                        <button class="btn btn-primary col-lg-10" type="submit" name="vendidos"';
                    if($row['cantVendidos'] == 0)
                    {
                        echo 'disabled="disabled"';
                    }
                    echo '>
                            Productos Vendidos <span class="badge">'.$row['cantVendidos'].'</span>
                        </button></form></div>';
                }
                mysqli_free_result($result);

                ?>
            </div>
        </div></br></br></br>
        <div class="row">
            <div class="col-md-12">
                <?php
                //Lista de usuarios
                    if (isset($_POST['usuarios']))
                    {
                        echo '<legend><i class="fa fa-bar-chart"></i> Usuarios Registrados</legend>';
                        $sql = 'SELECT nombre, apellido, username, fecha_registro FROM users WHERE 1=1';
                        if(isset($_POST['fechaDesde']))
                        {
                            if($_POST['fechaDesde'] != '')
                            {
                                $sql .= ' AND fecha_registro >= "'.$_POST['fechaDesde'].'"';
                            }
                        }
                         if(isset($_POST['fechaHasta']))
                        {
                            if($_POST['fechaHasta'] != '')
                            {
                                $sql .= ' AND fecha_registro <= "'.$_POST['fechaHasta'].'"';
                            }
                        }
                        $result = mysqli_query($con,$sql);
                        if (mysqli_num_rows($result) > 0)                           
                        {
                            echo '<table class="table table-striped table-hover">
                                  <thead>
                                    <tr>
                                      <th>Nombre</th>
                                      <th>Apellido</th>
                                      <th>User Name</th>
                                      <th>Fecha de Registro</th>
                                    </tr>
                                  </thead>
                                  <tbody>'; 
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                            {
                                echo '<tr>
                                    <td>'.utf8_encode($row['nombre']).'</td>
                                    <td>'.utf8_encode($row['apellido']).'</td>
                                    <td>'.$row['username'].'</td>
                                    <td>'.$row['fecha_registro'].'</td>
                                    </tr>';
                            }
                             echo "</tbody></table>";
                        }
                        mysqli_free_result($result);
                    }
                    else
                    {
                        if (isset($_POST['publicados']))
                        {
                            echo '<legend><i class="fa fa-bar-chart"></i> Productos Publicados</legend>';
                            $sql = 'SELECT titulo, activo FROM productos WHERE 1=1';
                            if(isset($_POST['fechaDesde']))
                            {
                                if($_POST['fechaDesde'] != '')
                                {
                                    $sql .= ' AND fecha_publicacion >= "'.$_POST['fechaDesde'].'"';
                                }
                            }
                             if(isset($_POST['fechaHasta']))
                            {
                                if($_POST['fechaHasta'] != '')
                                {
                                    $sql .= ' AND fecha_publicacion <= "'.$_POST['fechaHasta'].'"';
                                }
                            }
                            $result = mysqli_query($con,$sql);
                            if (mysqli_num_rows($result) > 0)                           
                            {
                                echo '<table class="table table-striped table-hover">
                                      <thead>
                                        <tr>
                                          <th>Producto</th>
                                          <th>Activo</th>
                                        </tr>
                                      </thead>
                                      <tbody>'; 
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                                {
                                    echo '<tr>
                                            <td>'.utf8_encode($row['titulo']).'</td>';
                                    if($row['activo'] == 1)
                                    {
                                        echo '<td><i class="fa fa-check text-success"></i></td></tr>';
                                    }else{
                                        echo '<td><i class="fa fa-times text-danger"></i></td></tr>';
                                    }

                                }
                                echo "</tbody></table>";
                            }
                            mysqli_free_result($result);
                        }
                        else
                        {
                            if (isset($_POST['vendidos']))
                            {
                                echo '<legend><i class="fa fa-bar-chart"></i> Productos Vendidos</legend>';
                                $sql = 'SELECT titulo, id_vendedor, id, fecha_publicacion, fecha_fin FROM productos WHERE vendido=1';
                                if(isset($_POST['fechaDesde']))
                                {
                                    if($_POST['fechaDesde'] != '')
                                    {
                                        $sql .= ' AND fecha_fin >= "'.$_POST['fechaDesde'].'"';
                                    }
                                }
                                 if(isset($_POST['fechaHasta']))
                                {
                                    if($_POST['fechaHasta'] != '')
                                    {
                                        $sql .= ' AND fecha_fin <= "'.$_POST['fechaHasta'].'"';
                                    }
                                }
                                $result = mysqli_query($con,$sql);
                                if (mysqli_num_rows($result) > 0)                           
                                {
                                    echo '<table class="table table-striped table-hover">
                                          <thead>
                                            <tr>
                                              <th>Producto</th>
                                              <th>Vendedor</th>
                                              <th>Comprador</th>
                                              <th>Fecha de Publicación</th>
                                              <th>Fecha de Finalización</th>
                                            </tr>
                                          </thead>
                                          <tbody>'; 
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                                    {
                                        
                                        $query = 'SELECT u.username FROM users u INNER JOIN ofertas_realizadas o ON (u.id = o.id_usuario) WHERE o.id_producto = '.$row['id'].' AND o.es_ganador = 1';
                                        $resultComprador = mysqli_query($con,$query);
                                        if (mysqli_num_rows($resultComprador) > 0)                           
                                        {
                                            $rowComprador = mysqli_fetch_array($resultComprador, MYSQLI_ASSOC);
                                            $comprador = $rowComprador['username'];
                                        }else{
                                            $comprador = '<i class="fa fa-minus text-danger"></i>';
                                        }
                                        mysqli_free_result($resultComprador);

                                        $query = 'SELECT u.username FROM users u INNER JOIN productos p ON (u.id = p.id_vendedor) WHERE p.id = '.$row['id'];
                                        $resultVendedor = mysqli_query($con,$query);
                                        if (mysqli_num_rows($resultVendedor) > 0)                           
                                        {
                                            $rowVendedor = mysqli_fetch_array($resultVendedor, MYSQLI_ASSOC);
                                            $vendedor = $rowVendedor['username'];
                                        }else{
                                            $vendedor = '<i class="fa fa-minus text-danger"></i>';
                                        }
                                        mysqli_free_result($resultVendedor);

                                        echo '<tr>
                                                <td>'.utf8_encode($row['titulo']).'</td>
                                                <td>'.$vendedor.'</td>
                                                <td>'.$comprador.'</td>
                                                <td>'.$row['fecha_publicacion'].'</td>
                                                <td>'.$row['fecha_fin'].'</td>';
                                    }
                                    echo "</tbody></table>";
                                }
                                mysqli_free_result($result);
                            }    
                        }
                    }
                ?>
            </div>
        </div>
        <?php
            }
            else
            {
                echo '<script type="text/javascript"> window.location = "index.php"</script>';
            }
        ?>
    </div>



    </div>
</body>
</html>