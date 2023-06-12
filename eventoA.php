<?php
include 'evento.php';
$evento = new Evento();
$id = $_GET["id"];
$eve = $evento->obtenerEvento($id);
$ubicaciones = $evento->obtenerUbicaciones();
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["actualizar"])) {
    $nombre = $_POST["nombre"];
    $fecha = $_POST["fecha"];
    $ubicacion = $_POST["ubicacion"];
    $evento->actualizarEvento($id, $nombre, $fecha, $ubicacion);
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
        </div>
    </nav><br>
    <div class="container text-center p-2 rounded-5" style="background-color: #BFD4E4;">
        <div class="row py-3">
            <div class="col">
                <h1 class="h1">Actualizar Evento</h1>
            </div>
        </div>
        <div class="row py-3">
            <form method="post">
                <div class="row justify-content-center py-2">
                    <div class="col-1">
                        <label for="nombre" class="col-form-label">Nombre:</label>
                    </div>
                    <div class="col-4">
                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $eve['eve_nombre']; ?>">
                    </div>
                </div>
                <div class="row justify-content-center py-2">
                    <div class="col-1">
                        <label for="fecha" class="col-form-label">Fecha:</label>
                    </div>
                    <div class="col-4">
                        <input type="date" id="fecha" name="fecha" class="form-control" value="<?php echo $eve['eve_fecha']; ?>">
                    </div>
                </div>
                <div class="row justify-content-center py-2">
                    <div class="col-1">
                        <label for="ubicacion" class="col-form-label">Ubicación:</label>
                    </div>
                    <div class="col-4">
                        <select class="form-select" id="ubicacion" name="ubicacion">
                            <?php
                            foreach ($ubicaciones as $ubicacion) { ?>
                                <option <?php if ($eve['ubi_id'] == $ubicacion['ubi_id']) {
                                            echo 'selected';
                                        } ?> value="<?php echo $ubicacion['ubi_id']; ?>"><?php echo $ubicacion['ubi_nombre']; ?></option>
                            <?php } ?>
                        </select>
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