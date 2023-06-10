<?php
include 'database.php';
$database = new Database();
$db_connection = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$nombre = $_POST["nombre"];
	if (isset($_POST["crear"])) {
		$direccion = $_POST["direccion"];

		$query = "INSERT INTO ubicacion (ubi_nombre, ubi_direccion) VALUES (:nombre, :direccion)";
		$stmt = $db_connection->prepare($query);
		$stmt->bindParam(":nombre", $nombre);
		$stmt->bindParam(":direccion", $direccion);

		if ($stmt->execute()) {
			echo "<script>alert('Ubicación creada exitosamente');</script>";
		} else {
			echo "<script>alert('Error al crear la ubicación');</script>";
		}
	} elseif (isset($_POST["actualizar"])) {
		$direccion = $_POST["direccion"];

		$query = "UPDATE ubicacion SET ubi_nombre = :nombre, ubi_direccion = :direccion WHERE ubi_nombre = :nombre";
		$stmt = $db_connection->prepare($query);
		$stmt->bindParam(":nombre", $nombre);
		$stmt->bindParam(":direccion", $direccion);

		if ($stmt->execute()) {
			echo "<script>alert('Ubicación actualizada exitosamente');</script>";
		} else {
			echo "<script>alert('Error al actualizar la ubicación');</script>";
		}
	} elseif (isset($_POST["eliminar"])) {
		$query = "DELETE FROM ubicacion WHERE ubi_nombre = :nombre";
		$stmt = $db_connection->prepare($query);
		$stmt->bindParam(":nombre", $nombre);

		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				echo "<script>alert('Ubicación eliminada exitosamente');</script>";
			} else {
				echo "<script>alert('No existe la ubicación');</script>";
			}
		} else {
			echo "<script>alert('Error al eliminar la ubicación');</script>";
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
				<h1 class="h1">Ubicaciones</h1>
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
						<label for="direccion" class="col-form-label">Dirección:</label>
					</div>
					<div class="col-4">
						<input type="text" id="direccion" name="direccion" class="form-control">
					</div>
				</div>
				<div class="row justify-content-center py-2">
					<div class="col-2">
						<button type="submit" name="crear" class="btn btn-info">Crear</button>
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
							<th scope="col">Dirección</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT ubicacion.ubi_nombre, ubicacion.ubi_direccion
                                  FROM ubicacion";
						$stmt = $db_connection->prepare($query);
						$stmt->execute();
						$ubicaciones = $stmt->fetchAll();

						foreach ($ubicaciones as $ubicacion) { ?>
							<tr>
								<td><?php echo $ubicacion['ubi_nombre']; ?></td>
								<td><?php echo $ubicacion['ubi_direccion']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

</html>