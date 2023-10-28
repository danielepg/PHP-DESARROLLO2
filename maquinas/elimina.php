<?php 
include("../db.php");

$COD_MAQUINA = $conn->real_escape_string($_POST['COD_MAQUINA']);


$sql = "DELETE FROM maquinas WHERE COD_MAQUINA = '$COD_MAQUINA' ";

        
$dir = "fotos";
$foto = $dir . '/' . $COD_MAQUINA . '.jpg';
    if($conn->query($sql)){
        if(file_exists($foto)){
            unlink($foto);
        }
        $_SESSION['msg'] = "Registro eliminado";
    }else{
        $_SESSION['msg'] = "Error al eliminar registro";
    }

header('Location: registromaquinas.php');

