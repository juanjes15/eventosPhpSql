<?php
class Ubicacion
{
    private $db_connection;

    public function __construct()
    {
        include 'database.php';
        $database = new Database();
        $this->db_connection = $database->getConnection();
    }

    public function crearUbicacion($nombre, $direccion)
    {
        $query = "INSERT INTO ubicacion (ubi_nombre, ubi_direccion) VALUES (:nombre, :direccion)";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":direccion", $direccion);

        if ($stmt->execute()) {
            echo "<script>
            if (window.confirm('Ubicación creada exitosamente. ¿Desea volver a la página de ubicaciones?')) {
                window.location.href = 'ubicaciones.php';
            }
            </script>";
        } else {
            echo "<script>alert('Error al crear la ubicación');</script>";
        }
    }

    public function actualizarUbicacion($id, $nombre, $direccion)
    {
        $query = "UPDATE ubicacion SET ubi_nombre = :nombre, ubi_direccion = :direccion WHERE ubi_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":direccion", $direccion);

        if ($stmt->execute()) {
            echo "<script>
            if (window.confirm('Ubicación actualizada exitosamente. ¿Desea volver a la página de ubicaciones?')) {
                window.location.href = 'ubicaciones.php';
            }
            </script>";
        } else {
            echo "<script>alert('Error al actualizar la ubicación');</script>";
        }
    }

    public function eliminarUbicacion($id)
    {
        $query = "DELETE FROM ubicacion WHERE ubi_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Ubicación eliminada exitosamente');</script>";
            } else {
                echo "<script>alert('No existe la ubicación con el ID: " . $id . "');</script>";
            }
        } else {
            echo "<script>alert('Error al eliminar la ubicación');</script>";
        }
    }

    public function obtenerUbicaciones()
    {
        $query = "SELECT ubicacion.ubi_id, ubicacion.ubi_nombre, ubicacion.ubi_direccion FROM ubicacion";
        $stmt = $this->db_connection->prepare($query);
        $stmt->execute();
        $ubicaciones = $stmt->fetchAll();

        return $ubicaciones;
    }

    public function obtenerUbicacion($id)
    {
        $query = "SELECT ubicacion.ubi_nombre, ubicacion.ubi_direccion FROM ubicacion WHERE ubicacion.ubi_id = :id";
        $stmt = $this->db_connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $ubicacion = $stmt->fetch(PDO::FETCH_ASSOC);

        return $ubicacion;
    }
}
