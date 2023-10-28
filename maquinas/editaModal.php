<div class="modal fade" id="editaModal" tabindex="-1" aria-labelledby="editaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editaModalLabel">Editar maquina</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

       <form action="actualiza.php" method="post" enctype="multipart/form-data">

        <div class="mb-3">
          <lable class="form-label" for="COD_MAQUINA">Codigo maquina:</lable>
          <input type="text" name="COD_MAQUINA" id="COD_MAQUINA" class="form-control" required>
        </div>

        <div class="mb-3">
          <lable class="form-label" for="tipo">Tipo de maquina:</lable>
          <select  name="tipo" id="tipo" class="form-select" required> 
            <option value="">Seleccionar</option>
            <?php while( $row_tipo = $tipos->fetch_assoc()){ ?>
                <option value="<?php echo $row_tipo["ID_TIPO_MAQUINA"]; ?>"><?= $row_tipo["DESCRIPCION"]; ?></option>
                <?php  } ?>
          </select>
        </div>

        <div class="mb-3">
          <lable class="form-label" for="descripcion">Descripcion:</lable>
          <input type="text" name="descripcion" id="descripcion" class="form-control" required>
        </div>

        <div class="mb-3">
          <lable class="form-label" for="precio_hora">Precio:</lable>
          <input type="number" name="precio_hora" id="precio_hora" class="form-control" required>
        </div>

        <div class="mb-3">
          <img id="img_foto" width="100">
        </div>

        <div class="mb-3">
          <lable class="form-label" for="foto">Foto:</lable>
          <input type="file" name="foto" id="foto" class="form-control" accept="image/jpeg">
        </div>

        <div class="">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <i class="fa-solid fa-xmark"></i> Cerrar</button>
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </div>

       </form>

      </div>
     
    </div>
  </div>
</div>