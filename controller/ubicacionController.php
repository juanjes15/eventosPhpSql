<?php

$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);
require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/model/ubicacion.php';

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
        global $rutaProyecto;
        include $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/view/ubicacion/ubiList.php';
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
            echo '<script>setTimeout(function() { window.location.href = "ubiIndex.php"; }, 13);</script>';
        } else {
            global $rutaProyecto;
            include $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/view/ubicacion/ubiCreate.php';
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
            echo '<script>setTimeout(function() { window.location.href = "ubiIndex.php"; }, 13);</script>';
        } else {
            $ubi = $this->model->getUbicacion($id);
            global $rutaProyecto;
            include $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/view/ubicacion/ubiUpdate.php';
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
        echo '<script>setTimeout(function() { window.location.href = "ubiIndex.php"; }, 13);</script>';
    }

    public function searchUbicacion($search)
    {
        $result = $this->model->getSearch($search);
        if ($result == false) {
            echo '<script>alert("Ubicación no encontrada.");</script>';
            $ubicaciones = $this->model->getUbicaciones();
        } else {
            $ubicaciones = $result;
        }
        global $rutaProyecto;
        include $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/view/ubicacion/ubiList.php';
    }
}
