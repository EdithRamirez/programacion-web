<?php

	$compras = [
		[
			"producto" => "Monitor",
			"precio" => 4200,
			"cantidad" => 1,
			"clienteFrecuente" => true
		],
		[
			"producto" => "Teclado",
			"precio" => 650,
			"cantidad" => 2,
			"clienteFrecuente" => false
		],
		[
			"producto" => "Mouse",
			"precio" => 350,
			"cantidad" => 3,
			"clienteFrecuente" => true
		]
	];

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Compras</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>

		<h1>Resumen de compras</h1>
		<?php foreach ($compras as $compra) { ?>
			<?php
				// Calcular subtotal
				$subtotal = $compra["precio"] * $compra["cantidad"];

				// Aplicar descuento
				if ($subtotal >= 1000 && $compra["clienteFrecuente"]) {
					$descuento = $subtotal * 0.10;
				} else {
					$descuento = 0;
				}

				// Calcular total
				$total = $subtotal - $descuento;
			?>

			<div class="compra">

				<h2><?php echo $compra["producto"]; ?></h2>

				<p>Precio: $<?php echo number_format($compra["precio"], 2); ?></p>
				<!--Con el segundo parámetro, que es opcional, indicamos el número de decimales que queremos que aparezcan en el número formateado-->

				<p>Cantidad: <?php echo $compra["cantidad"]; ?></p>

				<p>Subtotal: $<?php echo number_format($subtotal, 2); ?></p>

				<?php if ($descuento > 0) { ?>

					<p class="con-descuento">Descuento: $<?php echo number_format($descuento, 2); ?></p>

				<?php } else { ?>
					<p class="sin-descuento">Sin descuento</p>
				<?php } ?>

				<p>Total: $<?php echo number_format($total, 2); ?></p>
			</div>
		<?php } ?>
	</body>
</html>