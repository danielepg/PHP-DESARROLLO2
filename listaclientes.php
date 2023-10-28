<?php session_start();
include("db.php");
include("includes/header.php");
if(isset($_SESSION['CODIGO_USUARIO'])){
if($_SESSION['ID_ROL'] != 3) { ?>
<!DOCTYPE html>
<html>
<head>
    <title>CLIENTES</title>
    <!-- Incluye los enlaces a los archivos CSS y JS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/all.min.css" rel="stylesheet">

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

</head>

<body>


    
<div class="container p-4">
<h2 class="text-center">Clientes</h2>
</br>
    <!-- <a href="showcliente.php" class="btn btn-primary">INGRESAR CLIENTE</a>

    <br></br> -->

    <form class="d-flex">
    <input class="form-control me-2 light-table-filter" id="myInput" onkeyup="myFunction()">
    <hr>
    </form>    
    <br/>

    <div class="row">

        <div class="table">

        
        <table class="table table-striped table-dark table_id" id="myTable">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>CODIGO</th>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>DIRECCION</th>
                <th>TELEFONO</th>
                <th>DPI</th>
                <th>NIT</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $query = "SELECT * FROM cliente";
                $resultado_cliente = mysqli_query($conn, $query);

                while($row = mysqli_fetch_array($resultado_cliente)) { ?>

                <tr>
                    <td><?php echo $row['ID_CLIENTE'] ?></td>
                    <td><?php echo $row['COD_CLIENTE']  ?></td>
                    <td><?php echo $row['NOMBRE']  ?></td>
                    <td><?php echo $row['APELLIDO']  ?></td>
                    <td><?php echo $row['DIRECCION']  ?></td>
                    <td><?php echo $row['TELEFONO']  ?></td>
                    <td><?php echo $row['DPI']  ?></td>
                    <td><?php echo $row['NIT']  ?></td>
                    
                    <td>

                    <div class="btn-group">
                    <a href="editcliente.php?ID=<?php echo $row['ID_CLIENTE']?>" class="btn btn-primary">
                        <i class="fas fa-marker"></i>
                        </a>
                        <a href="deletecliente.php?ID=<?php echo $row['ID_CLIENTE']?>" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i>
                    </a>
                    </div>                 

                    </td>
                </tr>
            <?php } ?>

        </tbody>
        </table>
        </div>
    </div>
</div>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    var display = "none";
    for (j = 0; j < 8; j++) {  // Cambia el número 5 por la cantidad de columnas que deseas filtrar
      td = tr[i].getElementsByTagName("td")[j];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) { 
          display = "";
          break;  // Si encuentra una coincidencia en alguna de las columnas, muestra la fila y detiene la búsqueda.
        }
      }
    }
    tr[i].style.display = display;
  }
}
</script>

<script src="script.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>

</body>
<?php } else { echo "<script> alert('fokiu'); window.location='menu.php' </script>";} ?>

<?php } else { echo "<script> window.location='dashboard.php' </script>";} ?>