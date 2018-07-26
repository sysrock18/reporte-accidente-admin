<nav class="navbar navbar-dark bg-dark flex-md-nowrap p-0 shadow navbar-expand-md">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Reporte Accidente</a>
  <ul class="navbar-nav nav px-3 ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="#"><?php echo $this->session->userdata('name') ?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('home/user_logout') ?>">Salir</a>
    </li>
  </ul>
</nav>