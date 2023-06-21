<?php
include 'config/database.php';
$database = new Database();
$db_connection = $database->getConnection();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
	$name = $_POST["name"];
	$email = $_POST["email"];
	$password = $_POST["pass"];

	$name = trim($name);
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);
	$password = password_hash($password, PASSWORD_DEFAULT);

	$query = "INSERT INTO usuarios (usu_nombre, usu_correo, usu_contrasena) VALUES (:nombre, :correo, :contrasena)";
	$stmt = $db_connection->prepare($query);
	$stmt->bindParam(":nombre", $name);
	$stmt->bindParam(":correo", $email);
	$stmt->bindParam(":contrasena", $password);

	if ($stmt->execute()) {
		echo "<script>alert('Usuario registrado exitosamente');</script>";
		echo '<script>setTimeout(function() { window.location.href = "index.php"; }, 13);</script>';
	} else {
		echo "<script>alert('Error al registrar el usuario');</script>";
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
	<link rel="stylesheet" href="css/style.css">
	<title>Sistema de Gestion de Asistencia a Eventos</title>
</head>

<body>
	<div class="container">
		<h4 class="h4">Registrarse</h4>
		<form method="POST">
			<input class="form-control" type="text" name="name" placeholder="Nombre completo">
			<input class="form-control" type="email" name="email" placeholder="Correo electrónico">
			<input class="form-control" type="password" name="pass" placeholder="Contraseña">
			<button class="btn btn-info" type="submit" name="submit"><strong>Enviar</strong></button>
			<a href="index.php">Atrás</a>
		</form>
	</div>
</body>

</html>