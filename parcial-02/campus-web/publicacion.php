<?php
	//editar comprobar en publicacion.php?id=1
	session_start();

	require_once __DIR__ . "/includes/funciones.php";
	require_once __DIR__ . "/config/conexion.php";

	// Proteger la página
	if (!isset($_SESSION["usuario_id"])) {
		header("Location: acceso.php");
		exit;
	}

	$paginaActual = "publicacion";

	// Determinar si se creará o editará una publicación
	//(int) convierte el valor a entero.
	//id = 0 nueva publicación
	$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;
	$modoEdicion = $id > 0;

	// Valores iniciales
	$titulo = "";
	$contenido = "";
	$errores = [];

	// Recuperar la publicación que se desea editar
	if ($modoEdicion) {

		// Buscar la publicación por id
		$stmt = mysqli_prepare(
			$conexion,
			"SELECT id, titulo, contenido, usuario_id FROM publicaciones WHERE id = ?"
		);

		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);

		// Obtener los datos de la publicación
		$resultado = mysqli_stmt_get_result($stmt);
		$publicacion = mysqli_fetch_assoc($resultado);

		// Redirigir si la publicación no existe
		if (!$publicacion) {
			header("Location: panel.php");
			exit;
		}

		// Comprobar permiso de edición
		/*
		 los (int) también son conversiones a entero, pero todo el if sí es una validación de permiso.
			Está comprobando:
			- que el usuario no sea admin, y
			- que su usuario_id no coincida con el propietario de la publicación.
		 */
		if ($_SESSION["rol"] !== "admin" &&(int) $_SESSION["usuario_id"] !== (int) $publicacion["usuario_id"]) {
			header("Location: panel.php");
			exit;
		}

		// Cargar los datos en el formulario
		$titulo = $publicacion["titulo"];
		$contenido = $publicacion["contenido"];
	}

	// Procesar el formulario
	if ($_SERVER["REQUEST_METHOD"] === "POST") {

		// Recuperar los datos enviados
		$id = (int) ($_POST["id"] ?? 0);
		$modoEdicion = $id > 0;
		//-----
		$titulo = trim($_POST["titulo"] ?? "");
		$contenido = trim($_POST["contenido"] ?? "");

		// Validar título
		if ($titulo === "") {
			$errores[] = "El título es obligatorio.";
		} elseif (strlen($titulo) < 4) {
			$errores[] = "El título debe tener al menos 4 caracteres.";
		}

		// Validar contenido
		if ($contenido === "") {
			$errores[] = "El contenido es obligatorio.";
		} elseif (strlen($contenido) < 10) {
			$errores[] = "El contenido debe tener al menos 10 caracteres.";
		}

		// Comprobar permiso antes de actualizar
		if ($modoEdicion) {

			$consulta = mysqli_prepare(
				$conexion,
				"SELECT usuario_id FROM publicaciones WHERE id = ?"
			);

			mysqli_stmt_bind_param($consulta, "i", $id);
			mysqli_stmt_execute($consulta);

			$resultadoConsulta = mysqli_stmt_get_result($consulta);
			$registro = mysqli_fetch_assoc($resultadoConsulta);
			//Redirige si la publicación no existe o si el usuario no tiene permiso para editarla.
			if (!$registro || ($_SESSION["rol"] !== "admin" && (int) $_SESSION["usuario_id"] !== (int) $registro["usuario_id"])) {
				header("Location: panel.php");
				exit;
			}
		}

		// Guardar si no existen errores
		if (count($errores) === 0) {
			if ($modoEdicion) {
				// Actualizar la publicación -> SET indica qué campos se van a modificar y qué nuevos valores recibirán.
				$stmt = mysqli_prepare(
					$conexion,
					"UPDATE publicaciones SET titulo = ?, contenido = ? WHERE id = ?"
				);

				mysqli_stmt_bind_param($stmt, "ssi", $titulo, $contenido, $id);

			} else {
				// Crear una nueva publicación
				$stmt = mysqli_prepare(
					$conexion,
					"INSERT INTO publicaciones (titulo, contenido, usuario_id) VALUES (?, ?, ?)"
				);

				// Relacionar la publicación con el usuario de la sesión
				$usuarioId = $_SESSION["usuario_id"];

				mysqli_stmt_bind_param($stmt, "ssi", $titulo, $contenido, $usuarioId);
			}

			// Ejecutar INSERT o UPDATE
			if (mysqli_stmt_execute($stmt)) {
				header("Location: panel.php");
				exit;
			}
			$errores[] = "No fue posible guardar la publicación.";
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $modoEdicion ? "Editar publicación" : "Nueva publicación"; ?> | Campus Web</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>

	<?php require __DIR__ . "/includes/header.php"; ?>

	<main>
		<section class="hero compact">
			<div class="container">
				<span class="eyebrow">Panel de contenido</span>

				<!-- Mostrar título según el modo -->
				<h1><?php echo $modoEdicion ? "Editar publicación" : "Nueva publicación"; ?></h1>

				<p><?php echo $modoEdicion ? "Actualiza el contenido seleccionado." : "Comparte un nuevo contenido en el portal."; ?></p>
			</div>
		</section>

		<section class="section">
			<div class="container narrow">

				<!-- Mostrar errores -->
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

					<!-- Conservar el id cuando se edita -->
					<form action="publicacion.php<?php echo $modoEdicion ? "?id=" . $id : ""; ?>" method="POST">
						<input type="hidden" name="id" value="<?php echo $modoEdicion ? (int) $id : 0; ?>">

						<div class="form-grid one-column">
							<div class="form-group">
								<label for="titulo">Título</label>
								<input type="text" id="titulo" name="titulo" value="<?php echo escaparHtml($titulo); ?>">
							</div>

							<div class="form-group">
								<label for="contenido">Contenido</label>
								<textarea id="contenido" name="contenido" rows="9"><?php echo escaparHtml($contenido); ?></textarea>
							</div>
						</div>

						<div class="form-actions inline-actions">

							<!-- Cambiar acción según el modo -->
							<button type="submit"><?php echo $modoEdicion ? "Guardar cambios" : "Publicar"; ?></button>

							<a class="button secondary" href="panel.php">Cancelar</a>
						</div>
					</form>
				</div>
			</div>
		</section>
	</main>

	<?php require __DIR__ . "/includes/footer.php"; ?>

	</body>
</html>