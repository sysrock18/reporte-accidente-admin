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
  </head>

  <body>
    <?php $this->load->view('common/navbar') ?>

    <div class="container-fluid">
      <div class="row">
        <?php $this->load->view('common/sidemenu', array('current_page' => 'home')) ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Bienvenido</h1>
          </div>
          <div class="row m-5">
            <div class="dashboard-card col-md-4 text-center py-3 mr-3">
              <i class="icon ion-md-warning"></i>
              <h2><?php echo $count_accidents ?></h2>
              <div>Accidentes reportados</div>
            </div>
            <div class="dashboard-card col-md-4 text-center py-3">
              <i class="icon ion-md-contacts"></i>
              <h2><?php echo $count_users ?></h2>
              <div>Usuarios registrados</div>
            </div>
          </div>
        </main>
      </div>
    </div>

  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  </body>
</html>
