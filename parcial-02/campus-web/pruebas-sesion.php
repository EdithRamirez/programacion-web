<?php

session_start();

// GUARDAR DATOS EN LA SESIÓN
if (isset($_GET["guardar"])) {
    $_SESSION["nombre"] = "Ana López";
    $_SESSION["rol"] = "editor";
}

// CERRAR SESIÓN
if (isset($_GET["eliminar"])) {
    $_SESSION = [];
    session_destroy();
}

// MOSTRAR LOS DATOS DE LA SESIÓN
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

?>

<a href="?guardar=1">Guardar sesión</a>

<br><br>

<a href="?eliminar=1">Cerrar sesión</a>