<?php
	//introducción a eliminar-publicacion.php

	require_once __DIR__ . "/../config/conexion.php";

	$id = 3;

	$sql = "DELETE FROM usuarios
			WHERE id = ?";

	$consulta = mysqli_prepare($conexion, $sql);

	mysqli_stmt_bind_param(
		$consulta,
		"i",
		$id
	);

	if (mysqli_stmt_execute($consulta)) {
		echo "Registro eliminado correctamente.";
	} else {
		echo "Error al eliminar el registro.";
	}

?>