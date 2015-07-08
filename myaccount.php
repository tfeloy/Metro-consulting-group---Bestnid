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
		            <div class="col-lg-4">
						<a href="registroadmin.php" class="btn btn-primary">Agregar Usuario</a>
		            </div>
		        </div>
				<?php
			}
			else
			{
				?>
				<div class="row">
		            <div class="col-lg-4">
		            	<div class="panel panel-primary">
							<div class="panel-heading">
						    	<h3 class="panel-title"><i class="fa fa-comments"></i> Mis Preguntas Realizadas</h3>
						  	</div>
						  	<div class="panel-body">
						  		<div class="list-group">
						  		<?php

						  			$query = 'SELECT c.pregunta, c.respuesta, c.fecha_pregunta AS fecha_pregunta, c.fecha_respuesta AS fecha_respuesta, c.id_vendedor, p.titulo, p.id  FROM consultas c INNER JOIN productos p ON (c.id_producto = p.id) WHERE c.id_usuario = "'.$_SESSION['user'][0].'" AND p.activo=1 AND p.vendido=0 GROUP BY p.id, c.id';
						  			$result = mysqli_query($con,$query);
						  			if (mysqli_num_rows($result) > 0)                           
                    				{
                    					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))                               
                        				{
                        					$verSubasta = 'versubasta.php?id='.$row['id'];
                        					echo '<a href="'.$verSubasta.'" class="list-group-item">
                        							<div class="row">
	                                        			<div class="col-sm-12">
	                                            			<h4 class="list-group-item-heading">'.utf8_encode($row['titulo']).'</h4>
	                                            			<i class="fa fa-comments"></i> <strong>'.utf8_encode($row['pregunta']).'</strong>    
	                                            			<p class="text-success">Fecha: <em>'.date("d-m-Y", strtotime($row['fecha_pregunta'])).'</em></p>
														</div>';
													if ($row['id_vendedor'] != 0) 
													{
														echo '<div class="col-sm-10">
																<blockquote>
		 				 											<p>'.utf8_encode($row['respuesta']).'</p>
		 				 											<p class="text-success">Fecha: <em>'.date("d-m-Y", strtotime($row['fecha_respuesta'])).'</em></p>
																</blockquote>
															  </div>';
													}
                             				      	echo '</div></a>';
                        				}
                    				}
                    				else
                    				{
                    					echo "NO HA REALIZADO PREGUNTAS";
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
						    	<h3 class="panel-title"><i class="fa fa-tag"></i> Mis Publicaciones</h3>
						  	</div>
						  	<div class="panel-body">
						  		<div class="list-group">
						  		<?php
						  			$query = 'SELECT id, titulo, activo, vendido, precio, comision FROM productos WHERE id_vendedor="'.$_SESSION['user'][0].'" ORDER BY fecha_publicacion';
						  			$result = mysqli_query($con,$query);
						  			if (mysqli_num_rows($result) > 0)                           
                    				{
                    					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))                               
                        				{                    
                        					$verPublicacion = 'mipublicacion.php?id='.$row['id'];

                        					$queryPreg = 'SELECT COUNT(c.id) AS cant FROM productos p INNER JOIN consultas c ON p.id=c.id_producto WHERE p.id="'.$row['id'].'"';
                        					$resPreg = mysqli_query($con,$queryPreg);
                        					
                        					$rowPreg = mysqli_fetch_array($resPreg, MYSQLI_ASSOC);

											$queryOf = 'SELECT COUNT(o.id_usuario) AS cant FROM productos p INNER JOIN ofertas_realizadas o ON p.id=o.id_producto WHERE p.id="'.$row['id'].'" AND o.activo=1';
                        					$resOf = mysqli_query($con,$queryOf);
                        					
                        					$rowOf = mysqli_fetch_array($resOf, MYSQLI_ASSOC);

                        					$queryGanador = 'SELECT u.username FROM ofertas_realizadas o INNER JOIN users u ON o.id_usuario=u.id WHERE o.id_producto="'.$row['id'].'"';
                        					$resGanador = mysqli_query($con,$queryGanador);
                        					
                        					$rowGanador = mysqli_fetch_array($resGanador, MYSQLI_ASSOC);

                        					echo '<div class="row">
	                                        			<div class="col-sm-12">
	                                        				<div class="row">
	                                        					<div class="col-sm-12">';

	                                        					if($row['activo'] == 0)
	                                        					{
	                                        						echo '<div class="bg-danger">
	                                        								<h4 class="list-group-item-heading">'.utf8_encode($row['titulo']).'</h4>
				                                            			  </div>';
	                                        					}
	                                        					else
	                                        					{
	                                        						if($row['vendido'] == 1)
	                                        						{
	                                        							echo '<div class="bg-success">
	                                        									<h4 class="list-group-item-heading">'.utf8_encode($row['titulo']).'</h4>
	                                        									<p class="text-success">Precio venta: <em>$'.$row['precio'].'</em></p>
	                                        									<p class="text-success">Comision: <em>$'.(string)(((real)($row['precio'])*(real)($row['comision'])/100)).'</em></p>
	                                        									<p class="text-success">Ganador: <em>'.utf8_encode($rowGanador['username']).'</em></p>
	                                        									<p class="text-success text-right"><em>VENDIDO</em></p>
				                                            				</div>';
	                                        						}
	                                        						else
	                                        						{
	                                        							echo  '<a href="'.$verPublicacion.'" class="list-group-item">
				                                            					<h4 class="list-group-item-heading">'.utf8_encode($row['titulo']).'</h4>
				                                            					<p class="text-right"><i class="fa fa-comments"></i> '.$rowPreg['cant'].' <i class="fa fa-shopping-cart"></i> '.$rowOf['cant'].' </p>
																	  		  </a>';
	                                        						}
	                                        					}
				                                        		
																echo '</div>
																<div class="col-xs-2 col-lg-offset-10">';

																	if(($row['activo'] == 1) && ($row['vendido'] == 0))
																	{
																		$editSubasta = 'editsubasta.php?id='.$row['id'];
																		if ($rowOf['cant'] == 0) 
																		{
																			echo '<form id="delete-form" class="form-horizontal" action="deleteSub.php" method="POST">
																				<input type="hidden" id="id" name="id" value="'.$row['id'].'">
																				<button type="button" class="button-Icon" data-toggle="modal" data-target="#DeleteConfirm" title="Eliminar"><i class="fa fa-trash"></i></button>
																				<a href="'.$editSubasta.'" title="Editar Publicación"><i class="fa fa-edit"></i></a>
																			  </form>';
																		}
																		else
																		{
																			$seleccionarwinner = 'winner.php?id='.$row['id'];
																			echo '<a href="'.$seleccionarwinner.'" title="Elegir Ganador"><i class="fa fa-eye"></i></a>';
																		}
																	}


																	/*
																	if(($rowOf['cant'] == 0) && ($row['activo'] == 1) && ($row['vendido'] == 0))
																	{
    								                    					$editSubasta = 'editsubasta.php?id='.$row['id'];
																			echo '<form id="delete-form" class="form-horizontal" action="deleteSub.php" method="POST">
																				<input type="hidden" id="id" name="id" value="'.$row['id'].'">
																				<a href="javascript:void()" data-toggle="modal" data-target="DeleteConfirm"><i class="fa fa-trash"></i></a>
																				<a href="'.$editSubasta.'"><i class="fa fa-edit"></i></a>
																				
																			  </form>';
																	}
																	else
																	{
																		if(($row['activo'] == 1) && ($row['vendido'] == 0))
																		{
																			echo '<a href="'.$editSubasta.'"><i class="fa fa-edit"></i></a>';
																		}
																	}
																	*/
																		
															echo 	'</div>
												  			</div>
												  		</div>
													</div>';

											mysqli_free_result($resPreg);
											mysqli_free_result($resOf);
                        				}


                        			}
                        			else
                        			{
                        				echo "NO TIENE PUBLICACIONES";
                        			}
                        			mysqli_free_result($result);
						  		?>
						    	</div>
						  	</div>
						</div>
		            </div>

		            <!-- Modal -->
					<div class="modal fade" id="DeleteConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel">Eliminar Publicación</h4>
					      </div>
					      <div class="modal-body">
					        <p>¿Está seguro que desea eliminar esta publicación?</p>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					        <button type="button" class="btn btn-primary" OnClick="document.getElementById('delete-form').submit();"><i class="fa fa-trash"></i> Eliminar</button>
					      </div>
					    </div>
					  </div>
					</div>
					<!-- end Modal -->


		            <div class="col-lg-4">
		            	<div class="panel panel-primary">
							<div class="panel-heading">
						    	<h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Mis Ofertas Realizadas</h3>
						  	</div>
						  	<div class="panel-body">
						  		<div class="list-group">
						  		<?php

						  		$query = 'SELECT p.id, p.titulo, p.vendido, to_days(p.fecha_fin) - to_days(curdate()) as diferencia, o.es_ganador, o.fecha_oferta, o.precio_ofertado, o.necesidad_ofertada, o.activo FROM productos p INNER JOIN ofertas_realizadas o ON p.id=o.id_producto WHERE o.id_usuario="'.$_SESSION['user'][0].'" ORDER BY fecha_oferta';

						  			//$query = 'SELECT p.id, p.titulo, o.fecha_oferta, o.precio_ofertado, o.necesidad_ofertada FROM productos p INNER JOIN ofertas_realizadas o ON p.id=o.id_producto WHERE o.id_usuario="'.$_SESSION['user'][0].'" AND o.activo=1';

						  			$result = mysqli_query($con,$query);
						  			if (mysqli_num_rows($result) > 0)                           
                    				{
                    					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))                               
                        				{
                        					$verSubasta = 'versubasta.php?id='.$row['id'];
                        					if($row['es_ganador'] == 1)
                        					{
                        						 echo '<div class="row">
                        						 			<div class="col-sm-10 col-sm-offset-1">
															<div class="panel panel-success">
  																<div class="panel-heading">
    																<h3 class="panel-title">'.utf8_encode($row['titulo']).'</h3>
  																</div>
  																<div class="panel-body">
    																<p class="text-info text-center"><em>'.$row['necesidad_ofertada'].'</em></p>
			                                            			<p class="text-success">Precio ofertado: <em>$'.$row['precio_ofertado'].'</em></p>
			                                            			<p class="text-success">Fecha: <em>'.date("d-m-Y", strtotime($row['fecha_oferta'])).'</em></p>
			                                            			<p class="text-success text-right"><em>GANADO</em></p>
  																</div>
															</div>
															</div>
														  </div>';
											}
											else
											{
	                        					if(($row['vendido'] == 1) || ($row['activo'] == 0))
	                        					{
	                        						/* Si lo gano otro O esta eliminada la oferta */
	                        						echo '<div class="row">
                        						 			<div class="col-sm-10 col-sm-offset-1">
															<div class="panel panel-danger">
  																<div class="panel-heading">
    																<h3 class="panel-title">'.utf8_encode($row['titulo']).'</h3>
  																</div>
  																<div class="panel-body">
    																<p class="text-info text-center"><em>'.$row['necesidad_ofertada'].'</em></p>
			                                            			<p class="text-success">Precio ofertado: <em>$'.$row['precio_ofertado'].'</em></p>
			                                            			<p class="text-success">Fecha: <em>'.date("d-m-Y", strtotime($row['fecha_oferta'])).'</em></p>
			                                            			<p class="text-danger text-right"><em>';
			                                            			echo ($row['vendido']==1)?"FINALIZADO":"ELIMINADO";
			                                            			echo '</em></p>
  																</div>
															</div>
															</div>
														  </div>';
	                        					}
	                        					else
	                        					{
	                        						echo '<a href="'.$verSubasta.'" class="list-group-item">
	                        								<div class="row">
	                        									<div class="col-sm-12">
			                                            			<h4 class="list-group-item-heading">'.utf8_encode($row['titulo']).'</h4>
			                                            			<p class="text-info text-center"><em>'.utf8_encode($row['necesidad_ofertada']).'</em></p>
			                                            			<p class="text-success">Precio ofertado: $'.$row['precio_ofertado'].'</em></p>
			                                            			<p class="text-success">Fecha: <em>'.date("d-m-Y", strtotime($row['fecha_oferta'])).'</em></p>
			                                            			<p class="text-success text-right">Faltan: <em>'.$row['diferencia'].'</em> días.</p>
																</div>
														  	</div>
														  </a>
														  <div class="row">
															<div class="col-xs-2 col-lg-offset-10">
																<a href="'.$editOferta.'" title="Editar Monto"><i class="fa fa-edit"></i></a>
															</div>
														  </div>';
	                        					}
	                        				}
                        				}
                        			}
                        			else
                        			{
                        				echo "NO TIENE OPERACIONES REALIZADAS";		
                        			}
                        			mysqli_free_result($result);
                        		?>
						    	</div>
						  	</div>
						</div>
		            </div>
		        </div>
				<?php
			}
		?>
    </div>
</body>
</html>