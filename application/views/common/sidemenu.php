<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link<?php echo $current_page === 'home' ? ' active' : '' ?>" href="<?php echo base_url('home') ?>">
          <i class="icon ion-ios-home"></i>
          Inicio
        </a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link<?php echo $current_page === 'accident_types' ? ' active' : '' ?>"
          href="<?php echo base_url('home/accident_types') ?>"
        >
          <i class="icon ion-md-car"></i>
          Tipos de Accidentes
        </a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link<?php echo $current_page === 'accidents_report' ? ' active' : '' ?>"
          href="<?php echo base_url('home/accidents_report') ?>"
        >
          <i class="icon ion-md-phone-portrait"></i>
          Accidentes Reportados
        </a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link<?php echo $current_page === 'users' ? ' active' : '' ?>"
          href="<?php echo base_url('home/users') ?>"
        >
          <i class="icon ion-md-people"></i>
          Usuarios
        </a>
      </li>
    </ul>
  </div>
</nav>