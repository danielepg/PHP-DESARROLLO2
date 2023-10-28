<?php
session_start();
if(isset($_SESSION['CODIGO_USUARIO'])){
include('db.php');

if(isset($_POST['ingresar']))
{
    $DESCRIPCION = $_POST['DESCRIPCION'];
    $ESTATUS = $_POST['ESTATUS'];
  
    $query = "INSERT INTO tipo_maquina(DESCRIPCION, ESTATUS)
    VALUES ('$DESCRIPCION', '$ESTATUS')";

    $resultado = mysqli_query($conn, $query);

    if(!$resultado) 
    {
        die("INSERSION FALLIDA");
    }

    header("Location: listatipomaquina.php");

}

?>

<?php include("includes/header.php")?>
<?php
if($_SESSION['ID_ROL'] != 3 ) { ?>

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
        <div  class="card card-body">
            <form action="ingresotipomaquina.php" method="POST">
                <div class="form-group">
                    <input type="text" name="DESCRIPCION" class="form-control" placeholder="TIPO MAQUINA" autofocus>
                </div>
                <select class="form-select" name="ESTATUS">
                    <option value="0" >SELECCIONE UN ESTADO</option>
                    <option value="ACTIVO" >ACTIVO</option>
                    <option value="INACTIVO" >INACTIVO</option>
                </select>
                </br>
                
                <input type="submit" class="btn btn-success btn-block" name="ingresar" value="INGRESAR">
            </form>
        </div>
    </div>
</div>

<?php } else { echo "<script> alert('fokiu'); window.location='menu.php' </script>";} ?>

<?php } else { echo "<script> window.location='dashboard.php' </script>";} ?>