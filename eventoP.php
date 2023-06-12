<?php
include 'evento.php';
$evento = new Evento();
$id = $_GET["id"];
if (isset($_GET["idA"])) {
    $idA = $_GET["idA"];
    $evento->eliminarAsistencia($idA);
    header("Location: eventoP.php?id=$id");
	exit;
}
$eve = $evento->obtenerEvento($id);
$asistentes = $evento->obtenerAsistentes();
$asistentesxe = $evento->obtenerAsistentesxE($id);
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["asistir"])) {
    $asistente = $_POST["asistente"];
    $evento->asistirEvento($id, $asistente);
    header("Refresh:0");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
                <h1 class="h1">Asistencia <?php echo $eve['eve_nombre']; ?></h1>
            </div>
        </div>
        <div class="row py-3">
            <form method="post">
                <div class="row justify-content-center py-2">
                    <div class="col-1">
                        <label for="asistente" class="col-form-label">Asistente:</label>
                    </div>
                    <div class="col-4">
                        <select class="form-select" id="asistente" name="asistente">
                            <option selected>Seleccione un asistente</option>
                            <?php
                            foreach ($asistentes as $ase) { ?>
                                <option value="<?php echo $ase['ase_id']; ?>"><?php echo $ase['ase_nombre'] . ' ' . $ase['ase_apellido']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center py-2">
                    <div class="col-2">
                        <button type="submit" name="asistir" class="btn btn-primary">Asistir</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row justify-content-center py-3">
            <div class="col-10">
                <table class="table">
                    <thead>
                        <tr class="text-start">
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($asistentesxe as $asexe) { ?>
                            <tr>
                                <td class="text-start"><?php echo $asexe['ase_nombre']; ?></td>
                                <td class="text-start"><?php echo $asexe['ase_apellido']; ?></td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end">
                                        <a title="Eliminar" href="eventoP.php?id=<?php echo $id; ?>&idA=<?php echo $asexe['asa_id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar <?php echo $asexe['ase_nombre'] . ' ' . $asexe['ase_apellido']; ?>?')"><i class="bi bi-trash3"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>