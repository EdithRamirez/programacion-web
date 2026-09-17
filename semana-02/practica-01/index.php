<?php
header('Content-type: text/plain'); // Envía el contenido como texto plano (no interpreta etiquetas HTML)

	echo "Hola mundo";
	echo "\n";

	print "Programación Web";

	echo "\n"; //salto de linea en formato de texto plano
	
	// Comentario de una línea

	# También es un comentario de una línea

	/*
	Comentario
	de varias líneas
	*/

	//Variables
	$nombre = "Paola";
	$edad = 20;
	$promedio = 8.5;

	echo $nombre;

	echo "\n";

	//Constantes
	const CARRERA = "Sistemas Computacionales";
	const GRADO = 7;

	echo CARRERA;
	echo "\n";
	
	$activo = true;

	/* 
		var_dump 
		muestra información estructurada sobre una variable, incluyendo su tipo y valor 
	*/

	var_dump($nombre);
	var_dump($edad);
	var_dump($promedio);
	var_dump(CARRERA);
	var_dump($activo);


	$resultado = print "Datos registrados";
	echo $resultado;
?>


