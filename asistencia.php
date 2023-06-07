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
            <a class="navbar-brand" href="asistencia.php"><strong>Asistencia</strong></a>
        </div>
    </nav><br>
    <div class="container text-center p-2 rounded-5" style="background-color: #BFD4E4;">
        <div class="row py-3">
            <div class="col">
                <h1 class="h1">Asistencia</h1>
            </div>
        </div>
        <div class="row py-3">
            <form method="post">
                <div class="row justify-content-center py-2">
                    <div class="col-1">
                        <label for="asistentes" class="col-form-label">Asistentes:</label>
                    </div>
                    <div class="col-4">
                        <select class="form-select" id="asistentes">
                            <option selected>Asistentes</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center py-2">
                    <div class="col-1">
                        <label for="eventos" class="col-form-label">Eventos:</label>
                    </div>
                    <div class="col-4">
                        <select class="form-select" id="eventos">
                            <option selected>Eventos</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center py-2">
                    <div class="col-2">
                        <button type="submit" class="btn btn-info">Asistir</button>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-info">Buscar</button>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-info">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row justify-content-center py-3">
            <div class="col-8">
                <table class="table table-light table-sm table-hover table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Asistente</th>
                            <th scope="col">Evento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mark</td>
                            <td>Otto</td>
                        </tr>
                        <tr>
                            <td>Jacob</td>
                            <td>Thornton</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>