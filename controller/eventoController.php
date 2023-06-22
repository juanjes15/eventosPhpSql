<?php
require_once '../model/evento.php';

class Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function index()
    {
        $eventos = $this->model->getEventos();
        include '../view/eveList.php';
    }

    public function createEvento()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST["nombre"];
            $fecha = $_POST["fecha"];
            $ubicacion = $_POST["ubicacion"];
            $success = $this->model->createEvento($nombre, $fecha, $ubicacion);
            if ($success) {
                echo '<script>alert("Evento agregado exitosamente.");</script>';
            } else {
                echo '<script>alert("Error al agregar el evento.");</script>';
            }
            echo '<script>setTimeout(function() { window.location.href = "../view/eveIndex.php"; }, 13);</script>';
        } else {
            $ubicaciones = $this->model->getUbicaciones();
            include '../view/eveCreate.php';
        }
    }

    public function updateEvento($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $fecha = $_POST["fecha"];
            $ubicacion = $_POST["ubicacion"];
            $success = $this->model->updateEvento($id, $nombre, $fecha, $ubicacion);
            if ($success) {
                echo '<script>alert("Evento actualizado exitosamente.");</script>';
            } else {
                echo '<script>alert("Error al actualizar el evento.");</script>';
            }
            echo '<script>setTimeout(function() { window.location.href = "../view/eveIndex.php"; }, 13);</script>';
        } else {
            $eve = $this->model->getEvento($id);
            $ubicaciones = $this->model->getUbicaciones();
            include '../view/eveUpdate.php';
        }
    }

    public function deleteEvento($id)
    {
        $success = $this->model->deleteEvento($id);
        if ($success) {
            echo '<script>alert("Evento eliminado exitosamente.");</script>';
        } else {
            echo '<script>alert("Error al eliminar el evento.");</script>';
        }
        echo '<script>setTimeout(function() { window.location.href = "../view/eveIndex.php"; }, 13);</script>';
    }

    public function searchEvento($search)
    {
        $result = $this->model->getSearch($search);
        if ($result == false) {
            echo '<script>alert("Evento no encontrado.");</script>';
            $eventos = $this->model->getEventos();
            include '../view/eveList.php';
        } else {
            $eventos = $result;
            include '../view/eveList.php';
        }
    }

    public function eveAsa($id)
    {
        $eve = $this->model->getEvento($id);
        $asistentes = $this->model->getAsistentes();
        $asistentesxe = $this->model->getAsistentesxE($id);
        include '../view/eveAsa.php';
    }

    public function createAsistencia($id)
    {
        $asistente = $_POST["asistente"];
        $success = $this->model->createAsistencia($id, $asistente);
        if ($success) {
            echo '<script>alert("Asistencia agregada exitosamente.");</script>';
        } else {
            echo '<script>alert("Error al agregar la asistencia.");</script>';
        }
        echo '<script>setTimeout(function() { window.location.href = "../view/eveIndex.php?id=' . $id . '&action=eveAsa"; }, 13);</script>';
    }

    public function deleteAsistencia($idA, $id)
    {
        $success = $this->model->deleteAsistencia($idA);
        if ($success) {
            echo '<script>alert("Asistencia eliminada exitosamente.");</script>';
        } else {
            echo '<script>alert("Error al eliminar la asistencia.");</script>';
        }
        echo '<script>setTimeout(function() { window.location.href = "../view/eveIndex.php?id=' . $id . '&action=eveAsa"; }, 13);</script>';
    }
}
