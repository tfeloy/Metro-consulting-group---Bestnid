<?php 
    include('conex.php');
    $con = Conectarse();    
    session_start();    
    

    switch ($_POST['tipo']) {
        case 1:
            # AGREGAR
            /* Guardo luego de pasar todas las validaciones */
            /*
            $sql = 'INSERT INTO categorias (nombre) ';
            $sql .= 'VALUES("'.$_POST['categoria'].'")';
            $result = mysqli_query($con,$sql);

            if(!$result)
            {
                $_SESSION['mensaje'] = mysqli_error();
                mysqli_free_result($result);
                mysqli_close($con);
            }
            else
            {
                $_SESSION['mensaje'] = "La categoria ".$_POST['categoria']." se creo de manera correcta";
            }
            */
            echo '<script type="text/javascript"> window.location = "listarusuarios.php"</script>';
            break;
        case 2:
            # EDITAR
            /*
            $sqlCatExiste = 'SELECT 1 FROM categorias WHERE nombre = "'.$_POST['categoria'].'" LIMIT 1';
            $resCatExiste = mysqli_query($con,$sqlCatExiste);
            if (mysqli_fetch_row($resCatExiste)) 
            {
                mysqli_free_result($resCatExiste);
                mysqli_close($con);
                $_SESSION['mensaje'] = 'La Categoria '.$_POST['categoria'].' ya esta en uso, por favor use otro';
                echo '<script type="text/javascript"> window.location = "listarcategorias.php"</script>';
                die(); 
            }

            $sql2 = 'UPDATE categorias SET nombre = "'.$_POST['categoria'].'" WHERE id = '.$_POST['id_categoria'];            
            $result2 = mysqli_query($con,$sql2);

            if(!$result2)
            {
                $_SESSION['mensaje'] = mysqli_error();
            }
            else
            {
                $_SESSION['mensaje'] = "La categoria ".$_POST['categoria']." se modifico de manera correcta";
            }
            mysqli_free_result($result2);
            mysqli_close($con);
            */
            echo '<script type="text/javascript"> window.location = "listarusuarios.php"</script>';
            break;
        case 3:
            # BORRAR

            $sql = 'DELETE FROM users WHERE id = '.$_POST['id_usuario'];
            $result = mysqli_query($con,$sql);

            if(!$result)
            {
                $_SESSION['mensaje'] = mysqli_error();
                mysqli_free_result($result);
                mysqli_close($con);
            }
            else
            {
                $_SESSION['mensaje'] = "El Usuario se borro de manera correcta";
            }
            echo '<script type="text/javascript"> window.location = "listarusuarios.php"</script>';
            break;
    }
    
?>