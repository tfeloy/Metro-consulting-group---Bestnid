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
			            <h3>Categorías</h3>
			            <a href="myaccount.php" class="btn btn-lg btn-primary" title="Volver a mi cuenta"><i class="fa fa-arrow-left"> Volver</i></a>
			            <a class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModalCat" title="Agregar Categoría"><i class="fa fa-plus"> Agregar Categoría</i></a>

						<div class="modal fade" id="myModalCat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-body">
                                <form action="savedcategoria.php" class="form-horizontal" method="post" id="categoria-form"> 
                                    <div class="form-group">
                                        <div class="col-lg-12">
					                        <input class="form-control" type="text" name="categoria" placeholder="Categoria">
					                        <input type="hidden" name="tipo" value="1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                        	<center>
				                            	<button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                                            	<input type="submit" class="btn btn-primary" value="Guardar" /> 
                                            </center>
                                        </div>
                                    </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

		                <?php
		                    $query = 'SELECT c.id, c.nombre, COUNT(p.id) AS Cant FROM categorias AS c LEFT JOIN productos AS p ON c.id = p.id_categoria GROUP BY c.id ORDER BY c.nombre ASC';
		                    $result = mysqli_query($con,$query);
		                    if (mysqli_num_rows($result) > 0)                           
		                    {                               
		                        echo '<table class="table table-striped table-hover">
								  <thead>
								    <tr>
								      <th>Categoria</th>
								      <th>Productos dentro de la categoria</th>
								      <th>Acciones</th>
								    </tr>
								  </thead>
								  <tbody>';  

		                        while ($row_cat = mysqli_fetch_array($result, MYSQLI_ASSOC))                               
		                        {
		                            echo '<tr>
								      <td>'.utf8_encode($row_cat['nombre']).'</td>
								      <td>'.$row_cat['Cant'].'</td>
								      <td>';

								      if ($row_cat['Cant'] == 0) {
								      	echo '
                                    	<a class="btn btn-link" title="Eliminar Categoría" data-toggle="modal" data-target="#myModal'.$row_cat['id'].'"><i class="fa fa-trash-o text-danger"></i></a>';
                                    	echo '
									    <!-- MODAL PARA LA CONFIRMACION DE ELIMINAR LA CATEGORIA -->
		                                <div class="modal fade" id="myModal'.$row_cat['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		                                	<div class="modal-dialog">
	    										<div class="modal-content">
	      											<div class="modal-header">
	        											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        											<h4 class="modal-title">Eiminar la Categoría</h4>
	      											</div>
	      											<div class="modal-body">
	        											<form action="savedcategoria.php" method="post"> 
			                                        		<center>
				                                            	<p class="lead">¿Está seguro que desea eliminar la categoría: <strong>"'.utf8_encode($row_cat['nombre']).'"</strong>?</p>
								                        		<input type="hidden" name="categoria" value="'.$row_cat['id'].'">
								                        		<input type="hidden" name="tipo" value="3">
				                                        		<button type="button" class="btn btn-info" data-dismiss="modal">No</button>
			                                            		<input type="submit" class="btn btn-primary" value="Eliminar" /> 
				                                        	</center>
				                                		</form>
	      											</div>
	    										</div>
	  										</div>
		                                </div>';
								      }
								      echo '<a class="btn btn-link" title="Editar Categoría" data-toggle="modal" data-target="#myModalEdit'.$row_cat['id'].'"><i class="fa fa-edit text-danger"></i></a>';
								      echo '
									    <!-- MODAL PARA LA MODIFICAR LA CATEGORIA -->
		                                <div class="modal fade" id="myModalEdit'.$row_cat['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		                                	<div class="modal-dialog">
	    										<div class="modal-content">
	      											<div class="modal-header">
	        											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	        											<h4 class="modal-title">Modificar Categoría</h4>
	      											</div>
	      											<div class="modal-body">
	        											<form action="savedcategoria.php" method="post" id="modcategoria-form"> 
			                                        		<center>
			                                        			<div class="form-group">
								                        			<input type="text" class="form-control" name="categoria" value="'.utf8_encode($row_cat['nombre']).'" required>
								                        			<input type="hidden" name="id_categoria" value="'.$row_cat['id'].'">
								                        			<input type="hidden" name="tipo" value="2">
								                        		</div>
								                        		<div class="form-group">
				                                        			<button type="button" class="btn btn-info" data-dismiss="modal">No</button>
			                                            			<input type="submit" class="btn btn-primary" value="Modificar" /> 
			                                            		</div>
				                                        	</center>
				                                		</form>
	      											</div>
	    										</div>
	  										</div>
		                                </div>';
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