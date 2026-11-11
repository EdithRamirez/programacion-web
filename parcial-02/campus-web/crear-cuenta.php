<?php

	session_start();
	require_once __DIR__ . "/config/conexion.php";
	require_once __DIR__ . "/includes/funciones.php";

	if(isset($_SESSION["usuario_id"])) {
		header("Location: panel.php");
		exit;
	}

	$paginaActual = "crear-cuenta";

	$nombre = "";
	$correo = "";
	$errores = [];
	$cuentaCreada = false;

	// Procesar el formulario
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		$nombre = trim($_POST["nombre"] ?? "");
		$correo = trim($_POST["correo"] ?? "");
		$password = $_POST["password"] ?? "";
		$confirmarPassword = $_POST["confirmar_password"] ?? "";

		if ($nombre === "") {
			$errores[] = "El nombre es obligatorio.";
		} elseif (strlen($nombre) < 3) {
			$errores[] = "El nombre debe tener al menos 3 caracteres.";
		}

		if ($correo === "") {
			$errores[] = "El correo es obligatorio.";
		} elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
			$errores[] = "El correo no tiene un formato válido.";
		}

		if ($password === "") {
			$errores[] = "La contraseña es obligatoria.";
		} elseif (strlen($password) < 8) {
			$errores[] = "La contraseña debe tener al menos 8 caracteres.";
		}

		if ($password !== $confirmarPassword) {
			$errores[] = "Las contraseñas no coinciden.";
		}
		// Continuar si no existen errores
		if (count($errores) === 0) {
			// Comprobar si el correo ya existe
			$consultaCorreo = mysqli_prepare($conexion, "SELECT id FROM usuarios WHERE correo = ?");

			mysqli_stmt_bind_param($consultaCorreo, "s", $correo);
			mysqli_stmt_execute($consultaCorreo);
			$resultadoCorreo = mysqli_stmt_get_result($consultaCorreo);

			if (mysqli_num_rows($resultadoCorreo) > 0) {
				$errores[] = "Ya existe una cuenta con ese correo.";
			} else {
				// Generar el hash de la contraseña
				$passwordHash = password_hash($password, PASSWORD_DEFAULT);
			
				// Asignar rol inicial
				$rol = "editor";

				// Preparar el registro del usuario
				$stmt = mysqli_prepare(
					$conexion,
					"INSERT INTO usuarios (nombre, correo, password, rol) VALUES (?, ?, ?, ?)"
				);
				mysqli_stmt_bind_param($stmt, "ssss", $nombre, $correo, $passwordHash, $rol);
				
				// Ejecutar el registro
				if (mysqli_stmt_execute($stmt)) {
					$cuentaCreada = true;
					$nombre = "";
					$correo = "";
				} else {
					$errores[] = "No fue posible crear la cuenta.";
				}
			}
		}
	}
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

	<?php require __DIR__ . "/includes/header.php"; ?>

	<main>
		<section class="hero compact">
			<div class="container">
				<span class="eyebrow">Cuenta de usuario</span>
				<h1>Crear cuenta</h1>
				<p>Regístrate para publicar contenido dentro de Campus Web.</p>
			</div>
		</section>

		<section class="section">
			<div class="container narrow">

				<?php if ($cuentaCreada) { ?>
					<div class="success-box">
						<strong>Cuenta creada correctamente.</strong>
						Ya puedes <a href="acceso.php">iniciar sesión</a>.
					</div>
				<?php } ?>

				<?php if (count($errores) > 0) { ?>
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
					<form action="crear-cuenta.php" method="POST">
						<div class="form-grid one-column">
							<div class="form-group">
								<label for="nombre">Nombre</label>
								<input type="text" id="nombre" name="nombre" value="<?php echo escaparHtml($nombre); ?>" autocomplete="name">
							</div>

							<div class="form-group">
								<label for="correo">Correo</label>
								<input type="email" id="correo" name="correo" value="<?php echo escaparHtml($correo); ?>" autocomplete="email">
							</div>

							<div class="form-group">
								<label for="password">Contraseña</label>
								<input type="password" id="password" name="password" autocomplete="new-password">
							</div>

							<div class="form-group">
								<label for="confirmar_password">Confirmar contraseña</label>
								<input type="password" id="confirmar_password" name="confirmar_password" autocomplete="new-password">
							</div>
						</div>

						<p class="form-note">Las cuentas creadas desde este formulario se registran con rol <strong>editor</strong>.</p>

						<div class="form-actions">
							<button type="submit">Crear cuenta</button>
						</div>
					</form>
				</div>
			</div>
		</section>
	</main>

	<?php require __DIR__ . "/includes/footer.php"; ?>

	</body>
</html>
