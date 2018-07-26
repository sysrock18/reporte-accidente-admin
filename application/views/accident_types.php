<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Reporte Accidente Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/ionicons@4.2.5/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/home.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/styles.css') ?>" rel="stylesheet">
  </head>

  <body>
    <?php $this->load->view('common/navbar') ?>

    <div class="container-fluid">
      <div class="row">
        <?php $this->load->view('common/sidemenu', array('current_page' => 'accident_types')) ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Tipos de Accidentes</h1>
          </div>

          <div class="table-wrapper">
            <div class="table-title">
              <div class="row">
                  <div class="col-sm-12">
                      <a href="#formAccidentModal" data-toggle="modal" class="btn btn-info add-new"><i class="icon ion-md-add"></i> Añadir</a>
                  </div>
              </div>
            </div>

            <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th class="actions">Acciones</th>
                  </tr>
              </thead>
              <tbody>
                <?php foreach ($accident_types as $accident_type): ?>
                  <tr>
                    <td><?php echo $accident_type->id ?></td>
                    <td><?php echo $accident_type->name ?></td>
                    <td>
                      <a
                        href="#formAccidentModal"
                        class="edit"
                        data-toggle="modal"
                        data-id="<?php echo $accident_type->id ?>"
                        data-name="<?php echo $accident_type->name ?>"
                      >
                        <i class="icon ion-md-create"></i>
                      </a>
                      <a
                        href="#deleteModal"
                        class="delete"
                        data-toggle="modal"
                        data-id="<?php echo $accident_type->id ?>"
                      >
                        <i class="icon ion-md-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
            <div class="clearfix">
              <ul class="pagination" id="pagination">
              </ul>
            </div>
          </div>
        </main>
      </div>
    </div>

    <div id="formAccidentModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="<?php echo base_url('home/accident_type_register') ?>" method="POST">
            <div class="modal-header">
              <h4 class="modal-title"><span id="form-title"></span> tipo de accidente</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Nombre</label>
                <input id="input-name" name="name" type="text" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" id="input-id" name="id" value="">
              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
              <input type="submit" class="btn btn-info" value="Guardar">
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php $this->load->view('widgets/delete_modal', array('action' => base_url('home/accident_type_delete'))) ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>
    <script type="text/javascript">
      $(function () {
        var count = <?php echo $count ?>;

        if (count > 0) {
          window.pagObj = $('#pagination').twbsPagination({
            totalPages: Math.ceil(count / 10),
            visiblePages: 5,
            startPage: <?php echo $page ?>,
            first: 'Primera',
            last: 'Ultima',
            next: 'Siguiente',
            prev: 'Anterior',
            initiateStartPageClick: false,
            onPageClick: function (event, page) {
              window.location.href = 'accident_types?page='+page;
            }
          });
        }

        $('.edit').click(function() {
          $('#form-title').text('Editar');
          $('#input-id').val($(this).data('id'));
          $('#input-name').val($(this).data('name'));
        })

        $('.add-new').click(function() {
          $('#form-title').text('Añadir');
          $('#input-id').val('');
          $('#input-name').val('');
        })

        $('.delete').click(function() {
          $('#input-delete-id').val($(this).data('id'));
        })
      });
    </script>
  </body>
</html>
