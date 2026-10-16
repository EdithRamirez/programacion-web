<?php
	require_once __DIR__ . "/includes/funciones.php";
	$paginaActual = "alumnos";
	$alumnos = obtenerAlumnos();

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo obtenerTituloPagina($paginaActual); ?> | Campus Web</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<?php require_once __DIR__ . "/includes/header.php"; ?>
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
										<td><?php echo escaparHtml($alumno["matricula"]); ?></td>
										<td><?php echo escaparHtml($alumno["nombre"]); ?></td>
										<td><?php echo escaparHtml($alumno["correo"]); ?></td>
										<td><?php echo escaparHtml($alumno["cuatrimestre"]); ?></td>
										<td><?php echo escaparHtml($alumno["promedio"]); ?></td>
										<td><?php echo escaparHtml($alumno["estado"]); ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</section>
		</main>
		<?php 
			require_once __DIR__ . "/includes/footer.php";
		?>
	</body>
</html>
