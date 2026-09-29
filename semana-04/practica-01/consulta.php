<?php

	// DATOS DE LOS ALUMNOS
	/*
		Cada elemento representa un alumno
		Se utiliza un arreglo multidimensional: $alumnos contiene varios alumnos y cada alumno es un arreglo asociativo
	*/
	
	$alumnos = [
		[
			"matricula" => "A001",
			"nombre" => "Ana López",
			"cuatrimestre" => 7,
			"programa" => "Sistemas Computacionales",
			"carrera" => 8.5,
			"estado" => "Activo"
		],
		[
			"matricula" => "A002",
			"nombre" => "Luis Martínez",
			"cuatrimestre" => 7,
			"programa" => "Sistemas Computacionales",
			"carrera" => 7.8,
			"estado" => "Activo"
		],
		[
			"matricula" => "A003",
			"nombre" => "Carla Hernández",
			"cuatrimestre" => 7,
			"programa" => "Sistemas Computacionales",
			"carrera" => 9.2,
			"estado" => "Activo"
		],
		[
			"matricula" => "A004",
			"nombre" => "Diego Ramírez",
			"cuatrimestre" => 7,
			"programa" => "Sistemas Computacionales",
			"carrera" => 6.9,
			"estado" => "Activo"
		]
	];


	// CONTROL DE LA BÚSQUEDA

	// Al abrir la página todavía no se ha realizado ninguna búsqueda
	$busquedaRealizada = false;

	//Al inicio suponemos que no se ha encontrado ningún alumno
	$encontrado = false;

	//Aquí se guardará el alumno cuando exista una coincidencia
	$resultado = [];

	// RECIBIR DATOS CON GET

	/*
		isset() verifica si el dato "matricula" fue enviado mediante GET
		Después de enviar el formulario la URL puede verse así: consulta.php?matricula=A001
	*/

	if (isset($_GET["matricula"])) {

		// Indicamos que el usuario ya realizó una búsqueda
		$busquedaRealizada = true;

		/*
			$_GET permite recuperar el valor enviado desde el formulario 
			El texto "matricula" corresponde al atributo name del input
		*/
		$matriculaBuscada = $_GET["matricula"];


		// BUSCAR ALUMNO
		// Recorremos todos los alumnos almacenados en el arreglo

		foreach ($alumnos as $alumno) {

			//Comparamos la matrícula del alumno actual con la matrícula escrita por el usuario
			if ($alumno["matricula"] == $matriculaBuscada) {

				//Si existe coincidencia, guardamos toda la información del alumno
				$resultado = $alumno;
				//print_r($resultado);
				//Indicamos que el alumno fue encontrado
				$encontrado = true;
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Campus Web</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>

		<header class="header">
			<div class="container header-content">
				<a href="#" class="logo">Campus Web</a>
				<nav class="nav">
					<ul>
						<li><a href="#">Inicio</a></li>
						<li><a href="#">Alumnos</a></li>
						<li><a href="#" class="active">Consulta</a></li>
						<li><a href="#">Registro</a></li>
					</ul>
				</nav>
			</div>
		</header>

		<main>
			<section class="hero">
				<div class="container">
					<p class="hero-label">Consulta académica</p>
					<h1>Consulta de alumnos</h1>
					<p class="hero-description">Busca la información académica de un alumno utilizando su matrícula.</p>
				</div>
			</section>
			<section class="section">
				<div class="container">
					<div class="section-heading">
						<p class="section-label">Búsqueda</p>
						<h2>Buscar alumno</h2>
					</div>
					<div class="search-card">
						<p class="search-description">Ingresa una matrícula para consultar la información registrada.</p>

						<!-- GET envía los datos mediante la URL, action indica a qué archivo se enviarán -->
						<form action="consulta.php" method="GET">
							<label for="matricula">Matrícula</label>

							<div class="search-box">
								<!--name="matricula" es importante porque PHP utilizará ese nombre dentro de $_GET -->
								<input type="text" id="matricula" name="matricula" placeholder="Ej. A001">
								<button type="submit">Buscar</button>
							</div>
						</form>
					</div>
				</div>
			</section>

			<!-- La sección solo aparece después de realizar una búsqueda -->
			<?php if ($busquedaRealizada) { ?>
				<section class="section section-light">
					<div class="container">
						<div class="section-heading">
							<p class="section-label">Resultado</p>
							<h2>Información del alumno</h2>
						</div>

						<!--Si la matrícula fue encontrada, mostramos la información del alumno -->
						<?php if ($encontrado) { ?>
							<article class="student-card">
								<div class="student-header">
									<div>
										<span class="status available">Alumno encontrado</span>
										<h3>
											<?php echo $resultado["nombre"]; ?>
										</h3>
										<p class="student-id">
											Matrícula: <?php echo $resultado["matricula"]; ?>
										</p>
									</div>
									<span class="semester">
										<?php echo $resultado["cuatrimestre"]; ?>º cuatrimestre
									</span>
								</div>
								<div class="student-info">
									<div class="info-item">
										<p>Programa</p>
										<strong>
											<?php echo $resultado["carrera"]; ?>
										</strong>
									</div>
									<div class="info-item">
										<p>Promedio</p>
										<strong>
											<?php echo $resultado["promedio"]; ?>
										</strong>
									</div>

									<div class="info-item">
										<p>Estado</p>
										<strong>
											<?php echo $resultado["estado"]; ?>
										</strong>
									</div>
								</div>
							</article>
						<?php } else { ?>

							<!--Si ninguna matrícula coincide, mostramos un mensaje diferente -->
							<div class="search-card">
								<span class="status unavailable">Alumno no encontrado</span>
								<p class="search-description">Verifica la matrícula e intenta nuevamente.</p>
							</div>
						<?php } ?>
					</div>
				</section>
			<?php } ?>

			<section class="section">
				<div class="container">
					<div class="section-heading">
						<p class="section-label">Apoyo</p>
						<h2>Matrículas disponibles</h2>
					</div>
					<p class="support-description">Utiliza alguna de las siguientes matrículas para realizar una consulta.</p>
					<ul class="student-list">
						<li>A001</li>
						<li>A002</li>
						<li>A003</li>
						<li>A004</li>
					</ul>
				</div>
			</section>
		</main>

		<footer class="footer">
			<div class="container">
				<p>Campus Web &middot; Sistema académico de ejemplo</p>
			</div>
		</footer>
	</body>
</html>