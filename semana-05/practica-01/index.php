<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Inicio | Campus Web</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header class="site-header">
			<div class="container header-content">
				<div class="brand">Campus Web</div>

				<nav>
					<ul>
						<li><a class="active" href="index.php">Inicio</a></li>
						<li><a href="consulta.php">Consulta</a></li>
						<li><a href="registro.php">Registro</a></li>
						<li><a href="alumnos.php">Alumnos</a></li>
					</ul>
				</nav>
			</div>
		</header>

		<main>
			<section class="hero">
				<div class="container">
					<h1>Campus Web</h1>
					<p>Sistema académico de práctica para consultar, registrar y visualizar información de alumnos.</p>
				</div>
			</section>

			<section class="section">
				<div class="container">
					<h2>Opciones disponibles</h2>
					<p class="section-description">Utiliza las diferentes páginas para trabajar con la información de los alumnos.</p>

					<div class="grid">
						<article class="card">
							<h3>Consulta</h3>
							<p>Busca un alumno mediante su matrícula utilizando el método GET.</p>
							<a class="button" href="consulta.php">Consultar</a>
						</article>

						<article class="card">
							<h3>Registro</h3>
							<p>Captura información mediante un formulario enviado con POST.</p>
							<a class="button" href="registro.php">Registrar</a>
						</article>

						<article class="card">
							<h3>Alumnos</h3>
							<p>Visualiza la información de los alumnos disponibles en el sistema.</p>
							<a class="button" href="alumnos.php">Ver alumnos</a>
						</article>
					</div>
				</div>
			</section>
		</main>

		<footer class="site-footer">
			<div class="container">
				<p>Campus Web · Programación Web</p>
			</div>
		</footer>
	</body>
</html>
