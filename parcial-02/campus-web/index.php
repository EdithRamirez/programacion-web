<?php
	session_start();
	require_once __DIR__ . "/includes/funciones.php";

	$paginaActual = "inicio";
	$publicaciones = obtenerPublicaciones();
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
			<section class="hero">
				<div class="container">
					<span class="eyebrow">Portal del campus</span>
					<h1>Campus Web</h1>
					<p>Consulta avisos, recursos y publicaciones compartidas por la comunidad del campus.</p>

					<!-- PRÁCTICA -->
					<?php if (!isset($_SESSION["usuario_id"])) { ?>
						<div class="hero-actions">
							<a class="button" href="acceso.php">Iniciar sesión</a>
						</div>
					<?php } else { ?>
						<div class="hero-actions">
							<a class="button" href="panel.php">Ir al panel</a>
						</div>
					<?php } ?>
			
				</div>
			</section>

			<section class="section">
				<div class="container">
					<div class="section-heading">
						<div>
							<h2>Publicaciones recientes</h2>
							<p class="section-description">Este contenido es público y puede consultarse sin iniciar sesión.</p>
						</div>
						<!-- PRÁCTICA -->
						<?php if (isset($_SESSION["usuario_id"])) { ?>
							<a class="button" href="publicacion.php">Nueva publicación</a>
						<?php } ?>
					</div>
					<div class="posts-grid">
						<?php if (count($publicaciones) > 0) { ?>

							<?php foreach ($publicaciones as $publicacion) { ?>
								<article class="post-card">
									<div class="post-meta">
										<span><?php echo escaparHtml($publicacion["autor"]); ?></span>
										<span><?php echo escaparHtml($publicacion["fecha"]); ?></span>
									</div>

									<h3><?php echo escaparHtml($publicacion["titulo"]); ?></h3>
									<p><?php echo escaparHtml($publicacion["contenido"]); ?></p>
								</article>
							<?php } ?>

						<?php } else { ?>

							<div class="empty-state">
								<h3>Aún no hay publicaciones</h3>
								<p>Cuando se agreguen contenidos aparecerán en esta sección.</p>
							</div>

						<?php } ?>
					</div>
					
				</div>
			</section>
		</main>

		<?php require __DIR__ . "/includes/footer.php"; ?>

	</body>
</html>
