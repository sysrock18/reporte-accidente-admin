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
        <?php $this->load->view('common/sidemenu', array('current_page' => 'accidents_report')) ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Accidentes Reportados</h1>
          </div>

          <div class="filters">
            <form action="<?php echo base_url('home/accidents_report') ?>" method="POST">
              <div class="form-group col-md-4">
                <label for="accident-type-input">Tipo de Accidente</label>
                <select id="accident-type-input" class="form-control" name="accident_type">
                  <option value="0">Seleccione...</option>
                  <?php foreach ($accident_types as $accident_type): ?>
                    <option
                      <?php echo $accident_type->id == $this->session->userdata('filter_accident_type') ? 'selected' : '' ?>
                      value="<?php echo $accident_type->id ?>"
                    >
                      <?php echo $accident_type->name ?>
                    </option>
                  <?php endforeach ?>
                </select>
              </div>

              <div class="form-row col-md-12">
                <label class="col-form-label mr-2">Desde</label>
                <input type="date" class="form-control col-md-3 mr-3" name="date_to" value="<?php echo $this->session->userdata('filter_date_to') ?>">
                <label class="col-form-label mr-2">Hasta</label>
                <input type="date" class="form-control col-md-3 mr-3" name="date_from" value="<?php echo $this->session->userdata('filter_date_from') ?>">
                <button type="submit" class="btn btn-info mr-3">Buscar</button>
                <a href="<?php echo base_url('home/clean_accidents_report') ?>" class="btn btn-success">Limpiar</a>
              </div>
            </form>
          </div>

          <div class="table-wrapper">
            <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Id</th>
                      <th>Usuario</th>
                      <th>Tipo de Accidente</th>
                      <th>Observaciones</th>
                      <th>Fecha / Hora</th>
                  </tr>
              </thead>
              <tbody>
                <?php foreach ($accidents as $accident): ?>
                  <tr>
                    <td><?php echo $accident->id ?></td>
                    <td><?php echo $accident->username ?></td>
                    <td><?php echo $accident->accident_type_name ?></td>
                    <td><?php echo $accident->comments ?></td>
                    <td><?php echo $accident->date ?></td>
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
              window.location.href = 'accidents_report?page='+page;
            }
          });
        }
      });
    </script>
  </body>
</html>
