<?php
include 'database.php';
$database = new Database();
$db_connection = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["asistir"])) {
		$asistente = $_POST["asistente"];
		$evento = $_POST["evento"];

		$query = "INSERT INTO asistencia (ase_id, eve_id) VALUES (:asistente, :evento)";
		$stmt = $db_connection->prepare($query);
		$stmt->bindParam(":asistente", $asistente);
		$stmt->bindParam(":evento", $evento);

		if ($stmt->execute()) {
			echo "<script>alert('Asistencia creada exitosamente');</script>";
		} else {
			echo "<script>alert('Error al crear la asistencia');</script>";
		}
	} elseif (isset($_POST["eliminar"])) {
		$asistente = $_POST["asistente"];
		$evento = $_POST["evento"];
		$query = "DELETE FROM asistencia WHERE ase_id = :asistente and eve_id = :evento";
		$stmt = $db_connection->prepare($query);
		$stmt->bindParam(":asistente", $asistente);
		$stmt->bindParam(":evento", $evento);

		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				echo "<script>alert('Asistencia eliminada exitosamente');</script>";
			} else {
				echo "<script>alert('No existe la asistencia');</script>";
			}
		} else {
			echo "<script>alert('Error al eliminar la asistencia');</script>";
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
			<a class="navbar-brand" href="asistencias.php"><strong>Asistencias</strong></a>
		</div>
	</nav><br>
	<div class="container text-center p-2 rounded-5" style="background-color: #BFD4E4;">
		<div class="row py-3">
			<div class="col">
				<h1 class="h1">Asistencias</h1>
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
							$query = "SELECT ase_id, ase_nombre FROM asistente";
							$stmt = $db_connection->prepare($query);
							$stmt->execute();
							$asistentes = $stmt->fetchAll();
							foreach ($asistentes as $asistente) { ?>
								<option value="<?php echo $asistente['ase_id']; ?>"><?php echo $asistente['ase_nombre']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="row justify-content-center py-2">
					<div class="col-1">
						<label for="evento" class="col-form-label">Evento:</label>
					</div>
					<div class="col-4">
						<select class="form-select" id="evento" name="evento">
							<option selected>Seleccione un evento</option>
							<?php
							$query = "SELECT eve_id, eve_nombre FROM evento";
							$stmt = $db_connection->prepare($query);
							$stmt->execute();
							$eventos = $stmt->fetchAll();
							foreach ($eventos as $evento) { ?>
								<option value="<?php echo $evento['eve_id']; ?>"><?php echo $evento['eve_nombre']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="row justify-content-center py-2">
					<div class="col-2">
						<button type="submit" name="asistir" class="btn btn-info">Asistir</button>
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
							<th scope="col">Asistente</th>
							<th scope="col">Evento</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT asistente.ase_nombre, evento.eve_nombre 
						FROM asistencia
						INNER JOIN evento ON evento.eve_id = asistencia.eve_id 
						INNER JOIN asistente ON asistente.ase_id = asistencia.ase_id
						ORDER BY asistencia.asa_id ASC";
						$stmt = $db_connection->prepare($query);
						$stmt->execute();
						$asistencias = $stmt->fetchAll();

						foreach ($asistencias as $asistencia) { ?>
							<tr>
								<td><?php echo $asistencia['ase_nombre']; ?></td>
								<td><?php echo $asistencia['eve_nombre']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

</html>