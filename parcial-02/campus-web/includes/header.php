<header class="site-header">
	<div class="container header-content">
		<a class="brand" href="index.php">Campus Web</a>

		<nav aria-label="Navegación principal">
			<ul>
				<li>
					<a href="index.php" class="<?php echo ($paginaActual === "inicio") ? "active" : ""; ?>">
						Inicio
					</a>
				</li>

			<!-- PRÁCTICA -->
			 <?php if (!isset($_SESSION["usuario_id"])) { ?>
				<li>
					<a href="acceso.php" class="<?php echo ($paginaActual === "acceso") ? "active" : ""; ?>">
						Iniciar sesión
					</a>
				</li>
			<?php } else { ?>
				<li>
					<a href="panel.php" class="<?php echo ($paginaActual === "panel") ? "active" : ""; ?>">
						Panel
					</a>
				</li>
				<li>
					<a href="cerrar-sesion.php">Cerrar sesión</a>
				</li>
			<?php } ?>
			</ul>
		</nav>
	</div>
</header>
