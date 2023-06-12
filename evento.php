<?php
class Evento
{
    private $db_connection;

    public function __construct()
    {
        include 'database.php';
        $database = new Database();
        $this->db_connection = $database->getConnection();
    }

    public function crearEvento($nombre, $fecha, $ubicacion)
    {
        $query = "INSERT INTO evento (eve_nombre, eve_fecha, ubi_id) VALUES (:nombre, :fecha, :ubicacion)";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":ubicacion", $ubicacion);

        if ($stmt->execute()) {
            echo "<script>
            if (window.confirm('Evento creado exitosamente. ¿Desea volver a la página de eventos?')) {
                window.location.href = 'eventos.php';
            }
            </script>";
        } else {
            echo "<script>alert('Error al crear el evento');</script>";
        }
    }

    public function actualizarEvento($id, $nombre, $fecha, $ubicacion)
    {
        $query = "UPDATE evento SET eve_nombre = :nombre, eve_fecha = :fecha, ubi_id = :ubicacion WHERE eve_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":ubicacion", $ubicacion);

        if ($stmt->execute()) {
            echo "<script>
            if (window.confirm('Evento actualizado exitosamente. ¿Desea volver a la página de eventos?')) {
                window.location.href = 'eventos.php';
            }
            </script>";
        } else {
            echo "<script>alert('Error al actualizar el evento');</script>";
        }
    }

    public function eliminarEvento($id)
    {
        $query = "DELETE FROM evento WHERE eve_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Evento eliminado exitosamente');</script>";
            } else {
                echo "<script>alert('No existe el evento con el ID: " . $id . "');</script>";
            }
        } else {
            echo "<script>alert('Error al eliminar el evento');</script>";
        }
    }

    public function obtenerEvento($id)
    {
        $query = "SELECT evento.eve_nombre, evento.eve_fecha, evento.ubi_id
        FROM evento
        WHERE evento.eve_id = :id"; 
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $evento = $stmt->fetch(PDO::FETCH_ASSOC);

        return $evento;
    }

    public function obtenerEventos()
    {
        $query = "SELECT evento.eve_id, evento.eve_nombre, evento.eve_fecha, ubicacion.ubi_nombre
        FROM evento
        INNER JOIN ubicacion ON evento.ubi_id = ubicacion.ubi_id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->execute();
        $eventos = $stmt->fetchAll();

        return $eventos;
    }

    public function obtenerUbicaciones()
    {
        $query = "SELECT ubicacion.ubi_id, ubicacion.ubi_nombre FROM ubicacion";
        $stmt = $this->db_connection->prepare($query);
        $stmt->execute();
        $ubicaciones = $stmt->fetchAll();

        return $ubicaciones;
    }

    public function asistirEvento($id, $asistente)
    {
        $query = "INSERT INTO asistencia (ase_id, eve_id) VALUES (:asistente, :id)";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":asistente", $asistente);
		$stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            echo "<script>
            if (window.confirm('Asistencia creada exitosamente. ¿Desea volver a la página de eventos?')) {
                window.location.href = 'eventos.php';
            }
            </script>";
        } else {
            echo "<script>alert('Error al crear la asistencia');</script>";
        }
    }

    public function obtenerAsistentesxE($id)
    {
        $query = "SELECT asistencia.asa_id, asistente.ase_nombre, asistente.ase_apellido
		FROM asistencia
		INNER JOIN evento ON evento.eve_id = asistencia.eve_id
		INNER JOIN asistente ON asistente.ase_id = asistencia.ase_id
        WHERE asistencia.eve_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $eventos = $stmt->fetchAll();

        return $eventos;
    }

    public function obtenerAsistentes()
    {
        $query = "SELECT asistente.ase_id, asistente.ase_nombre, asistente.ase_apellido FROM asistente";
        $stmt = $this->db_connection->prepare($query);
        $stmt->execute();
        $asistentes = $stmt->fetchAll();

        return $asistentes;
    }

    public function eliminarAsistencia($id)
    {
        $query = "DELETE FROM asistencia WHERE asa_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Asistencia eliminada exitosamente');</script>";
            } else {
                echo "<script>alert('No existe la asistencia con el ID: " . $id . "');</script>";
            }
        } else {
            echo "<script>alert('Error al eliminar la asistencia');</script>";
        }
    }
}
