<?php

    include ("db.php");

    if(isset($_GET['ID']))
    {
        $ID = $_GET['ID'];
        $query = "DELETE FROM cliente WHERE ID_CLIENTE = $ID";
        $resultado = mysqli_query($conn, $query);
        if (!$resultado)
        {
            die("Query Failed");
        }

        $_SESSION['message'] = 'Cliente eliminado correctamente';
        $_SESSION['message_type'] = 'danger';

        header("Location: listaclientes.php");
    }

?>