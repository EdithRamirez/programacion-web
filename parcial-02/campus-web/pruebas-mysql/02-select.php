<?php

	require_once __DIR__ . "/../config/conexion.php";

	/*
		SELECT * recupera todos los campos.
		SELECT id, nombre, correo, rol → recupera solo los campos que indiques.
	*/

	// $sql = "SELECT id, nombre, correo, rol
    //     FROM usuarios";
	
	$sql = "SELECT * FROM usuarios";

	$resultado = mysqli_query($conexion, $sql);


	// $usuario = mysqli_fetch_assoc($resultado);

	// echo $usuario["nombre"];
	// echo $usuario["correo"];

	// while ($usuario = mysqli_fetch_assoc($resultado)) {
	// 	echo $usuario["nombre"];
	// 	echo $usuario["correo"];
	// }

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>SELECT con PHP</title>
	</head>

	<body>
		<h1>Usuarios registrados</h1>
		<?php while ($usuario = mysqli_fetch_assoc($resultado)) { ?>
			<p>
				<strong>ID:</strong>
				<?php echo $usuario["id"]; ?>
			</p>
			<p>
				<strong>Nombre:</strong>
				<?php echo $usuario["nombre"]; ?>
			</p>

			<p>
				<strong>Correo:</strong>
				<?php echo $usuario["correo"]; ?>
			</p>

			<p>
				<strong>Rol:</strong>
				<?php echo $usuario["rol"]; ?>
			</p>

			<hr>

		<?php } ?>
		
	</body>
</html>