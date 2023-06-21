<?php
class Model
{
    private $db_connection;

    public function __construct()
    {
        include '../config/database.php';
        $database = new Database();
        $this->db_connection = $database->getConnection();
    }

    public function createEvento($nombre, $fecha, $ubicacion)
    {
        $query = "INSERT INTO evento (eve_nombre, eve_fecha, ubi_id) VALUES (:nombre, :fecha, :ubicacion)";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":ubicacion", $ubicacion);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateEvento($id, $nombre, $fecha, $ubicacion)
    {
        $query = "UPDATE evento SET eve_nombre = :nombre, eve_fecha = :fecha, ubi_id = :ubicacion WHERE eve_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":ubicacion", $ubicacion);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEvento($id)
    {
        $query = "DELETE FROM evento WHERE eve_id = :id";
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

    public function getEvento($id)
    {
        $query = "SELECT * FROM evento WHERE evento.eve_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $evento = $stmt->fetch(PDO::FETCH_ASSOC);

        return $evento;
    }

    public function getEventos()
    {
        $query = "SELECT * FROM evento INNER JOIN ubicacion ON evento.ubi_id = ubicacion.ubi_id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->execute();
        $eventos = $stmt->fetchAll();

        return $eventos;
    }

    public function getUbicaciones()
    {
        $query = "SELECT ubicacion.ubi_id, ubicacion.ubi_nombre FROM ubicacion";
        $stmt = $this->db_connection->prepare($query);
        $stmt->execute();
        $ubicaciones = $stmt->fetchAll();

        return $ubicaciones;
    }

    public function createAsistencia($evento, $asistente)
    {
        $query = "INSERT INTO asistencia (ase_id, eve_id) VALUES (:asistente, :evento)";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":asistente", $asistente);
        $stmt->bindParam(":evento", $evento);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAsistentesxE($evento)
    {
        $query = "SELECT asistencia.asa_id, asistente.ase_nombre, asistente.ase_apellido
		FROM asistencia
		INNER JOIN evento ON evento.eve_id = asistencia.eve_id
		INNER JOIN asistente ON asistente.ase_id = asistencia.ase_id
        WHERE asistencia.eve_id = :evento";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":evento", $evento);
        $stmt->execute();
        $eventos = $stmt->fetchAll();

        return $eventos;
    }

    public function getAsistentes()
    {
        $query = "SELECT asistente.ase_id, asistente.ase_nombre, asistente.ase_apellido FROM asistente";
        $stmt = $this->db_connection->prepare($query);
        $stmt->execute();
        $asistentes = $stmt->fetchAll();

        return $asistentes;
    }

    public function deleteAsistencia($id)
    {
        $query = "DELETE FROM asistencia WHERE asa_id = :id";
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
}
