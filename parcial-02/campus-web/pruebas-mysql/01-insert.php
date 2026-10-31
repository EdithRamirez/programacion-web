<?php
	
	require_once __DIR__ . "/../config/conexion.php";

	$nombre = "Administrador";
	$correo = "admin@correo.com";
	$password = "5678";
	$rol = "admin";

	$sql = "INSERT INTO usuarios (nombre, correo, password, rol)
			VALUES ('$nombre', '$correo', '$password', '$rol')";

	if (mysqli_query($conexion, $sql)) {
		$mensaje = "Registro agregado correctamente.";
	} else {
		$mensaje = "Error al agregar el registro.";
	}
	echo $mensaje; 

?>