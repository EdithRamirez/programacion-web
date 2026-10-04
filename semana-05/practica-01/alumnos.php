<?php

	$alumnos = [
		[
			"matricula" => "A001",
			"nombre" => "Ana López",
			"correo" => "ana@campusweb.mx",
			"cuatrimestre" => 7,
			"promedio" => 8.5,
			"estado" => "Activo"
		],
		[
			"matricula" => "A002",
			"nombre" => "Luis Martínez",
			"correo" => "luis@campusweb.mx",
			"cuatrimestre" => 7,
			"promedio" => 7.8,
			"estado" => "Activo"
		],
		[
			"matricula" => "A003",
			"nombre" => "Carla Hernández",
			"correo" => "carla@campusweb.mx",
			"cuatrimestre" => 7,
			"promedio" => 9.2,
			"estado" => "Activo"
		],
		[
			"matricula" => "A004",
			"nombre" => "Diego Ramírez",
			"correo" => "diego@campusweb.mx",
			"cuatrimestre" => 7,
			"promedio" => 6.9,
			"estado" => "Baja temporal"
		]
	];

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Alumnos | Campus Web</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header class="site-header">
			<div class="container header-content">
				<div class="brand">Campus Web</div>
				<nav>
					<ul>
						<li><a href="index.php">Inicio</a></li>
						<li><a href="consulta.php">Consulta</a></li>
						<li><a href="registro.html">Registro</a></li>
						<li><a class="active" href="alumnos.php">Alumnos</a></li>
					</ul>
				</nav>
			</div>
		</header>

		<main>
			<section class="hero">
				<div class="container">
					<h1>Alumnos</h1>
					<p>Consulta la información general de los alumnos disponibles en Campus Web.</p>
				</div>
			</section>

			<section class="section">
				<div class="container">
					<h2>Listado de alumnos</h2>
					<p class="section-description">La información se genera a partir de un arreglo de alumnos.</p>

					<div class="table-wrapper">
						<table class="students-table">
							<thead>
								<tr>
									<th>Matrícula</th>
									<th>Nombre</th>
									<th>Correo</th>
									<th>Cuatrimestre</th>
									<th>Promedio</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($alumnos as $alumno) { ?>
									<tr>
										<td><?php echo htmlspecialchars($alumno["matricula"]); ?></td>
										<td><?php echo htmlspecialchars($alumno["nombre"]); ?></td>
										<td><?php echo htmlspecialchars($alumno["correo"]); ?></td>
										<td><?php echo htmlspecialchars((string) $alumno["cuatrimestre"]); ?></td>
										<td><?php echo htmlspecialchars((string) $alumno["promedio"]); ?></td>
										<td><?php echo htmlspecialchars($alumno["estado"]); ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
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
