<?php session_start();
include("db.php");
if(isset($_SESSION['CODIGO_USUARIO'])){ 

if(isset($_GET['ID']))
{
    $ID = $_GET['ID'];
    $query = "SELECT * FROM tipo_maquina WHERE ID_TIPO_MAQUINA = $ID";
    $resultado = mysqli_query($conn, $query);

    if(mysqli_num_rows($resultado) == 1)
    {
        $row = mysqli_fetch_array($resultado);
        //$ID = $row['ID'];
        $DESCRIPCION = $row['DESCRIPCION'];
        $ESTATUS = $row['ESTATUS'];
    }
}

if(isset($_POST['actualizar']))
{
    $ID = $_GET['ID'];
    $DESCRIPCION = $_POST['DESCRIPCION'];
    $ESTATUS = $_POST['ESTATUS'];


    $query = "UPDATE tipo_maquina SET 
    DESCRIPCION = '$DESCRIPCION', 
    ESTATUS = '$ESTATUS'
    WHERE ID_TIPO_MAQUINA = $ID ";

    mysqli_query($conn, $query);
    header("Location: listatipomaquina.php");
}
?>

<?php include("includes/header.php")?>
<?php
if($_SESSION['ID_ROL'] != 3) { ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body">
                <form action="edittipomaquina.php?ID=<?php echo $_GET['ID']; ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="ID" value="<?php echo $ID; ?>" class="form-control"
                            placeholder="Actualizar ID">
                    </div>
                    <div class="form-group">
                        <input type="text" name="DESCRIPCION" value="<?php echo $DESCRIPCION; ?>"
                            class="form-control" placeholder="Actualizar DESCRIPCION">
                    </div>
                    <select class="form-select" name="ESTATUS">
                        <option value="ACTIVO" <?php if($ESTATUS == "ACTIVO"){ ?> selected <?php } ?> >ACTIVO</option>
                        <option value="INACTIVO" <?php if($ESTATUS == "INACTIVO"){ ?> selected <?php } ?>  >INACTIVO</option>
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