<?php
include 'evento.php';
$evento = new Evento();

if (isset($_GET["id"])) {
	$evento->eliminarEvento($_GET["id"]);
}
$eventos = $evento->obtenerEventos();
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
				<h1 class="h1">Eventos</h1>
			</div>
		</div>
		<div class="row py-2">
			<div class="col-4">
				<a href="eventoC.php" class="btn btn-success">Nuevo evento</a>
			</div>
		</div>

		<div class="row justify-content-center py-3">
			<div class="col-10">
				<table class="table">
					<thead>
						<tr class="text-start">
							<th scope="col">Nombre</th>
							<th scope="col">Fecha</th>
							<th scope="col">Ubicacion</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($eventos as $eve) { ?>
							<tr>
								<td class="text-start"><?php echo $eve['eve_nombre']; ?></td>
								<td class="text-start"><?php echo $eve['eve_fecha']; ?></td>
								<td class="text-start"><?php echo $eve['ubi_nombre']; ?></td>
								<td class="text-end">
									<div class="d-flex justify-content-end">
										<a title="Gestionar asistencias" href="eventoP.php?id=<?php echo $eve['eve_id']; ?>" class="btn btn-primary me-2"><i class="bi bi-person-vcard"></i></a>
										<a title="Editar" href="eventoA.php?id=<?php echo $eve['eve_id']; ?>" class="btn btn-warning me-2"><i class="bi bi-pencil-square"></i></a>
										<a title="Eliminar" href="eventos.php?id=<?php echo $eve['eve_id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar <?php echo $eve['eve_nombre']; ?>?')"><i class="bi bi-trash3"></i></a>
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