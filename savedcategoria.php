<?php 
    include('conex.php');
    $con = Conectarse();    
    session_start();    
    

    switch ($_POST['tipo']) {
        case 1:
            # AGREGAR
            /* Guardo luego de pasar todas las validaciones */
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
            echo '<script type="text/javascript"> window.location = "listarcategorias.php"</script>';
            break;
        case 2:
            # EDITAR
            
            break;
        case 3:
            # BORRAR
            
            echo "Borro ".$_POST['categoria'];

            $sql = 'DELETE FROM categorias WHERE id = '.$_POST['categoria'];
            $result = mysqli_query($con,$sql);

            if(!$result)
            {
                $_SESSION['mensaje'] = mysqli_error();
                mysqli_free_result($result);
                mysqli_close($con);
            }
            else
            {
                $_SESSION['mensaje'] = "La categoria se borro de manera correcta";
            }
            echo '<script type="text/javascript"> window.location = "listarcategorias.php"</script>';
            break;
    }
    
?>