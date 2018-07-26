<div id="deleteModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo $action ?>" method="POST">
        <div class="modal-header">            
          <h4 class="modal-title">Eliminar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">          
          <p>¿Estas seguro de eliminar este registro?</p>
          <p class="text-warning"><small>Esta accion no puede deshacerse.</small></p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="input-delete-id" value="">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
          <input type="submit" class="btn btn-danger" value="Eliminar">
        </div>
      </form>
    </div>
  </div>
</div>