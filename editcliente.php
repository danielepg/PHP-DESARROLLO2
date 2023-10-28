<?php session_start();
include("db.php");
include("includes/header.php");
if(isset($_SESSION['CODIGO_USUARIO'])){
if($_SESSION['ID_ROL'] != 3) {

if(isset($_GET['ID']))
{
    $ID = $_GET['ID'];
    $query = "SELECT * FROM cliente WHERE ID_CLIENTE = $ID";
    $resultado = mysqli_query($conn, $query);

    if(mysqli_num_rows($resultado) == 1)
    {
        $row = mysqli_fetch_array($resultado);
        //$ID = $row['ID'];
        $CODIGO = $row['COD_CLIENTE'];
        $NOMBRE = $row['NOMBRE'];
        $APELLIDO = $row['APELLIDO'];
        $DIRECCION = $row['DIRECCION'];
        $TELEFONO = $row['TELEFONO'];
        $DPI = $row['DPI'];
        $NIT = $row['NIT'];
    }
}

if(isset($_POST['actualizar']))
{
    $ID = $_GET['ID'];
    $CODIGO = $_POST['CODIGO'];
    $NOMBRE = $_POST['NOMBRE'];
    $APELLIDO = $_POST['APELLIDO'];
    $DIRECCION = $_POST['DIRECCION'];
    $TELEFONO = $_POST['TELEFONO'];
    $DPI = $_POST['DPI'];
    $NIT = $_POST['NIT'];

    $query = "UPDATE cliente SET 
    COD_CLIENTE = '$CODIGO', 
    NOMBRE = '$NOMBRE', 
    APELLIDO = '$APELLIDO' , 
    DIRECCION = '$DIRECCION' , 
    TELEFONO = '$TELEFONO' , 
    DPI = '$DPI',
    NIT = '$NIT' 
    WHERE ID_CLIENTE = $ID ";

    mysqli_query($conn, $query);
    echo "<script>window.location='listaclientes.php' </script>";
}

?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body">
                <form action="editcliente.php?ID=<?php echo $_GET['ID']; ?>" method="POST" >
                    <div class="form-group">
                        <input type="text" name="ID" value="<?php echo $ID; ?>"
                        class="form-control" placeholder="Actualizar ID">
                    </div>
                    <div class="form-group">
                        <input type="text" name="CODIGO" value="<?php echo $CODIGO; ?>"
                        class="form-control" placeholder="Actualizar CODIGO">
                    </div>
                    <div class="form-group">
                        <input type="text" name="NOMBRE" value="<?php echo $NOMBRE; ?>"
                        class="form-control" placeholder="Actualizar NOMBRE">
                    </div>
                    <div class="form-group">
                        <input type="text" name="APELLIDO" value="<?php echo $APELLIDO; ?>"
                        class="form-control" placeholder="Actualizar APELLIDO">
                    </div>
                    <div class="form-group">
                        <input type="text" name="DIRECCION" value="<?php echo $DIRECCION; ?>"
                        class="form-control" placeholder="Actualizar DIRECCION">
                    </div>
                    <div class="form-group">
                        <input type="text" name="TELEFONO" value="<?php echo $TELEFONO; ?>"
                        class="form-control" placeholder="Actualizar TELEFONO">
                    </div>
                    <div class="form-group">
                        <input type="text" name="DPI" value="<?php echo $DPI; ?>"
                        class="form-control" placeholder="Actualizar DPI">
                    </div>
                    <div class="form-group">
                        <input type="text" name="NIT" value="<?php echo $NIT; ?>"
                        class="form-control" placeholder="Actualizar NIT">
                    </div>                    
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