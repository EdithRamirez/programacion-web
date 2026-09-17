<?php
	/* Forma básica de combinar HTML y PHP
	   En este ejemplo, el HTML se genera desde PHP utilizando echo */
	   
	// Operadores aritméticos

	$precio = 850;
	$cantidad = 2;

	$total = $precio * $cantidad;

	echo "<h2>Operadores aritméticos</h2>";
	echo "<p>Precio: $" . $precio . "</p>";
	echo "<p>Cantidad: $cantidad</p>"; // PHP permite interpolar variables dentro de cadenas con comillas dobles
	
	echo "<p>Total: $" . $total . "</p>";


	// Condicional if + Operadores de comparación

	$stock = 4;

	echo "<h2>Condicional if + Operadores de comparación</h2>";

	if ($stock > 0) {
		echo "<p>Producto disponible</p>";
	} 


	// Condicional if/else + Operadores lógicos

	$edad = 20;
	$tieneCuenta = true;
	$bloqueado = false;

	echo "<h2>Condicional if/else + Operadores lógicos</h2>";

	if ($edad >= 18 && $tieneCuenta && !$bloqueado) {
		echo "<p>Acceso permitido</p>";
	} else {
		echo "<p>Acceso denegado</p>";
	}
	
	echo "<h4>Operador lógico OR </h4>";

	$esAdmin = false;
	$esEditor = true;

	if ($esAdmin || $esEditor) {
		echo "<p>Puede editar contenido</p>";
	}

	// for

	echo "<h2>Ciclo for</h2>";

	for ($i = 1; $i <= 5; $i++) {
		echo "<p>Habitación " . $i . "</p>";
	}


	// while e incremento

	$turno = 1;

	echo "<h2>Ciclo while e incremento</h2>";

	while ($turno <= 4) {
		echo "<p>Turno " . $turno . "</p>";
		$turno++; 
	}

	// Decremento

	$contador = 5;

	echo "<h2>Decremento </h2>";

	while ($contador >= 1) {
		echo "<p>" . $contador . "</p>";
		$contador--;
	}

	echo "<p>¡Inicio!</p>";

	
?>

