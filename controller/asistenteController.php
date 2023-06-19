<?php
require_once '../model/asistente.php';

class Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function index()
    {
        $asistentes = $this->model->getAsistentes();
        include '../view/aseList.php';
    }

    public function createAsistente()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $success = $this->model->createAsistente($nombre, $apellido, $correo);
            if ($success) {
                echo '<script>alert("Asistente agregado exitosamente.");</script>';
            } else {
                echo '<script>alert("Error al agregar el asistente.");</script>';
            }
            echo '<script>setTimeout(function() { window.location.href = "../view/aseIndex.php"; }, 13);</script>';
        } else {
            include '../view/aseCreate.php';
        }
    }

    public function updateAsistente($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $success = $this->model->updateAsistente($id, $nombre, $apellido, $correo);
            if ($success) {
                echo '<script>alert("Asistente actualizado exitosamente.");</script>';
            } else {
                echo '<script>alert("Error al actualizar el asistente.");</script>';
            }
            echo '<script>setTimeout(function() { window.location.href = "../view/aseIndex.php"; }, 13);</script>';
        } else {
            $ase = $this->model->getAsistente($id);
            include '../view/aseUpdate.php';
        }
    }

    public function deleteAsistente($id)
    {
        $success = $this->model->deleteAsistente($id);
        if ($success) {
            echo '<script>alert("Asistente eliminado exitosamente.");</script>';
        } else {
            echo '<script>alert("Error al eliminar el asistente.");</script>';
        }
        echo '<script>setTimeout(function() { window.location.href = "../view/aseIndex.php"; }, 13);</script>';
    }
}
