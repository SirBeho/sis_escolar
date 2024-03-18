
<?php



class Estudiante
{
    private $nombre, $grupo, $id;

    public function __construct($nombre, $grupo, $id = null)
    {
        $this->nombre = $nombre;
        $this->grupo = $grupo;
        if ($id) {
            $this->id = $id;
        }
    }

    public function guardar()
    {
        global $mysqli;
        $sentencia = $mysqli->prepare("INSERT INTO estudiantes
            (nombre, grupo)
                VALUES
                (?, ?)");
        $sentencia->bind_param("ss", $this->nombre, $this->grupo);
        $sentencia->execute();
    }

    public static function obtener()
    {
       
        $host = 'localhost';
        $user = 'root';
        $db = 'sistema-escolar';
        $pass = '';

    try {
        $pdo = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8',$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(Exception $e) {
        'error: '.$e->getMessage();
    }

        $sql = 'SELECT id, nombre, grupo FROM estudiantes';
        $query = $pdo->prepare($sql);
        $query->execute();
          
        return $consulta = $query->fetchAll(PDO::FETCH_ASSOC);

  

    }
    public static function obtenerUno($id)
    {
        global $mysqli;
        $sentencia = $mysqli->prepare("SELECT id, nombre, grupo FROM estudiantes WHERE id = ?");
        $sentencia->bind_param("i", $id);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        return $resultado->fetch_object();
    }
    public function actualizar()
    {
        global $mysqli;
        $sentencia = $mysqli->prepare("update estudiantes set nombre = ?, grupo = ? where id = ?");
        $sentencia->bind_param("ssi", $this->nombre, $this->grupo, $this->id);
        $sentencia->execute();
    }

    public static function eliminar($id)
    {
        global $mysqli;
        $sentencia = $mysqli->prepare("DELETE FROM estudiantes WHERE id = ?");
        $sentencia->bind_param("i", $id);
        $sentencia->execute();
    }
}
