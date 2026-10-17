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
				<li>
					<a href="acceso.php" class="<?php echo ($paginaActual === "acceso") ? "active" : ""; ?>">
						Iniciar sesión
					</a>
				</li>
			
				<li>
					<a href="panel.php" class="<?php echo ($paginaActual === "panel") ? "active" : ""; ?>">
						Panel
					</a>
				</li>
				<li>
					<a href="cerrar-sesion.php">Cerrar sesión</a>
				</li>
			
			</ul>
		</nav>
	</div>
</header>
