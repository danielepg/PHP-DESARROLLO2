<?php 
include("../db.php");

session_start();

$COD_MAQUINA = $conn->real_escape_string($_POST['COD_MAQUINA']);
$tipo = $conn->real_escape_string($_POST['tipo']); 
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$precio_hora = $conn->real_escape_string($_POST['precio_hora']);

// Ruta donde se guardarán las imágenes
$dir = "fotos/";

// Verificar si se subió una imagen
if($_FILES['foto']['error'] == UPLOAD_ERR_OK){
    $permitidos = array("image/jpg", "image/jpeg");
    $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

    if(in_array($_FILES['foto']['type'], $permitidos) && in_array($extension, ['jpg', 'jpeg'])) {
        // Construir el nombre del archivo
        $foto = $dir . $COD_MAQUINA . '.jpg';

        // Mover el archivo subido a la carpeta de destino
        if(move_uploaded_file($_FILES['foto']['tmp_name'], $foto)){
            // Incluir el nombre del archivo en la base de datos
            $sql = "INSERT INTO maquinas (COD_MAQUINA, id_tipo_maquina, descripcion, precio_hora, foto)
                    VALUES ('$COD_MAQUINA', '$tipo', '$descripcion', '$precio_hora', '$foto')";

            if($conn->query($sql)){
                $_SESSION['msg'] = "Registro guardado";
            } else {
                $_SESSION['msg'] = "Error al guardar en la base de datos.";
            }
        } else {
            $_SESSION['msg'] = "Error al mover el archivo.";
        }
    } else {
        $_SESSION['msg'] = "Formato de imagen no permitido. Sube una imagen JPG.";
    }
} else {
    $_SESSION['msg'] = "Debe cargar la imagen.";
}

header('Location: registromaquinas.php');
?>
