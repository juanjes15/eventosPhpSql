<?php
include 'ubicacion.php';
$ubicacion = new Ubicacion();
$id = $_GET["id"];
$ubi = $ubicacion->obtenerUbicacion($id);
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["actualizar"])) {
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $ubicacion->actualizarUbicacion($id, $nombre, $direccion);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Sistema de Gestion de Asistencia a Eventos</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #0998ff8a;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><strong>Inicio</strong></a>
            <a class="navbar-brand" href="eventos.php"><strong>Eventos</strong></a>
            <a class="navbar-brand" href="ubicaciones.php"><strong>Ubicaciones</strong></a>
            <a class="navbar-brand" href="asistentes.php"><strong>Asistentes</strong></a>
            <a class="navbar-brand" href="asistencias.php"><strong>Asistencias</strong></a>
        </div>
    </nav><br>
    <div class="container text-center p-2 rounded-5" style="background-color: #BFD4E4;">
        <div class="row py-3">
            <div class="col">
                <h1 class="h1">Actualizar Ubicación</h1>
            </div>
        </div>
        <div class="row py-3">
            <form method="post">
                <div class="row justify-content-center py-2">
                    <div class="col-1">
                        <label for="nombre" class="col-form-label">Nombre:</label>
                    </div>
                    <div class="col-4">
                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $ubi['ubi_nombre']; ?>">
                    </div>
                </div>
                <div class="row justify-content-center py-2">
                    <div class="col-1">
                        <label for="direccion" class="col-form-label">Dirección:</label>
                    </div>
                    <div class="col-4">
                        <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo $ubi['ubi_direccion']; ?>">
                    </div>
                </div>
                <div class="row justify-content-center py-2">
                    <div class="col-2">
                        <button type="submit" name="actualizar" class="btn btn-warning">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>