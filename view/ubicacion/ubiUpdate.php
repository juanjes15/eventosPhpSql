<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
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
                        <a class="nav-link active" aria-current="page" href="../evento/eveIndex.php">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="ubiIndex.php">Ubicaciones</a>
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
                <h1 class="h2">Actualizar Ubicación</h1>
            </div>
        </div>
        <div class="row py-3">
            <form method="POST" action="ubiIndex.php?id=<?php echo $ubi['ubi_id'] ?>&action=updateUbicacion">
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
                        <button type="submit" class="btn btn-warning">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>