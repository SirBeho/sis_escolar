<?php 
//redireccionar a la vista de login

//header('location: vistas/login.html');
 ?>

<!DOCTYPE html>
<html>
  <head>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style1.css">
    
    <title>Login</title>
</head>
	
  </head>
  <body>
  

     <div class="login-container">
          <div class="login-info-container">
            <h1 class="title">GESTION DE MATERIAS</h1>
			
            <div class="social-login">
                <img  src="vistas/images/estudiante.png" id="MIFOTO"   width="100" height="100"  />
            </div>
            <p></p>
            <form  class="inputs-container" method="post" id="frmAcceso" >
                <input class="input" type="text" id="logina" name="logina" placeholder="Nombre de Usuario">
                <input class="input" type="password" id="clavea" name="clavea"  placeholder="Clave">
                <div id="msjerror"></div>
                <button type="submit" class="btn">ACCESO</button>
                
            </form>
          </div>
            <img class="image-container" src="vistas/images/login.svg" alt="">
      </div>




  <!-- jQuery -->
    <script src="public/js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="public/js/bootstrap.min.js"></script>
     <!-- Bootbox -->
    <script src="public/js/bootbox.min.js"></script>

    <script type="text/javascript" src="vistas/scripts/login.js"></script>


  </body>
</html> 
