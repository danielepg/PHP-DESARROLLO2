<?php session_start();
include("../db.php");
if(isset($_SESSION['CODIGO_USUARIO'])){
if($_SESSION['ID_ROL'] != 3) {

$sqlMaquinas = "SELECT m.COD_MAQUINA, tm.DESCRIPCION, m.descripcion, m.precio_hora FROM maquinas as m
  INNER JOIN tipo_maquina as tm
  ON m.id_tipo_maquina = tm.ID_TIPO_MAQUINA";
  $maquinas = $conn->query($sqlMaquinas);

  $dir = "fotos/"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </br>
    <title>Ingreso de maquinas</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/all.min.css" rel="stylesheet">
</head>
<body>
            
                <div class="container py-3">

                    <h2 class="text-center">Maquinas</h2>

                    <hr>
                    <?php if(isset($_SESSION['msg'])) { ?>

                        <div class="alert alert-success alert-dismissible fade show" role="alert">

                        <?= $_SESSION['msg']; ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    

                        <?php 
                           unset($_SESSION['msg']);
                        } ?>

                    <div class="row justify-content-end ">
                    <div class="col-auto">
                        <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal" ><i class="fa-solid fa-square-plus"></i>Nueva maquina </a>
                </div>
                </div>
                </br>
    <table class="table table-striped table-dark table_id">
        <thead class="table-dark">
            <tr>
                <th>Codigo</th>
                <th>Tipo maquina</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>foto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
           <?php while($row_maquina = $maquinas->fetch_assoc()) { ?>
        <tr>
            <td> <?= $row_maquina['COD_MAQUINA'] ?> </td>
            <td> <?= $row_maquina['DESCRIPCION'] ?> </td>
            <td> <?= $row_maquina['descripcion'] ?> </td>
            <td> <?= $row_maquina['precio_hora'] ?> </td>
            <td>
                <img src="<?= $dir . $row_maquina['COD_MAQUINA'] . '.jpg'; ?>" width="100">
            </td>

            <td>
            <a type="submit" href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-COD_MAQUINA="<?= $row_maquina['COD_MAQUINA']; ?>" ><i class="fa-regular fa-pen-to-square"></i> EDITAR</a>
            <a type="submit" href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-COD_MAQUINA="<?= $row_maquina['COD_MAQUINA']; ?>" ><i class="fa-solid fa-trash"></i> ELIMINAR</a>
            </td>
            

        </tr>
            <?php } ?>
        </tbody>
    </table>

    <br/>

    <button onclick="window.location.href = '../menu.php';" class="btn btn-success btn-block">REGRESAR</button>

</div>
  
<?php
    $sqlTipo ="SELECT ID_TIPO_MAQUINA, DESCRIPCION FROM tipo_maquina";
    $tipos = $conn->query($sqlTipo);
?>
<?php include 'nuevoModal.php'; ?>

<?php $tipos->data_seek(0); ?>

<?php include 'editaModal.php'; ?>
<?php include 'eliminaModal.php'; ?>

<script>
  let editaModal = document.getElementById('editaModal');
  let eliminaModal = document.getElementById('eliminaModal');


    editaModal.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget
    let COD_MAQUINA = button.getAttribute('data-bs-COD_MAQUINA')

    let inputCOD_MAQUINA = editaModal.querySelector('.modal-body #COD_MAQUINA')
    let inputtipo = editaModal.querySelector('.modal-body #tipo')
    let inputdescripcion = editaModal.querySelector('.modal-body #descripcion')
    let inputprecio_hora = editaModal.querySelector('.modal-body #precio_hora')
    let foto = editaModal.querySelector('.modal-body #img_foto')


    let url = "getMaquina.php"
    let formData = new FormData()
    formData.append('COD_MAQUINA', COD_MAQUINA)

    fetch(url, {
        method: "POST",
        body: formData
    }).then(response => response.json())
    .then(data => {
        inputCOD_MAQUINA.value = data.COD_MAQUINA
        inputtipo.value = data.ID_TIPO_MAQUINA
        inputdescripcion.value = data.descripcion
        inputprecio_hora.value = data.precio_hora
        foto.src = '<?= $dir ?>' + data.COD_MAQUINA + '.jpg'
    }).catch(err => console.log(err))
  })

  eliminaModal.addEventListener('shown.bs.modal', event =>{
    let button = event.relatedTarget
    let COD_MAQUINA = button.getAttribute('data-bs-COD_MAQUINA')
    eliminaModal.querySelector('.modal-footer #COD_MAQUINA').value = COD_MAQUINA

  })
</script>



<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php } else { echo "<script> alert('fokiu'); window.location='../menu.php' </script>";} ?>

<?php } else { echo "<script> window.location='dashboard.php' </script>";} ?>