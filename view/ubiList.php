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
			<a class="navbar-brand" href="ubiIndex.php"><strong>Ubicaciones</strong></a>
			<a class="navbar-brand" href="asistentes.php"><strong>Asistentes</strong></a>
		</div>
	</nav><br>
	<div class="container text-center p-2 rounded-5" style="background-color: #BFD4E4;">
		<div class="row py-3">
			<div class="col">
				<h1 class="h1">Ubicaciones</h1>
			</div>
		</div>
		<div class="row py-2">
			<div class="col-4">
				<a href="ubiIndex.php?action=createUbicacion" class="btn btn-success">Nueva ubicación</a>
			</div>
		</div>
		<div class="row justify-content-center py-3">
			<div class="col-10">
				<table class="table">
					<thead>
						<tr class="text-start">
							<th scope="col">Nombre</th>
							<th scope="col">Dirección</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($ubicaciones as $ubi) { ?>
							<tr>
								<td class="text-start"><?php echo $ubi['ubi_nombre']; ?></td>
								<td class="text-start"><?php echo $ubi['ubi_direccion']; ?></td>
								<td class="text-end">
									<div class="d-flex justify-content-end">
										<a title="Editar" href="ubiIndex.php?id=<?php echo $ubi['ubi_id']; ?>&action=updateUbicacion" class="btn btn-warning me-2"><i class="bi bi-pencil-square"></i></a>
										<a title="Eliminar" href="ubiIndex.php?id=<?php echo $ubi['ubi_id']; ?>&action=deleteUbicacion" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar <?php echo $ubi['ubi_nombre']; ?>?')"><i class="bi bi-trash3"></i></a>
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