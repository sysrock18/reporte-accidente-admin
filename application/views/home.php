
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
    <nav class="navbar navbar-dark bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Reporte Accidente</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="<?php echo base_url('home/user_logout') ?>">Salir</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <i class="icon ion-ios-home"></i>
                  Inicio <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="icon ion-md-car"></i>
                  Tipos de Accidentes
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="icon ion-md-phone-portrait"></i>
                  Accidentes Reportados
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="icon ion-md-people"></i>
                  Usuarios
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Bienvenido</h1>
          </div>
        </main>
      </div>
    </div>

  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  </body>
</html>
