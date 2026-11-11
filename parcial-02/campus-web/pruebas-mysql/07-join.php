<?php
	//introducción a index.php

	require_once __DIR__ . "/../config/conexion.php";

	$sql = "SELECT
				publicaciones.titulo,
				publicaciones.contenido,
				usuarios.nombre AS autor
			FROM publicaciones
			INNER JOIN usuarios
				ON publicaciones.usuario_id = usuarios.id";

	$resultado = mysqli_query($conexion, $sql);

	while ($publicacion = mysqli_fetch_assoc($resultado)) {

		echo "Título: " . $publicacion["titulo"] . "<br>";
		echo "Autor: " . $publicacion["autor"] . "<br>";
		echo "Contenido: " . $publicacion["contenido"] . "<br>";
		echo "<br>";
	}