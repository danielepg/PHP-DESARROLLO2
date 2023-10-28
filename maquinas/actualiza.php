<?php 
session_start();

include("../db.php");

$COD_MAQUINA = $conn->real_escape_string($_POST['COD_MAQUINA']);
$tipo = $conn->real_escape_string($_POST['tipo']); 
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$precio_hora = $conn->real_escape_string($_POST['precio_hora']);

$sql = "UPDATE maquinas 
        SET ID_TIPO_MAQUINA = '$tipo', 
            DESCRIPCION = '$descripcion', 
            PRECIO_HORA = '$precio_hora'
        WHERE COD_MAQUINA = '$COD_MAQUINA'";

if ($conn->query($sql)) {

    if ($_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $permitidos = array("image/jpg", "image/jpeg");
        $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

        if (in_array($_FILES['foto']['type'], $permitidos) && in_array($extension, ['jpg', 'jpeg'])) {
            $dir = "fotos/";
            $foto = $dir . $COD_MAQUINA . '.jpg';

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {
                $sql = "UPDATE maquinas 
                        SET foto = '$foto'
                        WHERE COD_MAQUINA = '$COD_MAQUINA'";

                if ($conn->query($sql)) {
                    
                } else {
                    echo "<script> alert('errror al actualizar la imagen');</script>";
                }
            } else {
                echo "<script> alert('error al mover la img');</script>";
            }
        } else {
            echo "<script> alert('formato no permitido');</script>";
        }
    }
} else {
    $_SESSION['msg'] = "Error al actualizar registro.";
}

header('Location: registromaquinas.php');
?>
