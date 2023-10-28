<?php 
include("../db.php");
$COD_MAQUINA = $conn->real_escape_string($_POST['COD_MAQUINA']);



$sql = "SELECT COD_MAQUINA, ID_TIPO_MAQUINA, descripcion, precio_hora FROM maquinas WHERE COD_MAQUINA = '$COD_MAQUINA' ";
$resultado = $conn->query($sql);
$rows = $resultado->num_rows;

$maquina = [];

if($rows > 0){
    $maquina = $resultado->fetch_array(); 
    
}

echo json_encode($maquina, JSON_UNESCAPED_UNICODE);

