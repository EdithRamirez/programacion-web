<?php
	session_start();

	require_once __DIR__ . "/config/conexion.php";
	require_once __DIR__ . "/includes/funciones.php";

	$paginaActual = "panel";

	// 1. Proteger la página
	if (!isset($_SESSION["usuario_id"])) {
		header("Location: acceso.php");
		exit;
	}

	// 2. Identificar el rol del usuario
	$esAdmin = isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin";

	// 3. Preparar la consulta según el rol
	if ($esAdmin) {

		// El administrador consulta todas las publicaciones
		// p y e son alias para escribir las consultas de forma más breve.
		// recupera el campo nombre de la tabla estados, pero devuélvelo con el nombre estado.
		$stmt = mysqli_prepare(
			$conexion,
			"SELECT
				p.id,
				p.titulo,
				p.fecha_publicacion,
				p.usuario_id,
				u.nombre AS autor,
				e.nombre AS estado
			FROM publicaciones p
			INNER JOIN usuarios u
				ON p.usuario_id = u.id
			INNER JOIN estados e
				ON p.estado_id = e.id
			ORDER BY p.fecha_publicacion DESC"
		);

	} else {

		// El editor consulta únicamente sus publicaciones
		$stmt = mysqli_prepare(
			$conexion,
			"SELECT
				p.id,
				p.titulo,
				p.fecha_publicacion,
				p.usuario_id,
				e.nombre AS estado
			FROM publicaciones p
			INNER JOIN estados e
				ON p.estado_id = e.id
			WHERE p.usuario_id = ?
			ORDER BY p.fecha_publicacion DESC"
		);

		// Relacionar la consulta con el usuario de la sesión
		$usuarioId = $_SESSION["usuario_id"];

		mysqli_stmt_bind_param($stmt, "i", $usuarioId);
	}

	// 4. Ejecutar la consulta y obtener los resultados
	mysqli_stmt_execute($stmt);

	$publicaciones = mysqli_stmt_get_result($stmt);
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
					<div class="profile-heading">
						<div>
							<span class="eyebrow">Área privada</span>
							<h1>Hola, <?php echo escaparHtml($_SESSION["nombre"]); ?></h1>
							<p><?php echo escaparHtml($_SESSION["correo"]); ?></p>
						</div>
						<span class="role-badge <?php echo $esAdmin ? "admin" : "editor"; ?>">
							<?php echo $esAdmin ? "Administrador" : "Editor";?>
						</span>
					</div>
				</div>
			</section>

			<section class="section">
				<div class="container">
					<div class="section-heading">
						<div>
							<!-- 6. Cambiar el contenido según el rol -->
							<h2>
								<?php echo $esAdmin ? "Gestión de publicaciones" : "Mis publicaciones";?>
							</h2>
							<p class="section-description">
								<?php echo $esAdmin ? "Revisa y administra las publicaciones del portal." : "Consulta y administra tus publicaciones.";?>
							</p>
						</div>
						<a class="button" href="publicacion.php">Nueva publicación</a>
					</div>
					<div class="table-wrapper">
						<table class="content-table">
							<thead>
								<tr>
									<th>Título</th>
									<!-- Mostrar autor únicamente al administrador -->
									<?php if ($esAdmin) { ?>
										<th>Autor</th>
									<?php } ?>
									<th>Fecha</th>
									<th>Estado</th>
									<th>Acciones</th>
								</tr>
							</thead>

							<tbody>
								<!-- 7. Mostrar las publicaciones recuperadas de MySQL -->
								<?php if (mysqli_num_rows($publicaciones) > 0) { ?>
									<?php while ($publicacion = mysqli_fetch_assoc($publicaciones)) { ?>
										<tr>
											<td>
												<?php echo escaparHtml($publicacion["titulo"]); ?>
											</td>

											<!-- El administrador puede identificar al autor -->
											<?php if ($esAdmin) { ?>
												<td>
													<?php echo escaparHtml($publicacion["autor"]); ?>
												</td>
											<?php } ?>
											<td>
												<!-- Transforma un texto inglés en timestamp -->
												<?php echo escaparHtml(date("d/m/Y", strtotime($publicacion["fecha_publicacion"]))); ?>
											</td>
											<td>
												<?php echo escaparHtml($publicacion["estado"]); ?>
											</td>
											<td>
												<div class="table-actions">
													<!-- 8. Ver la publicación -->
													<a class="action-link" href="ver-publicacion.php?id=<?php echo (int) $publicacion["id"]; ?>">
														Ver
													</a>
													<!-- 9. Editor y administrador pueden editar -->
													<a class="action-link" href="publicacion.php?id=<?php echo (int) $publicacion["id"]; ?>">
														Editar
													</a>

													<!-- 10. Eliminar únicamente como administrador -->
													<?php if ($esAdmin) { ?>

														<form action="eliminar-publicacion.php" method="POST" onsubmit="return confirm('¿Eliminar esta publicación?');">
															<input type="hidden" name="id" value="<?php echo (int) $publicacion["id"]; ?>">
															<button class="action-link danger" type="submit">Eliminar</button>
														</form>
													<?php } ?>
												</div>
											</td>
										</tr>
										
									<?php } ?>
								<?php } else { ?>
									<tr>
										<td colspan="<?php echo $esAdmin ? 5 : 4; ?>">
											No hay publicaciones para mostrar.
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>

					<div class="inline-actions">
						<a class="button secondary" href="index.php">Volver al inicio</a>
						<a class="button" href="cerrar-sesion.php">Cerrar sesión</a>
					</div>
				</div>
			</section>
		</main>
		<?php require __DIR__ . "/includes/footer.php"; ?>
	</body>
</html>