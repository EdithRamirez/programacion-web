<?php

	// Información general
	$tituloPagina = "Inventario Web";
	$nombreAlmacen = "Almacén Central";
	$responsable = "Área de Sistemas";
	$horario = "9:00 a 18:00 hrs.";
	$paginaActual = "Inicio";

	// Menú
	$menu = [
		[
			"nombre" => "Inicio",
			"url" => "index.php"
		],
		[
			"nombre" => "Productos",
			"url" => "productos.php"
		],
		[
			"nombre" => "Categorías",
			"url" => "categorias.php"
		],
		[
			"nombre" => "Inventario",
			"url" => "inventario.php"
		]
	];

	// Categorías
	$categorias = [
		"Computación",
		"Accesorios",
		"Audio",
		"Almacenamiento"
	];

	// Productos
	$productos = [
		[
			"nombre" => "Laptop",
			"categoria" => "Computación",
			"precio" => 14500,
			"stock" => 8
		],
		[
			"nombre" => "Mouse",
			"categoria" => "Accesorios",
			"precio" => 350,
			"stock" => 15
		],
		[
			"nombre" => "Teclado",
			"categoria" => "Accesorios",
			"precio" => 650,
			"stock" => 3
		],
		[
			"nombre" => "Monitor",
			"categoria" => "Computación",
			"precio" => 4200,
			"stock" => 0
		],
		[
			"nombre" => "Audífonos",
			"categoria" => "Audio",
			"precio" => 950,
			"stock" => 6
		]
	];

	// Resumen del inventario
	$totalProductos = count($productos);
	$totalUnidades = 0;
	$totalAgotados = 0;

	foreach ($productos as $producto) {
		$totalUnidades += $producto["stock"];
		if ($producto["stock"] == 0) {
			$totalAgotados++;
		}
	}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $tituloPagina; ?></title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header class="header">
			<div class="container header-content">
				<a href="#" class="logo"><?php echo $tituloPagina; ?></a>
				<nav class="nav">
					<ul>
						<?php foreach ($menu as $opcion) { ?>
							<li>
								<a href="<?php echo $opcion["url"]; ?>"
									class="<?php
										if ($opcion["nombre"] == $paginaActual) {
											echo "active";
										}
									?>">
									<?php echo $opcion["nombre"]; ?>
								</a>
							</li>
						<?php } ?>
					</ul>
				</nav>
			</div>
		</header>
		<main>
			<section class="hero">
				<div class="container">
					<p class="hero-label"><?php echo $nombreAlmacen; ?></p>
					<h1>Control de inventario</h1>
					<p class="hero-description">Consulta los productos registrados y conoce su categoría, precio, existencias y disponibilidad actual.</p>
					<div class="warehouse-info">
						<p>
							<strong>Responsable:</strong>
							<?php echo $responsable; ?>
						</p>
						<p>
							<strong>Horario:</strong>
							<?php echo $horario; ?>
						</p>
					</div>
				</div>
			</section>

			<section class="section">
				<div class="container">
					<div class="section-heading">
						<p class="section-label">Información general</p>
						<h2>Resumen del inventario</h2>
					</div>
					<div class="summary-grid">
						<article class="summary-card">
							<p>Productos registrados</p>
							<strong><?php echo $totalProductos; ?></strong>
						</article>

						<article class="summary-card">
							<p>Unidades disponibles</p>
							<strong><?php echo $totalUnidades; ?></strong>
						</article>

						<article class="summary-card">
							<p>Productos agotados</p>
							<strong><?php echo $totalAgotados; ?></strong>
						</article>
					</div>
				</div>
			</section>

			<section class="section section-light">
				<div class="container">
					<div class="section-heading">
						<p class="section-label">Clasificación</p>
						<h2>Categorías disponibles</h2>
					</div>
					<ul class="category-list">
						<?php foreach ($categorias as $categoria) { ?>
							<li><?php echo $categoria; ?></li>
						<?php } ?>
					</ul>
				</div>
			</section>

			<section class="section">
				<div class="container">
					<div class="section-heading">
						<p class="section-label">Existencias</p>
						<h2>Productos registrados</h2>
					</div>

					<div class="table-container">
						<table>
							<thead>
								<tr>
									<th>Producto</th>
									<th>Categoría</th>
									<th>Precio</th>
									<th>Stock</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($productos as $producto) { ?>
									<tr>
										<td><?php echo $producto["nombre"]; ?></td>

										<td><?php echo $producto["categoria"]; ?></td>

										<td>$<?php echo number_format($producto["precio"]); ?></td>

										<td><?php echo $producto["stock"]; ?></td>

										<td>
											<?php if ($producto["stock"] == 0) { ?>
												<span class="status unavailable">Agotado</span>
											<?php } elseif ($producto["stock"] <= 5) { ?>
												<span class="status low">Bajo stock</span>
											<?php } else { ?>
												<span class="status available">Disponible</span>
											<?php } ?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</section>
		</main>
		<footer class="footer">
			<div class="container">
				<p> <?php echo $tituloPagina; ?> &middot; Sistema académico de ejemplo</p>
			</div>
		</footer>
	</body>
</html>