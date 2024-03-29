<?php

$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);
require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/model/asistente.php';

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
        global $rutaProyecto;
        include $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/view/asistente/aseList.php';
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
            echo '<script>setTimeout(function() { window.location.href = "aseIndex.php"; }, 13);</script>';
        } else {
            global $rutaProyecto;
            include $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/view/asistente/aseCreate.php';
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
            echo '<script>setTimeout(function() { window.location.href = "aseIndex.php"; }, 13);</script>';
        } else {
            $ase = $this->model->getAsistente($id);
            global $rutaProyecto;
            include $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/view/asistente/aseUpdate.php';
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
        echo '<script>setTimeout(function() { window.location.href = "aseIndex.php"; }, 13);</script>';
    }

    public function searchAsistente($search)
    {
        $result = $this->model->getSearch($search);
        if ($result == false) {
            echo '<script>alert("Asistente no encontrado.");</script>';
            $asistentes = $this->model->getAsistentes();
        } else {
            $asistentes = $result;
        }
        global $rutaProyecto;
        include $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/view/asistente/aseList.php';
    }
}
