<!-- Modal -->

<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="eliminaModalLabel">Eliminar maquina</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      ¿Desea eliminar la maquina?

      </div>

      <div class="modal-footer">
      <form action="elimina.php" method="post">
       <input type="hidden" name="COD_MAQUINA" id="COD_MAQUINA">
         
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <i class="fa-solid fa-xmark"></i> Cerrar</button>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Eliminar</button>
         
        </form>
      </div>
     
    </div>
  </div>
</div>