<?php
	/* PRÁCTICA
		Revisa el código y evita repetir elementos que pueden reutilizarse entre diferentes páginas.
	*/
	function escaparHtml($texto) {
		return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
	}

	$formularioEnviado = false;
	
    $matricula = "";
    $nombre = "";
    $apellido = "";
    $correo = "";
    $cuatrimestre = "";
    $promedio = "";
    $estado = "";

	$errores = [];

	// Se procesa la información únicamente cuando el formulario se envía mediante POST	
	if ($_SERVER["REQUEST_METHOD"] === "POST") {

		$formularioEnviado = true;

		$matricula = trim($_POST["matricula"]);
		$nombre = trim($_POST["nombre"]);
		$apellido = trim($_POST["apellido"]);
		$correo = trim($_POST["correo"]);
		$cuatrimestre = $_POST["cuatrimestre"];
		$promedio = trim($_POST["promedio"]);
		$estado = $_POST["estado"];

		// Matrícula
		if ($matricula === "") {
			$errores[] = "La matrícula es obligatoria.";
		} elseif (strlen($matricula) < 4) {
			$errores[] = "La matrícula debe tener al menos 4 caracteres.";
		}

		// Nombre
		if (empty($nombre)) {
			$errores[] = "El nombre es obligatorio.";
		} elseif (strlen($nombre) < 3) {
			$errores[] = "El nombre debe tener al menos 3 caracteres.";
		}

		// Apellido
		if (empty($apellido)) {
			$errores[] = "El apellido es obligatorio.";
		}

		// Correo
		if ($correo === "") {
			$errores[] = "El correo es obligatorio.";
		} elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
			$errores[] = "El correo no tiene un formato válido.";
		}

		// Cuatrimestre
		if ($cuatrimestre === "") {
			$errores[] = "Selecciona un cuatrimestre.";
		}

		// Promedio
		if ($promedio === "") {
			$errores[] = "El promedio es obligatorio.";
		} elseif (!is_numeric($promedio)) {
			$errores[] = "El promedio debe ser un valor numérico.";
		} elseif ($promedio < 0 || $promedio > 10) {
			$errores[] = "El promedio debe estar entre 0 y 10.";
		}

		// Estado
		if ($estado === "") {
			$errores[] = "Selecciona un estado.";
		}
	}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Registro | Campus Web</title>
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
						<li><a class="active" href="registro.php">Registro</a></li>
						<li><a href="alumnos.php">Alumnos</a></li>
					</ul>
				</nav>
			</div>
		</header>
		<main>

			<section class="hero">
				<div class="container">
					<h1>Registro de alumnos</h1>
					<p>Captura la información del alumno y comprueba los datos antes de mostrar el registro.
					</p>
				</div>
			</section>
			<section class="section">
				<div class="container">
					<?php if ($formularioEnviado && count($errores) > 0) { ?>
						<div class="error-box">
							<h3>Revisa la información</h3>
							<ul>
								<?php foreach ($errores as $error) { ?>
									<li><?php echo escaparHtml($error); ?></li>
								<?php } ?>
							</ul>
						</div>
					<?php } ?>

					<div class="form-card">

						<form action="registro.php" method="POST">

							<div class="form-grid">

								<div class="form-group">
									<label for="matricula">Matrícula</label>
									<input type="text" id="matricula" name="matricula" placeholder="Ej. A005" value="<?php echo escaparHtml($matricula); ?>">
								</div>

								<div class="form-group">
									<label for="nombre">Nombre</label>

									<input type="text" id="nombre" name="nombre" placeholder="Ej. Daniela" value="<?php echo escaparHtml($nombre); ?>">
								</div>

								<div class="form-group">
									<label for="apellido">Apellido</label>

									<input type="text" id="apellido" name="apellido" placeholder="Ej. Rodríguez" value="<?php echo escaparHtml($apellido); ?>">
								</div>

								<div class="form-group">
									<label for="correo">Correo</label>

									<input type="text" id="correo" name="correo" placeholder="alumno@correo.com" value="<?php echo escaparHtml($correo); ?>">
								</div>

								<div class="form-group">
									<label for="cuatrimestre">Cuatrimestre</label>

									<select id="cuatrimestre" name="cuatrimestre">
										<option value="">Selecciona una opción</option>
										<option value="5">5&ordm;</option>
										<option value="6">6&ordm;</option>
										<option value="7">7&ordm;</option>
										<option value="8">8&ordm;</option>
									</select>
								</div>

								<div class="form-group">
									<label for="promedio">Promedio</label>

									<input type="text" id="promedio" name="promedio" placeholder="Ej. 8" value="<?php echo escaparHtml($promedio); ?>">
								</div>

								<div class="form-group full">
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

			<?php if ($formularioEnviado && count($errores) === 0) { ?>

				<section class="section light">
					<div class="container">
						<div class="success-box">
							Registro procesado correctamente.
						</div>
						<article class="student-card">

							<div class="student-header">
								<div>
									<span class="status available"><?php echo escaparHtml($estado); ?></span>
									<h3>
										<?php echo escaparHtml($nombre); ?>
									</h3>

									<p class="student-id">
										Matrícula:
										<?php echo escaparHtml($matricula); ?>
									</p>
								</div>
								<span class="semester">
									<?php echo escaparHtml($cuatrimestre); ?>&ordm; cuatrimestre
								</span>
							</div>
							<div class="student-info">

								<div class="info-item">
									<p>Correo</p>
									<strong>
										<?php echo escaparHtml($correo); ?>
									</strong>
								</div>
								<div class="info-item">
									<p>Promedio</p>
									<strong>
										<?php echo escaparHtml($promedio); ?>
									</strong>
								</div>
							</div>
						</article>
					</div>
				</section>
			<?php } ?>
		</main>
		<footer class="site-footer">
			<div class="container">
				<p>Campus Web · Programación Web</p>
			</div>
		</footer>
	</body>
</html>