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

<body style="background-color: #F7FFE5;">
    <nav class="navbar navbar-expand-lg" style="background-color: #A0C49D;">
        <div class="container-fluid">
            <a class="navbar-brand" href="../home.php">SGAE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="eveIndex.php">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../ubicacion/ubiIndex.php">Ubicaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../asistente/aseIndex.php">Asistentes</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav><br>
    <div class="container text-center p-4" style="background-color: #E1ECC8;">
        <div class="row py-3">
            <div class="col">
                <h1 class="h2">Asistencia <?php echo $eve['eve_nombre']; ?></h2>
            </div>
        </div>
        <div class="row py-3">
            <form method="POST" action="eveIndex.php?id=<?php echo $eve['eve_id'] ?>&action=createAsistencia">
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
                        <button type="submit" class="btn btn-primary">Asistir</button>
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
                                        <a title="Eliminar" href="eveIndex.php?id=<?php echo $eve['eve_id']; ?>&idA=<?php echo $asexe['asa_id']; ?>&action=deleteAsistencia" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar <?php echo $asexe['ase_nombre'] . ' ' . $asexe['ase_apellido']; ?>?')"><i class="bi bi-trash3"></i></a>
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