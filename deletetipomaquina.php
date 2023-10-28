<?php

    include ("db.php");

    if(isset($_GET['ID']))
    {
        $ID = $_GET['ID'];
        $query = "DELETE FROM tipo_maquina WHERE ID_TIPO_MAQUINA = $ID";
        $resultado = mysqli_query($conn, $query);
        if (!$resultado)
        {
            die("Query Failed");
        }

        header("Location: listatipomaquina.php");
    }

?>