<?php
class Asistente
{
    private $db_connection;

    public function __construct()
    {
        include 'database.php';
        $database = new Database();
        $this->db_connection = $database->getConnection();
    }

    public function crearAsistente($nombre, $apellido, $correo)
    {
        $query = "INSERT INTO asistente (ase_nombre, ase_apellido, ase_correo) VALUES (:nombre, :apellido, :correo)";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":apellido", $apellido);
        $stmt->bindParam(":correo", $correo);

        if ($stmt->execute()) {
            echo "<script>
            if (window.confirm('Asistente creado exitosamente. ¿Desea volver a la página de asistentes?')) {
                window.location.href = 'asistentes.php';
            }
            </script>";
        } else {
            echo "<script>alert('Error al crear el asistente');</script>";
        }
    }

    public function actualizarAsistente($id, $nombre, $apellido, $correo)
    {
        $query = "UPDATE asistente SET ase_nombre = :nombre, ase_apellido = :apellido, ase_correo = :correo WHERE ase_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":apellido", $apellido);
        $stmt->bindParam(":correo", $correo);

        if ($stmt->execute()) {
            echo "<script>
            if (window.confirm('Asistente actualizado exitosamente. ¿Desea volver a la página de asistentes?')) {
                window.location.href = 'asistentes.php';
            }
            </script>";
        } else {
            echo "<script>alert('Error al actualizar el asistente');</script>";
        }
    }

    public function eliminarAsistente($id)
    {
        $query = "DELETE FROM asistente WHERE ase_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Asistente eliminado exitosamente');</script>";
            } else {
                echo "<script>alert('No existe el asistente con el ID: " . $id . "');</script>";
            }
        } else {
            echo "<script>alert('Error al eliminar el asistente');</script>";
        }
    }

    public function obtenerAsistentes()
    {
        $query = "SELECT asistente.ase_id, asistente.ase_nombre, asistente.ase_apellido, asistente.ase_correo FROM asistente";
        $stmt = $this->db_connection->prepare($query);
        $stmt->execute();
        $asistentes = $stmt->fetchAll();

        return $asistentes;
    }

    public function obtenerAsistente($id)
    {
        $query = "SELECT asistente.ase_nombre, asistente.ase_apellido, asistente.ase_correo FROM asistente WHERE asistente.ase_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $asistente = $stmt->fetch(PDO::FETCH_ASSOC);

        return $asistente;
    }
}
