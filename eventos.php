<?php
include 'database.php';
$database = new Database();
$db_connection = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$nombre = $_POST["nombre"];
	if (isset($_POST["crear"])) {
		$fecha = $_POST["fecha"];
		$ubicacion = $_POST["ubicacion"];

		$query = "INSERT INTO evento (eve_nombre, eve_fecha, ubi_id) VALUES (:nombre, :fecha, :ubicacion)";
		$stmt = $db_connection->prepare($query);
		$stmt->bindParam(":nombre", $nombre);
		$stmt->bindParam(":fecha", $fecha);
		$stmt->bindParam(":ubicacion", $ubicacion);

		if ($stmt->execute()) {
			echo "<script>alert('Evento creado exitosamente');</script>";
		} else {
			echo "<script>alert('Error al crear el evento');</script>";
		}
	} elseif (isset($_POST["buscar"])) {
		$query = "SELECT * FROM evento WHERE eve_nombre = :nombre";
		$stmt = $db_connection->prepare($query);
		$stmt->bindParam(":nombre", $nombre);

		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				echo "<script>alert('Evento encontrado');</script>";
			} else {
				echo "<script>alert('No existe el evento');</script>";
			}
		} else {
			echo "<script>alert('Error al buscar el evento');</script>";
		}
	} elseif (isset($_POST["actualizar"])) {
		$fecha = $_POST["fecha"];
		$ubicacion = $_POST["ubicacion"];

		$query = "UPDATE evento SET eve_nombre = :nombre, eve_fecha = :fecha, ubi_id = :ubicacion WHERE eve_nombre = :nombre";
		$stmt = $db_connection->prepare($query);
		$stmt->bindParam(":nombre", $nombre);
		$stmt->bindParam(":fecha", $fecha);
		$stmt->bindParam(":ubicacion", $ubicacion);

		if ($stmt->execute()) {
			echo "<script>alert('Evento actualizado exitosamente');</script>";
		} else {
			echo "<script>alert('Error al actualizar el evento');</script>";
		}
	} elseif (isset($_POST["eliminar"])) {
		$query = "DELETE FROM evento WHERE eve_nombre = :nombre";
		$stmt = $db_connection->prepare($query);
		$stmt->bindParam(":nombre", $nombre);

		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				echo "<script>alert('Evento eliminado exitosamente');</script>";
			} else {
				echo "<script>alert('No existe el evento');</script>";
			}
		} else {
			echo "<script>alert('Error al eliminar el evento');</script>";
		}
	}
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
			<a class="navbar-brand" href="asistencia.php"><strong>Asistencia</strong></a>
		</div>
	</nav><br>
	<div class="container text-center p-2 rounded-5" style="background-color: #BFD4E4;">
		<div class="row py-3">
			<div class="col">
				<h1 class="h1">Eventos</h1>
			</div>
		</div>
		<div class="row py-3">
			<form method="post">
				<div class="row justify-content-center py-2">
					<div class="col-1">
						<label for="nombre" class="col-form-label">Nombre:</label>
					</div>
					<div class="col-4">
						<input type="text" id="nombre" name="nombre" class="form-control">
					</div>
				</div>
				<div class="row justify-content-center py-2">
					<div class="col-1">
						<label for="fecha" class="col-form-label">Fecha:</label>
					</div>
					<div class="col-4">
						<input type="date" id="fecha" name="fecha" class="form-control">
					</div>
				</div>
				<div class="row justify-content-center py-2">
					<div class="col-1">
						<label for="ubicacion" class="col-form-label">Ubicación:</label>
					</div>
					<div class="col-4">
						<select class="form-select" id="ubicacion" name="ubicacion">
							<option selected>Seleccione una ubicación</option>
							<?php
							$query = "SELECT ubi_id, ubi_nombre FROM ubicacion";
							$stmt = $db_connection->prepare($query);
							$stmt->execute();
							$ubicaciones = $stmt->fetchAll();
							foreach ($ubicaciones as $ubicacion) { ?>
								<option value="<?php echo $ubicacion['ubi_id']; ?>"><?php echo $ubicacion['ubi_nombre']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<input type="hidden" name="id" value="1">
				<div class="row justify-content-center py-2">
					<div class="col-2">
						<button type="submit" name="crear" class="btn btn-info">Crear</button>
					</div>
					<div class="col-2">
						<button type="submit" name="buscar" class="btn btn-info">Buscar</button>
					</div>
					<div class="col-2">
						<button type="submit" name="actualizar" class="btn btn-info">Actualizar</button>
					</div>
					<div class="col-2">
						<button type="submit" name="eliminar" class="btn btn-info">Eliminar</button>
					</div>
				</div>
			</form>
		</div>
		<div class="row justify-content-center py-3">
			<div class="col-8">
				<table class="table table-light table-sm table-hover table-bordered">
					<thead class="table-primary">
						<tr>
							<th scope="col">Nombre</th>
							<th scope="col">Fecha</th>
							<th scope="col">Ubicacion</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT evento.eve_nombre, evento.eve_fecha, ubicacion.ubi_nombre
                                  FROM evento
                                  INNER JOIN ubicacion ON evento.ubi_id = ubicacion.ubi_id";
						$stmt = $db_connection->prepare($query);
						$stmt->execute();
						$eventos = $stmt->fetchAll();

						foreach ($eventos as $evento) { ?>
							<tr>
								<td><?php echo $evento['eve_nombre']; ?></td>
								<td><?php echo $evento['eve_fecha']; ?></td>
								<td><?php echo $evento['ubi_nombre']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

</html>