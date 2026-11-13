<?php
	session_start();

	require_once __DIR__ . "/config/conexion.php";
	require_once __DIR__ . "/includes/funciones.php";

	$paginaActual = "publicacion";

	if (!isset($_SESSION["usuario_id"])) {
		header("Location: acceso.php");
		exit;
	}

	$esAdmin = isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin";

	$id = isset($_GET["id"]) ? (int) $_GET["id"] : (int) ($_POST["id"] ?? 0);

	if ($id <= 0) {
		header("Location: panel.php");
		exit;
	}

	if ($esAdmin && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["actualizar_estado"])) {
		$estadoId = (int) ($_POST["estado_id"] ?? 0);

		if ($estadoId > 0) {
			$stmtEstado = mysqli_prepare(
				$conexion, "UPDATE publicaciones SET estado_id = ? WHERE id = ?"
			);

			mysqli_stmt_bind_param($stmtEstado, "ii", $estadoId, $id);

			mysqli_stmt_execute($stmtEstado);

			header("Location: ver-publicacion.php?id=" . $id);
			exit;
		}
	}

	$stmt = mysqli_prepare(
		$conexion,
		"SELECT
			p.id,
			p.titulo,
			p.contenido,
			p.fecha_publicacion,
			p.usuario_id,
			p.estado_id,
			u.nombre AS autor,
			e.nombre AS estado
		FROM publicaciones p
		INNER JOIN usuarios u
			ON p.usuario_id = u.id
		INNER JOIN estados e
			ON p.estado_id = e.id
		WHERE p.id = ?"
	);

	mysqli_stmt_bind_param($stmt, "i", $id);
	mysqli_stmt_execute($stmt);

	$resultado = mysqli_stmt_get_result($stmt);
	$publicacion = mysqli_fetch_assoc($resultado);

	if (!$publicacion) {
		header("Location: panel.php");
		exit;
	}

	if (!$esAdmin &&(int) $_SESSION["usuario_id"] !== (int) $publicacion["usuario_id"]) {
		header("Location: panel.php");
		exit;
	}
	$consultaEstados = mysqli_query(
		$conexion,
		"SELECT id, nombre FROM estados ORDER BY id"
	);
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo escaparHtml($publicacion["titulo"]); ?> | Campus Web</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<?php require __DIR__ . "/includes/header.php"; ?>
		<main>
			<section class="hero compact">
				<div class="container">
					<span class="eyebrow">Detalle de publicación</span>
					<h1>
						<?php echo escaparHtml($publicacion["titulo"]); ?>
					</h1>
					<p>
						Publicada por
						<strong><?php echo escaparHtml($publicacion["autor"]); ?></strong>
						&bull;
						<?php echo escaparHtml(date("d/m/Y",strtotime($publicacion["fecha_publicacion"]))); ?>
					</p>
					<p>
						<strong>Estado:</strong>
						<?php echo escaparHtml($publicacion["estado"]); ?>
					</p>
				</div>
			</section>
			<section class="section">
				<div class="container">
					<div class="publication-detail">
						<article class="post-card">
							<h3>Contenido</h3>
							<p>
								<?php echo nl2br(escaparHtml($publicacion["contenido"])); ?>
							</p>

							<div class="inline-actions">
								<a class="button" href="publicacion.php?id=<?php echo (int) $publicacion["id"]; ?>">Editar</a>
								<a class="button secondary" href="panel.php">Volver al panel</a>
							</div>
						</article>

						<?php if ($esAdmin) { ?>
							<div class="form-card">
								<h3>Administrar publicación</h3>
								<p class="form-state"> Estado actual: <strong><?php echo escaparHtml($publicacion["estado"]); ?></strong></p>
								<hr class="line">
								<form action="ver-publicacion.php" method="POST">

									<input type="hidden" name="id" value="<?php echo (int) $publicacion["id"]; ?>">

									<div class="form-group">
										<label for="estado_id">Cambiar estado</label>
										<select id="estado_id" name="estado_id">

											<?php while ($estado = mysqli_fetch_assoc($consultaEstados)) { ?>
												<option
													value="<?php echo (int) $estado["id"]; ?>"
													<?php echo (int) $estado["id"] === (int) $publicacion["estado_id"] ? "selected" : ""; ?>>
													<?php echo escaparHtml($estado["nombre"]); ?>
												</option>

											<?php } ?>

										</select>
									</div>
									<div class="form-actions">
										<button type="submit" name="actualizar_estado">Actualizar estado</button>
									</div>
								</form>
							</div>
						<?php } ?>
					</div>
				</div>
			</section>
		</main>
		<?php require __DIR__ . "/includes/footer.php"; ?>
	</body>
</html>