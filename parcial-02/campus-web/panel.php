<?php
	require_once __DIR__ . "/includes/funciones.php";

	$paginaActual = "panel";
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
					<!-- PRÁCTICA -->
					<div class="profile-heading">
						<div>
							<span class="eyebrow">Área privada</span>
							<h1>Panel de usuario</h1>
							<p>usuario@campusweb.com</p>
						</div>
						<span class="role-badge editor">
							Editor
						</span>
					</div>

				</div>
			</section>

			<section class="section">
				<div class="container">

					<div class="section-heading">
						<div>
							<h2>Publicaciones</h2>
							<p class="section-description">
								Consulta y administra el contenido publicado en Campus Web.
							</p>
						</div>

						<a class="button" href="publicacion.php">
							Nueva publicación
						</a>
					</div>

					<div class="table-wrapper">
						<table class="content-table">
							<thead>
								<tr>
									<th>Título</th>
									<th>Autor</th>
									<th>Fecha</th>
									<th>Acciones</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>Recursos para aprender PHP</td>
									<td>Ana López</td>
									<td>15/10/2026</td>
									<td>
										<div class="table-actions">
											<a class="action-link" href="#">
												Editar
											</a>
											<button class="action-link danger" type="button">
												Eliminar
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td>Buenas prácticas en proyectos web</td>
									<td>Administrador</td>
									<td>14/10/2026</td>
									<td>
										<div class="table-actions">
											<a class="action-link" href="#">Editar</a>

											<button class="action-link danger" type="button">Eliminar</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="inline-actions">
						<a class="button secondary" href="index.php">
							Volver al inicio
						</a>
						<!-- PRÁCTICA -->
						<a class="button" href="cerrar-sesion.php">
							Cerrar sesión
						</a>
					</div>
				</div>
			</section>
		</main>

		<?php require __DIR__ . "/includes/footer.php"; ?>

	</body>
</html>