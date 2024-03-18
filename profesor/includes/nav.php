<?php

require_once '../includes/conexion.php';

    $idprofesor=$_SESSION['profesor_id'];
	
    $sql = "SELECT * FROM profesor_materia as pm INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN aulas as a ON pm.aula_id = a.aula_id INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE pm.estadopm != 0 AND pm.profesor_id = $idprofesor";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->rowCount();
?> 
 
 
 
 <!-- Sidebar menu-->
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="images/robot.png"  alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['nombre']; ?></p>
          <p class="app-sidebar__user-designation">Docentes</p>
        </div>
      </div>
      <ul class="app-menu">
	  
	 <li><a class="app-menu__item" href="index.php"><i class="app-menu__icon fas fa-home"></i><span class="app-menu__label">Inicio</span></a></li>
      
	  
	  <li class="treeview">
	  <a class="app-menu__item" href="#" data-toggle="treeview">
	  <i class="app-menu__icon fa fa-laptop"></i>
	    <span class="app-menu__label">Mis Cursos</span>
		<i class="treeview-indicator fa fa-angle-right"></i>
		</a>
		
		<ul class="treeview-menu">
	 <?php if($row > 0){
			while($data = $query->fetch()){
		
		?>
            <li><a class="treeview-item" href="contenido.php?curso=<?= $data['pm_id'] ?>"><i class="icon fa fa-circle-o"></i><?= $data['nombre_materia']; ?> - <?= $data['nombre_grado']; ?> - <?=$data['nombre_aula']; ?></a> </li>	
	 <?php }} ?>
	 
	  
	 </ul>
	
	 </li> 
	  
	  
      
      <li><a class="app-menu__item" href="lista_alumnos.php"><i class="app-menu__icon fa fa-graduation-cap"></i><span class="app-menu__label">Alumnos</span></a></li>
	  
      <li><a class="app-menu__item" href="lista_grados.php"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Grados</span></a></li>
      <li><a class="app-menu__item" href="lista_aulas.php"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Aulas</span></a></li>
      <li><a class="app-menu__item" href="lista_materias.php"><i class="app-menu__icon fas fa-list-alt"></i><span class="app-menu__label">Materias</span></a></li>
      <li><a class="app-menu__item" href="lista_periodos.php"><i class="app-menu__icon fa fa-share-alt-square"></i><span class="app-menu__label">Periodos</span></a></li>
      <li><a class="app-menu__item" href="lista_actividad.php"><i class="app-menu__icon fas fa-check-circle"></i><span class="app-menu__label">Actividad</span></a></li>
     <li><a class="app-menu__item" href="lista_profesor_materia.php"><i class="app-menu__icon fa fa-cog fa-lg"></i></i><span class="app-menu__label"> Profesor Materia</span></a></li> 
	 
      <li><a class="app-menu__item" href="lista_alumno_profesor.php"><i class="app-menu__icon fa fa-th-large"></i><span class="app-menu__label"> Alumno Profesor</span></a></li>
	 

	 
	  
	  
	  
	  

        <li><a class="app-menu__item" href="../logout.php"><i class="app-menu__icon fas fa-sign-out-alt"></i><span class="app-menu__label">Logout</span></a></li>
      </ul>
    </aside>