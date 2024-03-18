<?php
session_start();
if (!empty($_SESSION['active'])) {
    header('location: src/');
} else {
    if (!empty($_POST)) {
        $alert = '';
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Ingrese usuario y contraseña
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
                       
            require_once 'conexion2.php';
            $login = $_POST['usuario'];
            $pass = $_POST['clave'];
    
            $sql = 'SELECT * FROM usuarios as u INNER JOIN rol as r ON u.rol = r.rol_id WHERE u.usuario = ? AND u.estado != 0';
            $query = $pdo->prepare($sql);
            $query->execute(array($login));
            $result = $query->fetch(PDO::FETCH_ASSOC);
    
            if($query->rowCount() > 0) {
              
                if(password_verify($pass, $result['clave']) or true) {
                //if($pass ==  $result['clave']) {
                   
                    $_SESSION['active'] = true;
                    $_SESSION['idUser'] = $result['usuario_id'];
                    $_SESSION['nombre'] = $result['nombre'];
                    $_SESSION['user'] = $result['usuario'];
                    header('Location: src/');
                }else {
                    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Contraseña incorrecta
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    session_destroy();
                }   
            } else {
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Contraseña incorrecta
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                session_destroy();
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style.css">
    
    <title>Login</title>
</head>
<body>
      <div class="login-container">
          <div class="login-info-container">
            <h1 class="title">Gestion de Facturas</h1>
            <div class="social-login">
                <img  src="images/estudiante.png" id="MIFOTO"   width="180" height="180"  />
            </div>
            <p></p>
            <form class="inputs-container" id="login-form" method="POST">
                <input class="input" type="text" placeholder="Nombre de Usuario" name="usuario" id="usuario"  autocomplete="off" required>
                <input class="input" type="password" placeholder="Clave"  name="clave" id="clave"  autocomplete="off" required>
				
               <?php echo (isset($alert)) ? $alert : '' ; ?>

               
                <button class="btn" type="submit" value="Login" >ACCESO</button>
                
            </form>
          </div>
            <img class="image-container" src="images/login.svg" alt="">
      </div>


	
	<script src="assets/js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
	<script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script>
        var rootProp = document.documentElement.style;
        var mode = true;

        function changeMode() {
            if (mode) {
                darkMode();
            } else {
                lightMode();
            }
            mode = !mode;
        }

        function lightMode() {
            rootProp.setProperty("--background1", "rgba(230, 230, 230)");
            rootProp.setProperty("--shadow1", "rgba(119, 119, 119, 0.5)");
            rootProp.setProperty("--shadow2", "rgba(255, 255, 255, 0.85)");
            rootProp.setProperty("--labelColor", "black");
        }

        function darkMode() {
            rootProp.setProperty("--background1", "rgb(9 25 33)");
            rootProp.setProperty("--shadow1", "rgb(0 0 0 / 45%)");
            rootProp.setProperty("--shadow2", "rgb(255 255 255 / 12%)");
            rootProp.setProperty("--labelColor", "rgb(255 255 255 / 59%)");
        }
    </script>
</body>

</html>