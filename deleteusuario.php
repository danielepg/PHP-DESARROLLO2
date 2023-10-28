<?php

    include ("db.php");

    if(isset($_GET['ID']))
    {
        $ID = $_GET['ID'];
        $query = "DELETE FROM usuario WHERE ID_USUARIO = $ID";
        $resultado = mysqli_query($conn, $query);
        if (!$resultado)
        {
            die("Query Failed");
        }

        header("Location: listausuario.php");
    }

?>