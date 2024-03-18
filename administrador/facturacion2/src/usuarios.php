<?php
session_start();
$permiso = 'usuarios';
$id_user = $_SESSION['idUser'];
include "../conexion.php";

// Crear la consulta preparada
$query = "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = ? AND p.nombre = ?";

// Preparar la consulta
if ($stmt = mysqli_prepare($conexion, $query)) {
    // Vincular parámetros a la consulta preparada
    mysqli_stmt_bind_param($stmt, "is", $id_user, $permiso);
    
    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);
    
    // Obtener resultados
    $result = mysqli_stmt_get_result($stmt);
    
    // Obtener todos los resultados como un array
    $existe = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    // Liberar el statement
    mysqli_stmt_close($stmt);
} else {
    // Manejar errores de consulta
    echo "Error en la consulta preparada: " . mysqli_error($conexion);
}



if (empty($existe) && $id_user != 1) {
    header('Location: permisos.php');
}
if (!empty($_POST)) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['correo'];
    $user = $_POST['usuario'];
    $alert = "";
    if (empty($nombre) || empty($email) || empty($user)) {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Todo los campos son obligatorio
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    } else {
        if (empty($id)) {
            $clave = $_POST['clave'];
            if (empty($clave)) {
                $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    La contraseña es requerido
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                $clave = md5($_POST['clave']);
                $query = mysqli_query($conexion, "SELECT * FROM usuarios where correo = '$email'");
                $result = mysqli_fetch_array($query);
                if ($result > 0) {
                    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    El correo ya existe
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                } else {
                    $query_insert = mysqli_query($conexion, "INSERT INTO usuario(nombre,correo,usuario,clave) values ('$nombre', '$email', '$user', '$clave')");
                    if ($query_insert) {
                        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Usuario Registrado
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                    } else {
                        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al registrar
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                    }
                }
            }
        } else {
            $sql_update = mysqli_query($conexion, "UPDATE usuario SET nombre = '$nombre', correo = '$email' , usuario = '$user' WHERE usuario_id = $id");
            if ($sql_update) {
                $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Usuario Modificado
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al modificar
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        }
    }
}
include "includes/header.php";
?>
<div class="card">
    <div class="card-body">
        <form action="" method="post" autocomplete="off" id="formulario">
            <?php echo isset($alert) ? $alert : ''; ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" placeholder="Ingrese Nombre" name="nombre" id="nombre">
                        <input type="hidden" id="id" name="id">
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control" placeholder="Ingrese Correo Electrónico" name="correo" id="correo">
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" placeholder="Ingrese Usuario" name="usuario" id="usuario">
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="clave">Contraseña</label>
                        <input type="password" class="form-control" placeholder="Ingrese Contraseña" name="clave" id="clave">
                    </div>
                </div>
            </div>
            <input type="submit" value="Registrar" class="btn btn-primary" id="btnAccion">
            <input type="button" value="Nuevo" class="btn btn-success" id="btnNuevo" onclick="limpiar()">
        </form>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered mt-2" id="tbl">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conexion, "SELECT * FROM usuarios");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_assoc($query)) { ?>
                    <tr>

                        <td><?php echo $data['usuario_id']; ?></td>
                        <td><?php echo $data['nombre']; ?></td>
                        <td><?php echo $data['emailid']; ?></td>
                        <td><?php echo $data['usuario']; ?></td>
                        <td>
                            <a href="rol.php?id=<?php echo $data['usuario_id']; ?>" class="btn btn-warning"><i class='fas fa-key'></i></a>
                            <a href="#" onclick="editarUsuario(<?php echo $data['usuario_id']; ?>)" class="btn btn-success"><i class='fas fa-edit'></i></a>
                            <form action="eliminar_usuario.php?id=<?php echo $data['usuario_id']; ?>" method="post" class="confirmar d-inline">
                                <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                            </form>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</div>
<?php include_once "includes/footer.php"; ?>