<?php
include 'core/database.php';
$database = new Database();
$db_connection = $database->getConnection();

session_start(); // Iniciar sesión

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
	$email = $_POST["email"];
	$password = $_POST["pass"];

	$email = filter_var($email, FILTER_VALIDATE_EMAIL);

	// Consultar el usuario en la base de datos
	$query = "SELECT * FROM usuarios WHERE usu_correo = :correo";
	$stmt = $db_connection->prepare($query);
	$stmt->bindParam(":correo", $email);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		$row = $stmt->fetch();
		$stored_password = $row['usu_contrasena'];

		// Verificar la contraseña
		if (password_verify($password, $stored_password)) {
			// Inicio de sesión exitoso
			$_SESSION['user_id'] = $row['usu_id'];
			$_SESSION['user_name'] = $row['usu_nombre'];

			// Redireccionar a la página de inicio o a otra página de tu elección
			header("Location: view/home.php");
			exit;
		} else {
			// Contraseña incorrecta
			$error_message = "Contraseña incorrecta. Intenta nuevamente.";
		}
	} else {
		// Usuario no encontrado
		$error_message = "El correo electrónico ingresado no está registrado.";
	}
	echo "<script>alert('$error_message');</script>";
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
		<h4 class="h4">Iniciar sesión</h4>
		<form method="post">
			<input class="form-control" type="email" name="email" placeholder="Correo electrónico">
			<input class="form-control" type="password" name="pass" placeholder="Contraseña">
			<button class="btn btn-info" type="submit" name="submit"><strong>Enviar</strong></button>
			<a href="core/registrarse.php">Registrarse</a>
		</form>
	</div>
</body>

</html>