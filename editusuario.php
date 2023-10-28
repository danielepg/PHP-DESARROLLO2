<?php session_start();
include("db.php");
if(isset($_SESSION['CODIGO_USUARIO'])){ 

$fecha_actual = getdate();
$fecha_formato_mysql = $fecha_actual['year'] . '-' . $fecha_actual['mon'] . '-' . $fecha_actual['mday'];

if(isset($_GET['ID']))
{
    $ID = $_GET['ID'];
    $query = "SELECT * FROM usuario WHERE ID_USUARIO = $ID";
    $resultado = mysqli_query($conn, $query);

    if(mysqli_num_rows($resultado) == 1)
    {
        $row = mysqli_fetch_array($resultado);
        //$ID = $row['ID'];
        $CODIGO_USUARIO = $row['CODIGO_USUARIO'];
        $CORREO = $row['CORREO'];
        $CONTRASEÑA = $row['CONTRASEÑA'];
        $ROL = $row['ID_ROL'];
        $ESTADO = $row['ESTADO'];
    }
}

if(isset($_POST['actualizar']))
{
    $ID = $_GET['ID'];
    $CODIGO_USUARIO = $_POST['CODIGO_USUARIO'];
    $CORREO = $_POST['CORREO'];
    $CONTRASEÑA = $_POST['CONTRASEÑA'];
    $ESTADO = $_POST['ESTADO'];
    $ROL = $_POST['ID_ROL'];


    $query = "UPDATE usuario SET 
    CODIGO_USUARIO = '$CODIGO_USUARIO', 
    CORREO = '$CORREO', 
    CONTRASEÑA = '$CONTRASEÑA' , 
    ESTADO = '$ESTADO' , 
    FECHA = '$fecha_formato_mysql' , 
    ID_ROL = '$ROL' 
    WHERE ID_USUARIO = $ID ";

    mysqli_query($conn, $query);
    header("Location: listausuario.php");
}
?>

<?php include("includes/header.php")?>
<?php
if($_SESSION['ID_ROL'] != 3) { ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body">
                <form action="editusuario.php?ID=<?php echo $_GET['ID']; ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="ID" value="<?php echo $ID; ?>" class="form-control"
                            placeholder="Actualizar ID">
                    </div>
                    <div class="form-group">
                        <input type="text" name="CODIGO_USUARIO" value="<?php echo $CODIGO_USUARIO; ?>"
                            class="form-control" placeholder="Actualizar CODIGO">
                    </div>
                    <div class="form-group">
                        <input type="text" name="CORREO" value="<?php echo $CORREO; ?>" class="form-control"
                            placeholder="Actualizar NOMBRE">
                    </div>
                    <div class="form-group">
                        <input type="password" name="CONTRASEÑA" value="<?php echo $CONTRASEÑA; ?>" class="form-control"
                            placeholder="Actualizar APELLIDO">
                    </div>
                    <select class="form-select" name="ESTADO">
                        <option value="A" <?php if($ESTADO == 'A'){ ?> selected <?php } ?> >ACTIVO</option>
                        <option value="I" <?php if($ESTADO == 'I'){ ?> selected <?php } ?>  >INACTIVO</option>
                    </select>
                    </br>
                    <select class="form-select" name="ID_ROL">
                        <option value="1" <?php if($ROL == "ADMINISTRADOR"){ ?> selected <?php } ?> >ADMINISTRADOR</option>
                        <option value="2" <?php if($ROL == "ENCARGADO"){ ?> selected <?php } ?>  >ENCARGADO</option>
                        <option value="3" <?php if($ROL == "EMPLEADO"){ ?> selected <?php } ?>  >EMPLEADO</option>
                    </select>
                    </br>
                    <button class="btn btn-success" name="actualizar">
                        ACTUALIZAR
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php } else { echo "<script> alert('fokiu'); window.location='menu.php' </script>";} ?>

<?php } else { echo "<script> window.location='dashboard.php' </script>";} ?>