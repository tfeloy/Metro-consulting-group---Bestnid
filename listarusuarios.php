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
		<?php 
			// Si es 1 es ADMIN sino si es 0 USER NORMAL
			if($_SESSION['user'][9] == 1)
			{
				?>
				<div class="row">
					<div class="col-md-12">
						<?php
				            if (!empty($_SESSION['mensaje']))
				            {
								echo'<div class="alert alert-dismissible alert-success">
  									<button type="button" class="close" data-dismiss="alert">×</button>
  									<center>
				                        <strong>'.$_SESSION['mensaje'].'</strong>
				                    </center>
								</div>';
				                unset($_SESSION['mensaje']); //Elimino la variable de session luego de imprimirla
				            }
				        ?>
					</div>
		            <div class="col-md-12">
			            <h3>Usuarios</h3>
			            <a href="myaccount.php" class="btn btn-lg btn-primary" title="Volver a mi cuenta"><i class="fa fa-arrow-left"> Volver</i></a>

		                <?php
		                    $query = 'SELECT id, nombre, apellido, username, es_admin FROM users';
		                    $result = mysqli_query($con,$query);

		                    if (mysqli_num_rows($result) > 0)                           
		                    {                               
		                        echo '<table class="table table-striped table-hover">
								  <thead>
								    <tr>
								      <th>Usuario</th>
								      <th>Es Admin</th>
								      <th>Productos que tiene a la venta</th>
								      <th>Acciones</th>
								    </tr>
								  </thead>
								  <tbody>';  

		                        while ($row_cat = mysqli_fetch_array($result, MYSQLI_ASSOC))                               
		                        {
		                            $query2 = 'SELECT id_vendedor, COUNT(id) AS Cantidad FROM productos WHERE id_vendedor = '.$row_cat['id'].' GROUP BY id_vendedor';
		                    		$result2 = mysqli_query($con,$query2);
									$myrow = mysqli_fetch_array($result2, MYSQLI_ASSOC);

		                            echo '<tr>
								      <td>'.utf8_encode($row_cat['apellido']).", ".utf8_encode($row_cat['nombre'])." (".utf8_encode($row_cat['username']).")".'</td>';
								      if ($row_cat['es_admin'] == 1) {
								      	echo '<th>Si</th>';
								      } else {
								      	echo '<th>No</th>';
								      }
								    if ($myrow['Cantidad'] == 0) {
								    	echo '<td> 0 </td>';
								    	echo '<td>
                                    	<a class="btn btn-link" title="Eliminar Usuario" data-toggle="modal" data-target="#myModal'.$row_cat['id'].'"><i class="fa fa-trash-o text-danger"></i></a></td>';
                                    	echo '
									    <!-- MODAL PARA LA CONFIRMACION DE ELIMINAR EL USUARIO -->
		                                <div class="modal fade" id="myModal'.$row_cat['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		                                	<div class="modal-dialog">
	    										<div class="modal-content">
	      											<div class="modal-header">
	        											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        											<h4 class="modal-title">Eiminar el Usuario</h4>
	      											</div>
	      											<div class="modal-body">
	        											<form action="saveduser.php" method="post"> 
			                                        		<center>
				                                            	<p class="lead">¿Está seguro que desea eliminar el producto: <strong>"'.utf8_encode($row_cat['username']).'"</strong>?</p>
								                        		<input type="hidden" name="id_usuario" value="'.$row_cat['id'].'">
								                        		<input type="hidden" name="tipo" value="3">
				                                        		<button type="button" class="btn btn-info" data-dismiss="modal">No</button>
			                                            		<input type="submit" class="btn btn-primary" value="Eliminar" /> 
				                                        	</center>
				                                		</form>
	      											</div>
	    										</div>
	  										</div>
		                                </div>';

								    } else {
								    	echo '<td>'.$myrow['Cantidad'].'</td>';
								    	echo '<td><a class="btn btn-link"><i class="fa fa-minus text-danger"></i></a></td>';
								    }
		                    		mysqli_free_result($result2);
								    echo '</tr>';
		                        }
		                        echo "</tbody></table>";
		                    }
		                    mysqli_free_result($result);
		                ?>
		            </div>
		        </div>
				<?php
			}
			else
			{
				echo '<script type="text/javascript"> window.location = "login.php"</script>';
			}
		?>
    </div>
</body>
</html>