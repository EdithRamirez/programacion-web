<?php

	//CONTROL DEL FORMULARIO

	// Indica si el formulario ya fue enviado
	// Se utilizará después para decidir si se muestra el resultado

	$formularioEnviado = false;

	//RECIBIR DATOS CON POST

	//isset() verifica si el dato "matricula" fue enviado mediante POST

	if (isset($_POST["matricula"])) {
		$formularioEnviado = true;
		/*
			$_POST permite recuperar los valores enviados desde el formulario
			El nombre utilizado corresponde al atributo name de cada campo
		*/

		$matricula = $_POST["matricula"];
		$nombre = $_POST["nombre"];
		$apellido = $_POST["apellido"];
		$correo = $_POST["correo"];
		$cuatrimestre = $_POST["cuatrimestre"];
		$estado = $_POST["estado"];
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
						<li>
							<a href="#">Inicio</a>
						</li>
						<li>
							<a href="#">Alumnos</a>
						</li>
						<li>
							<a href="consulta.php">Consulta</a>
						</li>
						<li>
							<a href="registro.php" class="active">Registro</a>
						</li>
					</ul>
				</nav>
			</div>
		</header>
		<main>
			<section class="hero">
				<div class="container">
					<p class="hero-label">Registro académico</p>
					<h1>Registro de alumno</h1>
					<p class="hero-description">Captura la información del alumno para enviarla y procesarla desde PHP.</p>
				</div>
			</section>

			<section class="section">
				<div class="container">
					<div class="section-heading">
						<p class="section-label">Datos del alumno</p>
						<h2>Información de registro</h2>
					</div>

					<div class="form-card">
						<!-- POST envía los datos sin mostrarlos directamente en la URL, action indica a qué archivo se enviarán los datos -->

						<form action="registro.php" method="POST">
							<div class="form-grid">
								<div class="form-group">
									<label for="matricula">Matrícula</label>
									<input type="text" id="matricula" name="matricula" placeholder="Ej. A005">
								</div>
								<div class="form-group">
									<label for="nombre">Nombre</label>
									<input type="text" id="nombre" name="nombre" placeholder="Ej. Daniela">
								</div>
								<div class="form-group">
									<label for="apellido">Apellido</label>
									<input type="text" id="apellido" name="apellido" placeholder="Ej. Rodríguez">
								</div>
								<div class="form-group">
									<label for="correo">Correo
									</label>
									<input type="email" id="correo" name="correo" placeholder="Ej. alumno@correo.com">
								</div>
								<div class="form-group">
									<label for="cuatrimestre">Cuatrimestre</label>
									<select id="cuatrimestre" name="cuatrimestre">
										<option value="">Selecciona una opción</option>
										<option value="5">5&ordm; cuatrimestre</option>
										<option value="6">6&ordm; cuatrimestre</option>
										<option value="7">7&ordm; cuatrimestre</option>
										<option value="8">8&ordm; cuatrimestre</option>
									</select>
								</div>
								<div class="form-group">
									<label for="estado">Estado</label>
									<select id="estado" name="estado">
										<option value="">Selecciona una opción</option>
										<option value="Activo">Activo</option>
										<option value="Baja temporal">Baja temporal</option>
										<option value="Egresado">Egresado</option>
									</select>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit">Registrar alumno</button>
							</div>
						</form>
					</div>
				</div>
			</section>

			<!--La información solo se muestra después de enviar el formulario -->

			<?php if ($formularioEnviado) { ?>
				<section class="section section-light">
					<div class="container">
						<div class="section-heading">
							<p class="section-label">Resultado</p>
							<h2>Datos recibidos</h2>
						</div>
						<article class="student-card">
							<div class="student-header">
								<div>
									<span class="status available">Información recibida</span>
									
									<h3>
										<?php echo htmlspecialchars($nombre, ENT_QUOTES, "UTF-8") . " " . htmlspecialchars($apellido, ENT_QUOTES, "UTF-8"); ?>
									</h3>

									<p class="student-id">
										Matrícula: <?php echo $matricula; ?>
									</p>
								</div>

								<span class="semester">
									<?php echo $cuatrimestre; ?>&ordm; cuatrimestre
								</span>
							</div>

							<div class="student-info">
								<div class="info-item">
									<p>Correo</p>
									<strong><?php echo $correo; ?></strong>
								</div>

								<div class="info-item">
									<p>Estado</p>
									<strong><?php echo $estado; ?></strong>
								</div>
								<div class="info-item">
									<p>Proceso</p>
									<strong>Datos recibidos</strong>
								</div>
							</div>
						</article>
					</div>
				</section>
			<?php } ?>
		</main>

		<footer class="footer">
			<div class="container">
				<p>Campus Web &middot; Sistema académico de ejemplo</p>
			</div>
		</footer>
	</body>
</html>