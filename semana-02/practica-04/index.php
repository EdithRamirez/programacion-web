<?php

	// Datos de la película

	$pelicula = "El increíble castillo vagabundo";
	$genero = "Infantil/Fantasía";
	$anioEstreno = 2004;
	$duracion = 169;
	$enCartelera = true;


	// Información principal

	echo "<h2>Información de la película</h2>";

	echo "<p>Película: " . $pelicula . "</p>";
	echo "<p>Género: " . $genero . "</p>";
	echo "<p>Año de estreno: " . $anioEstreno . "</p>";
	echo "<p>Duración: " . $duracion . " minutos</p>";

	echo "<p>La película " . $pelicula . " pertenece al género " . $genero . ", se estrenó en " . $anioEstreno . " y tiene una duración de " . $duracion . " minutos.</p>";


	// Estado de cartelera con if / else

	echo "<h2>Estado de cartelera</h2>";

	if ($enCartelera) {
		echo "<p>La película está en cartelera.</p>";
	} else {
		echo "<p>La película no está en cartelera.</p>";
	}


	// Calificación con for

	$calificacion = 3;

	echo "<h2>Calificación</h2>";
	echo "<p>";

	for ($i = 1; $i <= 5; $i++) {

		if ($i <= $calificacion) {
			echo "&#9733;"; // ★ Estrella llena
		} else {
			echo "&#9734;"; // ☆ Estrella vacía
		}

	}

	echo "</p>";


	// Boletos disponibles con while

	$boletosDisponibles = 3;

	echo "<h2>Boletos</h2>";

	if ($enCartelera) {

		while ($boletosDisponibles > 0) {
			echo "<p>Boletos disponibles: " . $boletosDisponibles . "</p>";
			$boletosDisponibles--;
		}

		echo "<p>Boletos agotados.</p>";

	} else {
		echo "<p>No hay boletos disponibles porque la película no está en cartelera.</p>";
	}

?>