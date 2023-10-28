<?php
session_start();
if(isset($_SESSION['CODIGO_USUARIO'])){
include('db.php');

if(isset($_POST['ingresar']))
{
    $id_usuario = $_POST['ID_USUARIO'];
    $codigo_usuario = $_POST['CODIGO_USUARIO'];
    $correo = $_POST['CORREO'];
    $contraseña = $_POST['CONTRASEÑA'];
    $estado = $_POST['ESTADO'];
    $fecha_actual = getdate();
    $rol = $_POST['ID_ROL'];
    
    $fecha_formato_mysql = $fecha_actual['year'] . '-' . $fecha_actual['mon'] . '-' . $fecha_actual['mday'];

    $query = "INSERT INTO USUARIO(ID_USUARIO, CODIGO_USUARIO, CORREO, CONTRASEÑA, ESTADO, FECHA, ID_ROL) 
    VALUES ('$id_usuario', '$codigo_usuario', '$correo', '$contraseña', '$estado' , '$fecha_formato_mysql', '$rol')";

    $resultado = mysqli_query($conn, $query);

    if(!$resultado) 
    {
        die("INSERSION FALLIDA");
    }

    header("Location: listausuario.php");

}

?>

<?php include("includes/header.php")?>
<?php
if($_SESSION['ID_ROL'] != 3 && $_SESSION['ID_ROL'] != 2) { ?>

<!DOCTYPE html>
<html>

<head>
    <title>Menú con Bootstrap</title>
    <!-- Incluye los enlaces a los archivos CSS y JS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<style>
.center-div {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
    margin-left: 80px;
    margin-right: 80px;
}
</style>

<div class="center-div">
    <div class="col-md-6 mx-auto">
        <div class="card card-body">
            <form action="ingresousuario.php" method="POST">
                
                <div class="form-group">
                    <input type="text" name="CODIGO_USUARIO" class="form-control" placeholder="CODIGO" autofocus>
                </div>
                <div class="form-group">
                    <input type="text" name="CORREO" class="form-control" placeholder="CORREO">
                </div>
                <div class="form-group">
                    <input type="text" name="CONTRASEÑA" class="form-control" placeholder="CONTRASEÑA">
                </div>
                <select class="form-select" name="ID_ROL">
                    <option value="0" >SELECCIONE UN ROL</option>
                    <option value="1" >ADMINISTRADOR</option>
                    <option value="2" >ENCARGADO</option>
                    <option value="3" >EMPLEADO</option>
                </select>
                </br>
                <select class="form-select" name="ESTADO">
                    <option value="0" >SELECCIONE UN ESTADO</option>
                    <option value="A" >ACTIVO</option>
                    <option value="I" >INACTIVO</option>
                </select>
                </br>
                <input type="submit" class="btn btn-success btn-block" name="ingresar" value="INGRESAR">
            </form>
        </div>
    </div>
</div>

<?php } else { echo "<script> alert('fokiu'); window.location='menu.php' </script>";} ?>

<?php } else { echo "<script> window.location='dashboard.php' </script>";} ?>