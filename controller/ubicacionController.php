<?php
require_once '../model/ubicacion.php';

class Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function index()
    {
        $ubicaciones = $this->model->getUbicaciones();
        include '../view/ubicacion/ubiList.php';
    }

    public function createUbicacion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $success = $this->model->createUbicacion($nombre, $direccion);
            if ($success) {
                echo '<script>alert("Ubicación agregada exitosamente.");</script>';
            } else {
                echo '<script>alert("Error al agregar la ubicación.");</script>';
            }
            echo '<script>setTimeout(function() { window.location.href = "../view/ubicacion/ubiIndex.php"; }, 13);</script>';
        } else {
            include '../view/ubicacion/ubiCreate.php';
        }
    }

    public function updateUbicacion($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $success = $this->model->updateUbicacion($id, $nombre, $direccion);
            if ($success) {
                echo '<script>alert("Ubicación actualizada exitosamente.");</script>';
            } else {
                echo '<script>alert("Error al actualizar la ubicación.");</script>';
            }
            echo '<script>setTimeout(function() { window.location.href = "../view/ubicacion/ubiIndex.php"; }, 13);</script>';
        } else {
            $ubi = $this->model->getUbicacion($id);
            include '../view/ubicacion/ubiUpdate.php';
        }
    }

    public function deleteUbicacion($id)
    {
        $success = $this->model->deleteUbicacion($id);
        if ($success) {
            echo '<script>alert("Ubicación eliminada exitosamente.");</script>';
        } else {
            echo '<script>alert("Error al eliminar la ubicación.");</script>';
        }
        echo '<script>setTimeout(function() { window.location.href = "../view/ubicacion/ubiIndex.php"; }, 13);</script>';
    }
}
