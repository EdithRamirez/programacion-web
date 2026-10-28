<?php
	session_start();

	//setcookie() guarda/envía la cookie al navegador; $_COOKIE permite recuperarla en solicitudes posteriores.
	require_once __DIR__ . "/includes/funciones.php";

	if(isset($_SESSION["usuario_id"])) {
		header("Location: panel.php");
		exit;
	}

	$paginaActual = "acceso";
	$usuarios = obtenerUsuarios();
	$correo = "";
	$error = "";
	if (isset($_COOKIE["correo_recordado"])) {
		$correo = $_COOKIE["correo_recordado"];
	}
	if (isset($_POST["enviar"])) {
		$correo = trim($_POST["correo"]);
		$password = $_POST["password"];

		// PRÁCTICA: buscar un usuario que coincida con las credenciales recibidas
		// isset() verifica, $_COOKIE recupera y setcookie() guarda.
		foreach ($usuarios as $usuario) { 
			if ( $usuario["correo"] === $correo && $usuario["password"] === $password) {

				// Guardar o eliminar la cookie
				if (isset($_POST["recordar"])) {
					setcookie("correo_recordado", $correo, time() + 3600, "/");
				} else {
					setcookie("correo_recordado", "", time() - 3600, "/");
				}

				// Guardar datos en la sesión
				$_SESSION["usuario_id"] = $usuario["id"];
				$_SESSION["nombre"] = $usuario["nombre"];
				$_SESSION["correo"] = $usuario["correo"];
				$_SESSION["rol"] = $usuario["rol"];

				header("Location: panel.php");
				exit;
			} else {
				$error = "Correo o contraseña incorrectos.";
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
					<span class="eyebrow">Área privada</span>
					<h1>Iniciar sesión</h1>
					<p>Accede a Campus Web utilizando una de las cuentas disponibles para esta práctica.</p>
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
							<!-- PRÁCTICA -->
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
