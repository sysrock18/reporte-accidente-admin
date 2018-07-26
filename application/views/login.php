<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Reporte Accidente Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/login.css') ?>" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="<?php echo base_url('login/auth_user') ?>" method="POST">
      <img class="mb-4" src="http://icons.iconarchive.com/icons/graphicloads/colorful-long-shadow/256/Car-icon.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Reporte Accidente Admin</h1>
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email" required autofocus>
      <label for="inputPassword" class="sr-only">Contraseña</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Contraseña" required>
      <?php
        if (isset($message)) {
          echo $message;
        }
      ?>
      <button class="btn btn-lg btn-secondary btn-block mt-3" type="submit">Ingresar</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
    </form>
  </body>
</html>