<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

 
require 'header.php';

if ($_SESSION['escritorio']==1) {
$user_id=$_SESSION["idusuario"];
  require_once "../modelos/Consultas.php";
  $consulta = new Consultas();
  $rsptav = $consulta->cantidadalumnos($user_id);
  $regv=$rsptav->fetch_object();
  $totalestudiantes=$regv->total_alumnos;
  $cap_almacen=3000;

 ?>
 
 
 <style>
 
#derecha{
	width:30%;
    height:40%;
	border: white-space;
	background-color:white;
	float:left;
	margin:5px;
    padding: 30px;
	border-radius: 5px;
	

}
 
 
 </style>
 
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
	  <center>
        <div class="col-md-12">
      <div class="box">
	  
<div id="derecha" >


<div class="col-md-4 text-center border mt-3 p-4 bg-light">
		    <div class="card m-2 text-center shadow"  >
		
			    <img src="f2.png" width="300" height="330" class="card-img-top" alt="..." >
				<div class="card-body">
				    <h4 class="card-title text-center" style="width: 30rem;" >Gestionar Acceso </h4>
					
					
					<a href="usuario.php" class="btn btn-warning"  style="width: 30rem;" >Acceso</a>
				</div>
			
			</div>
		
		</div>

</div>

<!--fin centro      style="height: 23rem;"          style="width: 20rem;"  -->
      </div>
      </div>
	  </center>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<?php 
}else{
 require 'noacceso.php'; 
}

require 'footer.php';
 ?>

 <?php 
}

ob_end_flush();
  ?>

