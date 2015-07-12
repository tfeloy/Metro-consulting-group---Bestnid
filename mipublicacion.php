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
				<div class="row">
					<div class="col-lg-4">
		            	<div class="panel panel-primary">
							<div class="panel-heading">
						    	<h3 class="panel-title"><i class="fa fa-tag"></i>Mi Publicacion</h3>
						  	</div>
						  	<div class="panel-body">
						  		<div class="list-group">
						  			<?php
						  			$query = 'SELECT id, titulo, fecha_publicacion, fecha_fin FROM productos WHERE id="'.$_GET['id'].'" AND activo=1 AND id_vendedor="'.$_SESSION['user'][0].'"';

						  			$result = mysqli_query($con,$query);
						  			if (mysqli_num_rows($result) > 0)                           
                    				{
                    					if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))                               
                        				{
                        					$idProducto = $row['id'];
                        					$verSubasta = 'versubasta.php?id='.$row['id'];

                        					echo  '<a href="'.$verSubasta.'" class="list-group-item">
                        							<div class="row">
	                                        			<div class="col-sm-12">
                                						<h4 class="list-group-item-heading">'.utf8_encode($row['titulo']).'</h4>
                                						<p class="text-success">Fecha Inicio: <em>'.date("d-m-Y", strtotime($row['fecha_publicacion'])).'</em><p>
                                						<p class="text-success">Fecha Fin: <em>'.date("d-m-Y", strtotime($row['fecha_fin'])).'</em><p>
										  			</div>
										  		  </div>
										  		 </a>';
                        				}
                        			}
                        			else
                        			{
                        				echo "No existe la publicación!";
                        			}
                        			mysqli_free_result($result);
                        			?>
                        			
						    	</div>
						  	</div>
						</div>
		            </div>
		            <div class="col-lg-4">
		            	<div class="panel panel-primary">
							<div class="panel-heading">
						    	<h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Ofertas de la Publicacion</h3>
						  	</div>
						  	<div class="panel-body">
						  		<div class="list-group">
						  			<?php
						  				$query = 'SELECT necesidad_ofertada, fecha_oferta FROM ofertas_realizadas WHERE id_producto="'.$idProducto.'" AND activo=1';
						  				$result = mysqli_query($con,$query);
							  			if (mysqli_num_rows($result) > 0)                           
	                    				{
	                    					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))                               
	                        				{
	                        					echo '<div class="row">
                    									<div class="col-sm-10 col-lg-offset-1 list-group-item">
	                                            			<h4 class="list-group-item-heading text-center">Descripción</h4>
	                                            			<p class="text-info text-center"><em>'.utf8_encode($row['necesidad_ofertada']).'</em></p>
	                                            			<p class="text-success">Fecha: <em>'.date("d-m-Y", strtotime($row['fecha_oferta'])).'</em></p>
														</div>
													  </div>';
	                        				}
	                        			}
	                        			else
	                        			{
	                        				echo "La publicacion no tiene ofertas!";
	                        			}
	                        			mysqli_free_result($result);
						  			?>
						    	</div>
						  	</div>
						</div>
		            </div>
		            <div class="col-lg-4">
		            	<div class="panel panel-primary">
							<div class="panel-heading">
						    	<h3 class="panel-title"><i class="fa fa-comments"></i> Preguntas de la Publicación</h3>
						  	</div>
						  	<div class="panel-body">
						  		<div class="list-group">
						  			<?php
						  				$query = 'SELECT id, pregunta, respuesta, fecha_pregunta AS fecha_pregunta, fecha_respuesta AS fecha_respuesta, id_vendedor FROM consultas WHERE id_producto="'.$idProducto.'"';
							  			$result = mysqli_query($con,$query);
							  			if (mysqli_num_rows($result) > 0)                           
	                    				{
	                    					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))                               
	                        				{
	                        					echo '<div class="row">
		                                        			<div class="col-sm-10 col-lg-offset-1 list-group-item">
		                                            			<i class="fa fa-comments"></i> <strong>'.utf8_encode($row['pregunta']).'</strong>
		                                            			<p class="text-success">Fecha: <em>'.date("d-m-Y", strtotime($row['fecha_pregunta'])).'</em></p>
															</div>';
														if ($row['id_vendedor'] != 0) 
														{
															echo '<div class="col-sm-8 col-lg-offset-1">
																	<blockquote>
			 				 											<p>'.utf8_encode($row['respuesta']).'</p>
			 				 											<p class="text-success">Fecha: <em>'.date("d-m-Y", strtotime($row['fecha_respuesta'])).'</em></p>
																	</blockquote>
																  </div>';
														}
														else
														{
															?>
																<form action="savedrespuesta.php" class="form-horizontal" method="post" id="responderConsulta-form">
																	<div class="form-group">	
																		<div class="col-lg-10 col-lg-offset-1">
			                                                        		<input type="text" id="respuesta" name="respuesta" placeholder="Responda la consulta" class="respuesta form-control">
			                                                    		</div>
				                                                	</div>
										                            <input type="hidden" name="id_producto" value="<?php echo $idProducto; ?>">
		                                                			<input type="hidden" name="id_consulta" value="<?php echo $row['id']; ?>">
		                                                			<input type="hidden" name="id_vendedor" value="<?php echo $_SESSION['user'][0]; ?>">
				                                                	<div class="form-group">	
				                                                		<div class="col-lg-10 col-lg-offset-1">
					                                                        <input type="submit" class="btn btn-primary btn-block btn-xs" value="Responder"/> 
					                                                    </div>
				                                                	</div>
				                                                </form>
				                                        <?php
														}
														echo "</div>";
	                        				}
	                    				}
	                    				else
	                    				{
	                    					echo "NO HAY PREGUNTAS";
	                    				}
                    				mysqli_free_result($result);
						  			?>
						    	</div>
						  	</div>
						</div>
		            </div>
		        </div>
    </div>
</body>
</html>