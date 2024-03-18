<?php
    require_once 'includes/header.php';
    require_once 'includes/admisiones/modal_admisiones.php';
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="app-menu__icon fa fa-user-graduate"></i>Admisiones
          <button class="btn btn-success" type="button" onclick="openModalProfesorMateria()">Nuevas Admisiones</button></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Admisiones</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableprofesormateria">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Curso requerido</th>
                      <th>Fecha de nacimiento</th>
                      <th>Nombre padres</th>
                      <th>Nombre madres</th>
                      <th>Domicilio</th>
                      <th>Telefono</th>
                      <th>Email</th>
					  <th>Alguna enfermeda</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

<?php
    require_once 'includes/footer.php';
?>