<?php
class Model
{
    private $db_connection;

    public function __construct()
    {
        $rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $rutaProyecto = explode("/", $rutaCarpeta);
        include $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/core/database.php';
        $database = new Database();
        $this->db_connection = $database->getConnection();
    }

    public function createUbicacion($nombre, $direccion)
    {
        $query = "INSERT INTO ubicacion (ubi_nombre, ubi_direccion) VALUES (:nombre, :direccion)";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":direccion", $direccion);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUbicacion($id, $nombre, $direccion)
    {
        $query = "UPDATE ubicacion SET ubi_nombre = :nombre, ubi_direccion = :direccion WHERE ubi_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":direccion", $direccion);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUbicacion($id)
    {
        $query = "DELETE FROM ubicacion WHERE ubi_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getUbicaciones()
    {
        $query = "SELECT * FROM ubicacion";
        $stmt = $this->db_connection->prepare($query);
        $stmt->execute();
        $ubicaciones = $stmt->fetchAll();

        return $ubicaciones;
    }

    public function getUbicacion($id)
    {
        $query = "SELECT * FROM ubicacion WHERE ubicacion.ubi_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $ubicacion = $stmt->fetch(PDO::FETCH_ASSOC);

        return $ubicacion;
    }

    public function getSearch($search)
    {
        $query = "SELECT * FROM ubicacion WHERE ubicacion.ubi_nombre = :search OR ubicacion.ubi_direccion = :search";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":search", $search);
        $stmt->execute();
        $ubicaciones = $stmt->fetchAll();

        if (count($ubicaciones) > 0) {
            return $ubicaciones;
        } else {
            return false;
        }
    }
}
