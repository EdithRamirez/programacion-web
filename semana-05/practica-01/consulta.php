<?php

	$alumnos = [
		[
			"matricula" => "A001",
			"nombre" => "Ana López",
			"cuatrimestre" => 7,
			"programa" => "Sistemas Computacionales",
			"promedio" => 8.5,
			"estado" => "Activo"
		],
		[
			"matricula" => "A002",
			"nombre" => "Luis Martínez",
			"cuatrimestre" => 7,
			"programa" => "Sistemas Computacionales",
			"promedio" => 7.8,
			"estado" => "Activo"
		],
		[
			"matricula" => "A003",
			"nombre" => "Carla Hernández",
			"cuatrimestre" => 7,
			"programa" => "Sistemas Computacionales",
			"promedio" => 9.2,
			"estado" => "Activo"
		],
		[
			"matricula" => "A004",
			"nombre" => "Diego Ramírez",
			"cuatrimestre" => 7,
			"programa" => "Sistemas Computacionales",
			"promedio" => 6.9,
			"estado" => "Activo"
		]
	];

	$busquedaRealizada = false;
	$encontrado = false;
	$resultado = [];

	if (isset($_GET["matricula"])) {
		$busquedaRealizada = true;
		$matriculaBuscada = $_GET["matricula"];

		foreach ($alumnos as $alumno) {
			if ($alumno["matricula"] == $matriculaBuscada) {
				$resultado = $alumno;
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
		<title>Consulta | Campus Web</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header class="site-header">
			<div class="container header-content">
				<div class="brand">Campus Web</div>

				<nav>
					<ul>
						<li><a href="index.php">Inicio</a></li>
						<li><a class="active" href="consulta.php">Consulta</a></li>
						<li><a href="registro.html">Registro</a></li>
						<li><a href="alumnos.php">Alumnos</a></li>
					</ul>
				</nav>
			</div>
		</header>

		<main>
			<section class="hero">
				<div class="container">
					<h1>Consulta de alumnos</h1>
					<p>Busca la información de un alumno mediante su matrícula.</p>
				</div>
			</section>

			<section class="section">
				<div class="container">
					<div class="search-card">
						<p class="search-description">Escribe una matrícula disponible y presiona Buscar.</p>

						<form action="consulta.php" method="GET">
							<label for="matricula">Matrícula</label>

							<div class="search-box">
								<input type="text" id="matricula" name="matricula" placeholder="Ej. A001">
								<button type="submit">Buscar</button>
							</div>
						</form>
					</div>
				</div>
			</section>

			<?php if ($busquedaRealizada) { ?>
				<section class="section light">
					<div class="container">

						<?php if ($encontrado) { ?>
							<article class="student-card">
								<div class="student-header">
									<div>
										<span class="status available">
											<?php echo htmlspecialchars($resultado["estado"]); ?>
										</span>

										<h3><?php echo htmlspecialchars($resultado["nombre"]); ?></h3>
										<p class="student-id">
											Matrícula:
											<?php echo htmlspecialchars($resultado["matricula"]); ?>
										</p>
									</div>

									<span class="semester">
										<?php echo htmlspecialchars((string) $resultado["cuatrimestre"]); ?>&ordm; cuatrimestre
									</span>
								</div>

								<div class="student-info">
									<div class="info-item">
										<p>Programa</p>
										<strong><?php echo htmlspecialchars($resultado["programa"]); ?></strong>
									</div>

									<div class="info-item">
										<p>Promedio</p>
										<strong><?php echo htmlspecialchars((string) $resultado["promedio"]); ?></strong>
									</div>
								</div>
							</article>
						<?php } else { ?>
							<div class="error-box">
								<h3>Alumno no encontrado</h3>
								<p>
									No existe información para la matrícula:
									<strong>
										<?php echo htmlspecialchars($_GET["matricula"]); ?>
									</strong>
								</p>
							</div>
						<?php } ?>

					</div>
				</section>
			<?php } ?>

			<section class="section">
				<div class="container">
					<h2>Matrículas de apoyo</h2>
					<p class="support-description">Utiliza cualquiera de estas matrículas para comprobar la consulta.</p>

					<ul class="student-list">
						<li>A001</li>
						<li>A002</li>
						<li>A003</li>
						<li>A004</li>
					</ul>
				</div>
			</section>
		</main>

		<footer class="site-footer">
			<div class="container">
				<p>Campus Web · Programación Web</p>
			</div>
		</footer>
	</body>
</html>
