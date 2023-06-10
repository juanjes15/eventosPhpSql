<?php
include 'database.php';
$database = new Database();
$db_connection = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$nombre = $_POST["nombre"];
	if (isset($_POST["crear"])) {
		$apellido = $_POST["apellido"];
		$correo = $_POST["correo"];

		$query = "INSERT INTO asistente (ase_nombre, ase_apellido, ase_correo) VALUES (:nombre, :apellido, :correo)";
		$stmt = $db_connection->prepare($query);
		$stmt->bindParam(":nombre", $nombre);
		$stmt->bindParam(":apellido", $apellido);
		$stmt->bindParam(":correo", $correo);

		if ($stmt->execute()) {
			echo "<script>alert('Asistente creado exitosamente');</script>";
		} else {
			echo "<script>alert('Error al crear el asistente');</script>";
		}
	} elseif (isset($_POST["actualizar"])) {
		$apellido = $_POST["apellido"];
		$correo = $_POST["correo"];

		$query = "UPDATE asistente SET ase_nombre = :nombre, ase_apellido = :apellido, ase_correo = :correo WHERE ase_nombre = :nombre";
		$stmt = $db_connection->prepare($query);
		$stmt->bindParam(":nombre", $nombre);
		$stmt->bindParam(":apellido", $apellido);
		$stmt->bindParam(":correo", $correo);

		if ($stmt->execute()) {
			echo "<script>alert('Asistente actualizado exitosamente');</script>";
		} else {
			echo "<script>alert('Error al actualizar el asistente');</script>";
		}
	} elseif (isset($_POST["eliminar"])) {
		$query = "DELETE FROM asistente WHERE ase_nombre = :nombre";
		$stmt = $db_connection->prepare($query);
		$stmt->bindParam(":nombre", $nombre);

		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				echo "<script>alert('Asistente eliminado exitosamente');</script>";
			} else {
				echo "<script>alert('No existe el asistente');</script>";
			}
		} else {
			echo "<script>alert('Error al eliminar el asistente');</script>";
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
				<h1 class="h1">Asistentes</h1>
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
						<label for="apellido" class="col-form-label">Apellido:</label>
					</div>
					<div class="col-4">
						<input type="text" id="apellido" name="apellido" class="form-control">
					</div>
				</div>
				<div class="row justify-content-center py-2">
					<div class="col-1">
						<label for="correo" class="col-form-label">Correo:</label>
					</div>
					<div class="col-4">
						<input type="email" id="correo" name="correo" class="form-control">
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
							<th scope="col">Apellido</th>
							<th scope="col">Correo</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT asistente.ase_nombre, asistente.ase_apellido, asistente.ase_correo
                                  FROM asistente";
						$stmt = $db_connection->prepare($query);
						$stmt->execute();
						$asistentes = $stmt->fetchAll();

						foreach ($asistentes as $asistente) { ?>
							<tr>
								<td><?php echo $asistente['ase_nombre']; ?></td>
								<td><?php echo $asistente['ase_apellido']; ?></td>
								<td><?php echo $asistente['ase_correo']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

</html>