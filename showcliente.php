<?php session_start();
include("db.php");
include("includes/header.php");
if(isset($_SESSION['CODIGO_USUARIO'])){
if($_SESSION['ID_ROL'] != 3) { ?>
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
    margin-top: 80px;
    margin-left: 80px;
    margin-right: 80px;
}
</style>

<div class="center-div">
    
    <div class="col-md-6 mx-auto">
        <div class="card card-body">
            <form action="savecliente.php" method="POST">
                
                <div class="form-group">
                    <input type="text" name="CODIGO" class="form-control" placeholder="CODIGO" autofocus>
                </div>
                <div class="form-group">
                    <input type="text" name="NOMBRE" class="form-control" placeholder="NOMBRE">
                </div>
                <div class="form-group">
                    <input type="text" name="APELLIDO" class="form-control" placeholder="APELLIDO">
                </div>
                <div class="form-group">
                    <input type="text" name="DIRECCION" class="form-control" placeholder="DIRECCION">
                </div>
                <div class="form-group">
                    <input type="number" name="TELEFONO" class="form-control" placeholder="TELEFONO">
                </div>
                <div class="form-group">
                    <input type="text" name="DPI" class="form-control" placeholder="DPI">
                </div>
                <div class="form-group">
                    <input type="text" name="NIT" class="form-control" placeholder="NIT">
                </div>

                <input type="submit" class="btn btn-success btn-block" name="ingresar" value="INGRESAR">
            </form>
        </div>
    </div>
</div>

<?php } else { echo "<script> alert('fokiu'); window.location='menu.php' </script>";} ?>

<?php } else { echo "<script> window.location='dashboard.php' </script>";} ?>