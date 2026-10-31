<?php
	//mysqli_report(MYSQLI_REPORT_OFF);

	//CONECTAR LA BD CON EL SERVIDOR, USUARIO, CONTRASEÑA, NOMBRE DE LA BD
	$host = "localhost";
	$usuarioBD = "root";
	$passwordBD = "root";
	$nombreBD = "campusOld";

	$conexion = mysqli_connect($host, $usuarioBD, $passwordBD, $nombreBD);

	//COMPROBAR LA CONEXIÓN CON DIE -> es una construcción del lenguaje PHP
	if (!$conexion) {
		die("Error de conexión: " . mysqli_connect_error());
	}

	mysqli_set_charset($conexion, "utf8mb4");