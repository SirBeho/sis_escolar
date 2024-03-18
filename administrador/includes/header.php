<?php
  session_start();
  if(empty($_SESSION['active'])) {
    header('Location: ../');
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="sistema escolar">
    <title>SISTEMA ESCOLAR</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.php">Sistema Escolar</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"> <i class="fas fa-bars"></i></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
		<!--<li><a class="app-menu__item" href="./gestion1/index.php"><i class="app-menu__icon fa fa-cog fa-lg"></i></i><span class="app-menu__label">Gestion de Profesores</span></a></li>-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
		    <li><a class="dropdown-item" href="./index.php"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a class="dropdown-item" href="./gestion1/index.php"><i class="app-menu__icon fa fa-cog fa-lg"></i></i><span class="app-menu__label">Gestion Profesor</span></a></li>
			<li><a class="dropdown-item" href="./facturacion2/src/salir.php"><i class="app-menu__icon fa fa-credit-card"></i><span class="app-menu__label">Facturas</span></a></li>
          <!--   <li><a class="dropdown-item" href="./f2"><i class="app-menu__icon fas fa-check-circle"></i><span class="app-menu__label">Gestion Facturas</span></a></li>
			<li><a class="dropdown-item" href="./facturacion2/src/EstadoCuentas/index.php"><i class="app-menu__icon fas fa-check-circle"></i><span class="app-menu__label">Gestiion Pagos</span></a></li>
			<li><a class="dropdown-item" href="./salud"><i class="app-menu__icon fas fa-check-circle"></i><span class="app-menu__label">Gestion salud</span></a></li>
    -->         <li><a class="dropdown-item" href="../logout.php"><i class="app-menu__icon fas fa-sign-out-alt"></i> Cerrar sesion</a></li>
          </ul>
		  
	
        </li>
      </ul>
    </header>
<?php require_once 'nav.php'; ?>

