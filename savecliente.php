<?php

include('db.php');

if(isset($_POST['ingresar']))
{
    $id = $_POST['ID'];
    $codigo = $_POST['CODIGO'];
    $nombre = $_POST['NOMBRE'];
    $apellido = $_POST['APELLIDO'];
    $direccion = $_POST['DIRECCION'];
    $telefono = $_POST['TELEFONO'];
    $dpi = $_POST['DPI'];
    $nit = $_POST['NIT'];

    $query = "INSERT INTO cliente(ID_CLIENTE, COD_CLIENTE, NOMBRE, APELLIDO, DIRECCION, TELEFONO, DPI, NIT) 
    VALUES ('$id', '$codigo', '$nombre', '$apellido', '$direccion', '$telefono', '$dpi', '$nit')";

    $resultado = mysqli_query($conn, $query);

    if(!$resultado) 
    {
        die("INSERSION FALLIDA");
    }


    header("Location: listaclientes.php");

}

?>