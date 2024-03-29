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

    public function createAsistente($nombre, $apellido, $correo)
    {
        $query = "INSERT INTO asistente (ase_nombre, ase_apellido, ase_correo) VALUES (:nombre, :apellido, :correo)";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":apellido", $apellido);
        $stmt->bindParam(":correo", $correo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAsistente($id, $nombre, $apellido, $correo)
    {
        $query = "UPDATE asistente SET ase_nombre = :nombre, ase_apellido = :apellido, ase_correo = :correo WHERE ase_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":apellido", $apellido);
        $stmt->bindParam(":correo", $correo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAsistente($id)
    {
        $query = "DELETE FROM asistente WHERE ase_id = :id";
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

    public function getAsistentes()
    {
        $query = "SELECT * FROM asistente";
        $stmt = $this->db_connection->prepare($query);
        $stmt->execute();
        $asistentes = $stmt->fetchAll();

        return $asistentes;
    }

    public function getSearch($search)
    {
        $query = "SELECT * FROM asistente WHERE asistente.ase_nombre = :search OR asistente.ase_apellido = :search OR asistente.ase_correo = :search";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":search", $search);
        $stmt->execute();
        $asistentes = $stmt->fetchAll();

        if (count($asistentes) > 0) {
            return $asistentes;
        } else {
            return false;
        }
    }

    public function getAsistente($id)
    {
        $query = "SELECT * FROM asistente WHERE asistente.ase_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $asistente = $stmt->fetch(PDO::FETCH_ASSOC);

        return $asistente;
    }
}
