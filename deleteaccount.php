<?php 
    include('conex.php');
    $con = Conectarse();    
    session_start();    
    
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
        unset($_SESSION['user']);
        $_SESSION['mensaje'] = "El Usuario se borro de manera correcta";
    }
    echo '<script type="text/javascript"> window.location = "success.php"</script>';
    break;
    
?>