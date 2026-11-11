<?php
	//introducción a publicacion.php
	//$stmt (abreviatura de statement o sentencia)
	require_once __DIR__ . "/../config/conexion.php";

	$id = 1;
	$nombre = "Ana Martínez";

	$sql = "UPDATE usuarios SET nombre = ? WHERE id = ?";

	$consulta = mysqli_prepare($conexion, $sql);

	mysqli_stmt_bind_param($consulta, "si", $nombre, $id);

	if (mysqli_stmt_execute($consulta)) {
		echo "Registro actualizado correctamente.";
	} else {
		echo "Error al actualizar el registro.";
	}