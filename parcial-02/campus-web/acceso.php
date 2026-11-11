<?php
	session_start();
	require_once __DIR__ . "/config/conexion.php";
	require_once __DIR__ . "/includes/funciones.php";
	
	// Redirigir si ya existe una sesión
	if(isset($_SESSION["usuario_id"])) {
		header("Location: panel.php");
		exit;
	}

	$paginaActual = "acceso";
	// Recuperar correo guardado en la cookie
	$correo = $_COOKIE["correo_recordado"] ?? "";
	$error = "";

	// Procesar el formulario
	if ($_SERVER["REQUEST_METHOD"] === "POST") {

		// Recuperar los datos enviados
		$correo = trim($_POST["correo"] ?? "");
		$password = $_POST["password"] ?? "";

		// Buscar el usuario por correo
		$stmt = mysqli_prepare(
			$conexion,
			"SELECT id, nombre, correo, password, rol FROM usuarios WHERE correo = ? LIMIT 1"
		);

		// Asociar el correo
		mysqli_stmt_bind_param($stmt, "s", $correo);

		// Ejecutar la consulta
		mysqli_stmt_execute($stmt);

		// Obtener el resultado
		$resultado = mysqli_stmt_get_result($stmt);

		// Obtener los datos del usuario
		$usuario = mysqli_fetch_assoc($resultado);

		// Verificar usuario y contraseña
		if ($usuario && password_verify($password, $usuario["password"])) {

			// Guardar datos en la sesión
			$_SESSION["usuario_id"] = $usuario["id"];
			$_SESSION["nombre"] = $usuario["nombre"];
			$_SESSION["correo"] = $usuario["correo"];
			$_SESSION["rol"] = $usuario["rol"];

			// Guardar o eliminar la cookie
			if (isset($_POST["recordar"])) {
				setcookie("correo_recordado", $correo, time() + (60 * 60 * 24 * 30), "/");
			} else {
				setcookie("correo_recordado", "", time() - 3600, "/");
			}

			header("Location: panel.php");
			exit;
		}

		$error = "Correo o contraseña incorrectos.";
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
					<span class="eyebrow">Área privada</span>
					<h1>Iniciar sesión</h1>
					<!--Ajuste de texto -->
					<p>Accede a tu cuenta para ingresar al panel de Campus Web.</p>
				</div>
			</section>

			<section class="section">
				<div class="container narrow">
					<?php if ($error !== "") { ?>
						<div class="error-box">
							<?php echo escaparHtml($error); ?>
						</div>
					<?php } ?>

					<div class="form-card">
						<form action="acceso.php" method="POST">
							<div class="form-grid one-column">
								<div class="form-group">
									<label for="correo">Correo</label>
									<input type="email" id="correo" name="correo" value="<?php echo escaparHtml($correo); ?>" >
								</div>

								<div class="form-group">
									<label for="password">Contraseña</label>
									<input type="password" id="password" name="password">
								</div>
							</div>
							<label class="remember-option">
								<input type="checkbox" name="recordar" <?php echo ($correo !== "") ? "checked" : ""; ?>>
								Recordar correo
							</label>

							<div class="form-actions">
								<button type="submit" name="enviar">Ingresar</button>
							</div>
						</form>
					</div>
				</div>
			</section>
		</main>

		<?php require __DIR__ . "/includes/footer.php"; ?>

	</body>
</html>
