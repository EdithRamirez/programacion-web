<?php

	evento = "Noche de Museos";
	$museo = "Museo Nacional de Arte"
	$hora = "18:00";
	$entradaLibre = true;

	const ciudad = "Ciudad de México";

	echo "<h2>Información del evento</h2>";

	echo "Evento: " . $Evento;
	echo "Museo: " $museo;

	echo $evento . " se realizará en " . CIUDAD . " a las " . $hora;


	// Disponibilidad del evento

	if ($entradaLibre && ciudad == "Ciudad de México") {
		echo "<p>Entrada libre</p>";
	} else {
		echo "<p>Consulta disponibilidad</p>";
	}


	// Mostrar actividades

	for ($i = 1; $i <= 3; $i++) {
		echo "<p>Actividad " . $i . "</p>"
	}

?>