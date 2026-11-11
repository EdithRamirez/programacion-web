<?php
	// Conexión a la base de datos
	require_once __DIR__ . "/../config/conexion.php";

	// Correo que se desea buscar
	$correo = "ana@correo.com";

	// Consulta con marcador de parámetro
	$sql = "SELECT id, nombre, correo, rol FROM usuarios WHERE correo = ?";

	// Preparar la consulta
	$consulta = mysqli_prepare($conexion, $sql);

	// Asociar el valor al parámetro
	mysqli_stmt_bind_param($consulta, "s", $correo);

	// Ejecutar la consulta
	mysqli_stmt_execute($consulta);

	// Obtener el resultado
	$resultado = mysqli_stmt_get_result($consulta);

	// Comprobar si se encontró un registro
	if (mysqli_num_rows($resultado) > 0) {

		// Obtener los datos del usuario
		$usuario = mysqli_fetch_assoc($resultado);

		echo "Usuario encontrado<br>";
		echo "Nombre: " . $usuario["nombre"] . "<br>";
		echo "Correo: " . $usuario["correo"] . "<br>";
		echo "Rol: " . $usuario["rol"];

	} else {

		echo "Usuario no encontrado.";
	}
?>