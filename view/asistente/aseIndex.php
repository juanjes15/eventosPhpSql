<?php
require_once '../controller/asistenteController.php';

$controller = new Controller();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    $controller->$action($id);
} elseif (isset($_GET['action'])){
    $action = $_GET['action'];
    $controller->$action();
} else {
    $controller->index();
}