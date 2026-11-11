<?php
	// Contraseña de prueba
	$password = "12345678";

	// Generar el hash
	$passwordHash = password_hash($password, PASSWORD_DEFAULT);

	echo "Contraseña original: " . $password . "<br><br>";

	echo "Hash generado:<br>";
	echo $passwordHash;

	echo "<br><br>";

	// Verificar la contraseña
	if (password_verify($password, $passwordHash)) {
		echo "La contraseña es correcta.";
	} else {
		echo "La contraseña es incorrecta.";
	}
?>