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
				<h1 class="h1">Eventos</h1>
			</div>
		</div>
		<div class="row py-2">
			<div class="col-4">
				<a href="eveIndex.php?action=createEvento" class="btn btn-success">Nuevo evento</a>
			</div>
			<div class="col-6">
				<form action="eveIndex.php" method="GET" class="row align-items-center">
					<div class="col-auto">
						<label for="search" class="col-form-label">Buscar:</label>
					</div>
					<div class="col">
						<input type="text" id="search" name="search" class="form-control">
					</div>
					<div class="col-auto">
						<button type="submit" class="btn btn-info">Buscar</button>
					</div>
				</form>
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
										<a title="Gestionar asistencias" href="eveIndex.php?id=<?php echo $eve['eve_id']; ?>&action=eveAsa" class="btn btn-primary me-2"><i class="bi bi-person-vcard"></i></a>
										<a title="Editar" href="eveIndex.php?id=<?php echo $eve['eve_id']; ?>&action=updateEvento" class="btn btn-warning me-2"><i class="bi bi-pencil-square"></i></a>
										<a title="Eliminar" href="eveIndex.php?id=<?php echo $eve['eve_id']; ?>&action=deleteEvento" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar <?php echo $eve['eve_nombre']; ?>?')"><i class="bi bi-trash3"></i></a>
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