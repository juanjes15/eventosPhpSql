<?php
require_once '../../controller/eventoController.php';

$controller = new Controller();

if (isset($_GET['idA'])) {
    $idA = $_GET['idA'];
    $id = $_GET['id'];
    $action = $_GET['action'];
    $controller->$action($idA, $id);
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    $controller->$action($id);
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
    $controller->$action();
} elseif (isset($_GET['search'])) {
    $search = $_GET['search'];
    $controller->searchEvento($search);
} else {
    $controller->index();
}
