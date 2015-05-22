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
            <a class="navbar-brand" href="home.php">Bestnid</a>
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
		            	
		            </div>
		            <div class="col-lg-4">
		            
		            </div>
		            <div class="col-lg-4">
		            
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
						    	<h3 class="panel-title"><i class="fa fa-comments"></i> Preguntas</h3>
						  	</div>
						  	<div class="panel-body">
						    	NO TIENE PREGUNTAS
						  	</div>
						</div>
		            </div>
		            <div class="col-lg-4">
		            	<div class="panel panel-primary">
							<div class="panel-heading">
						    	<h3 class="panel-title"><i class="fa fa-tag"></i> Publicaciones</h3>
						  	</div>
						  	<div class="panel-body">
						    	NO TIENE PUBLICACIONES
						  	</div>
						</div>
		            </div>
		            <div class="col-lg-4">
		            	<div class="panel panel-primary">
							<div class="panel-heading">
						    	<h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Operaciones</h3>
						  	</div>
						  	<div class="panel-body">
						    	NO TIENE OPERACIONES REALIZADAS
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