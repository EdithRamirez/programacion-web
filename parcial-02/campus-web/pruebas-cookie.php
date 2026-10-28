<?php

	$correo = "ana@campusweb.com";

	// CREAR LA COOKIE
	if (isset($_GET["guardar"])) {
		setcookie(
			"correo_recordado",
			$correo,
			time() + 3600,
			"/"
		);

		echo "La cookie fue enviada al navegador.<br>";
		echo "Recarga la página para verla dentro de \$_COOKIE.<br><br>";
	}


	// ELIMINAR LA COOKIE
	if (isset($_GET["eliminar"])) {
		setcookie(
			"correo_recordado",
			"",
			time() - 3600,
			"/"
		);

		echo "La cookie fue eliminada.<br>";
		echo "Recarga la página para comprobarlo.<br><br>";
	}

	// COMPROBAR SI EXISTE
	if (isset($_COOKIE["correo_recordado"])) {

		echo "La cookie existe.<br>";

		echo "Nombre: correo_recordado<br>";

		echo "Valor: ";
		echo $_COOKIE["correo_recordado"];

	} else {

		echo "La cookie todavía no existe.";
	}

	// VER TODO EL ARREGLO $_COOKIE
	echo "<strong>Contenido de \$_COOKIE:</strong>";

	echo "<pre>";
	print_r($_COOKIE);
	echo "</pre>";




?>

<hr>

<a href="?guardar=1">Guardar cookie</a>

<br><br>

<a href="?eliminar=1">Eliminar cookie</a>