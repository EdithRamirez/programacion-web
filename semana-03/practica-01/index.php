<?php

	// MOSTRAR ERRORES, debe colocarse al inicio del archivo cuando se utilice.

	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);

	// Información general de la página

	$tituloPagina = "CineWeb";
	$tituloPrincipal = "Películas para descubrir";
	$descripcion = "Consulta algunas películas recomendadas y conoce su género, año y disponibilidad.";

	// ARREGLOS

	// Menú principal
	$menu = [
		"Inicio",
		"Películas",
		"Géneros",
		"Favoritos"
	];
	
	// FOREACH - Recorre los elementos de un arreglo uno por uno.

	// foreach ($menu as $opcion) {
	// 	echo $opcion . "<br>";
	// }


	// Podemos provocar un error intentando mostrar directamente un arreglo con echo.
	// echo $menu;
	
	//Sintaxis tradicional crear un arreglo
	// $generos = array(
	// 	"Acción",
	// 	"Ciencia ficción",
	// 	"Animación",
	// 	"Drama",
	// 	"Comedia"
	// );

	//Mostrar desde un elemento mediante su posicion
	//echo $generos[2];

	//Mostrar estructura mediante posicion
	//print_r($generos);

	//Contar elementos del arreglo
	//echo count($generos);

	// FOREACH + HTML
	// Géneros disponibles
	$generos = [
		"Acción",
		"Ciencia ficción",
		"Animación",
		"Drama",
		"Comedia"
	];


	// ACCEDER - Se utiliza la posicion para obtener un dato específico, los arreglos inician desde 0.
	//echo $generos[3];

	// ARREGLOS ASOCIATIVOS

	// $pelicula = [
	// 	"titulo" => "Interestelar",
	// 	"genero" => "Ciencia ficción",
	// 	"anio" => 2014
	// ];


	// ACCEDER A UN VALOR - Se utiliza la clave para obtener un dato específico.

	// echo $pelicula["titulo"];

	// FOREACH EN ARREGLOS ASOCIATIVOS - Se utiliza cuando necesitamos conocer tanto la clave como su valor.

	// foreach ($pelicula as $clave => $valor) {
	// 	echo $clave . "<br>";
	// 	echo $valor . "<br>";
	// }

	// ARREGLOS MULTIDIMENSIONALES - Un arreglo puede contener otros arreglos.

	// $peliculas = [
	// 	[
	// 		"titulo" => "Interestelar",
	// 		"genero" => "Ciencia ficción",
	// 		"anio" => 2014
	// 	],
	// 	[
	// 		"titulo" => "Coco",
	// 		"genero" => "Animación",
	// 		"anio" => 2017
	// 	]
	// ];

	// Solo necesitamos obtener cada película.
	// foreach ($peliculas as $pelicula) {
	// 	echo $pelicula["titulo"] . "<br>";
	// }


	// PELÍCULAS DESTACADAS
	// Versión completa que utilizaremos para generar las tarjetas dentro de la página.
	$peliculas = [
		[
			"titulo" => "Interestelar",
			"genero" => "Ciencia ficción",
			"anio" => 2014,
			"duracion" => "2 h 49 min",
			"descripcion" => "Un grupo de exploradores viaja por el espacio en busca de un nuevo hogar para la humanidad.",
			"disponible" => true
		],
		[
			"titulo" => "El origen",
			"genero" => "Ciencia ficción",
			"anio" => 2010,
			"duracion" => "2 h 28 min",
			"descripcion" => "Un especialista entra en los sueños de otras personas para obtener información.",
			"disponible" => false
		],
		[
			"titulo" => "Coco",
			"genero" => "Animación",
			"anio" => 2017,
			"duracion" => "1 h 45 min",
			"descripcion" => "Miguel viaja al mundo de los muertos mientras descubre la historia de su familia.",
			"disponible" => false
		],
		[
			"titulo" => "En busca de la felicidad",
			"genero" => "Drama",
			"anio" => 2006,
			"duracion" => "1 h 57 min",
			"descripcion" => "Un padre enfrenta diferentes dificultades mientras intenta construir una vida mejor.",
			"disponible" => true
		]
	];

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $tituloPagina; ?></title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<header class="header">
			<div class="container header-content">
				<a href="#" class="logo"><?php echo $tituloPagina; ?></a>
				<nav class="nav">
					<?php foreach ($menu as $opcion) { ?>
						<a href="#"><?php echo $opcion; ?></a>
					<?php } ?>
				</nav>
			</div>
		</header>

		<main>
			<!-- Presentación -->
			<section class="hero">
				<div class="container">
					<p class="hero-label">Catálogo de películas</p>
					<h1><?php echo $tituloPrincipal; ?></h1>
					<p class="hero-description"><?php echo $descripcion; ?></p>
					<a href="#peliculas" class="button">Explorar películas</a>
				</div>

			</section>

			<!-- Géneros -->
			<section class="section">
				<div class="container">
					<div class="section-heading">
						<p class="section-label">Explorar</p>
						<h2>Géneros</h2>
					</div>
					<ul class="genre-list">
						<?php foreach ($generos as $genero) { ?>
							<li><?php echo $genero; ?></li>
						<?php } ?>
					</ul>
				</div>
			</section>

			<!-- Películas -->
			<section class="section section-light" id="peliculas">
				<div class="container">
					<div class="section-heading">
						<p class="section-label">Recomendaciones</p>
						<h2>Películas destacadas</h2>
					</div>
					<div class="movies-grid">
						<!-- Inicia la card para mostrar la información de peliculas -->
						<?php foreach ($peliculas as $pelicula) { ?> 
							<article class="movie-card">
								<div class="movie-card-content">
									<span class="movie-genre"><?php echo $pelicula["genero"]; ?></span>
									<h3><?php echo $pelicula["titulo"]; ?></h3>
									<p class="movie-info">
										<?php echo $pelicula["anio"]; ?>
										&middot;
										<?php echo $pelicula["duracion"]; ?>
										<?php //echo $pelicula["anio"] . " &middot; " . $pelicula["duracion"]; ?>
									</p>

									<p class="movie-description">
										<?php echo $pelicula["descripcion"]; ?>
									</p>

									<?php if ($pelicula["disponible"]) { ?> <!-- Inicia estructura condicional if -->
										
										<p class="status available">Disponible</p>
										<a href="#" class="button button-small">Ver detalles</a>

									<?php } else { ?>

										<p class="status unavailable">Próximamente</p>
										<button class="button button-small button-disabled" disabled>No disponible</button>

									<?php } ?> <!-- Termina estructura condicional if -->
								</div>
							</article>
						<?php } ?> <!-- Termina la card -->
					</div>
				</div>
			</section>
		</main>

		<footer class="footer">
			<div class="container">
				<p><?php echo $tituloPagina; ?> &middot; Catálogo académico de ejemplo</p>
			</div>
		</footer>
	</body>
</html>