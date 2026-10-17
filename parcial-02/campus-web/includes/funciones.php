<?php

	function escaparHtml($texto) {
		return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
	}

	function obtenerTituloPagina($pagina) {
		$titulos = [
			"inicio" => "Inicio",
			"acceso" => "Iniciar sesión",
			"panel" => "Panel"
		];

		return isset($titulos[$pagina]) ? $titulos[$pagina] : "Campus Web";
	}

	function obtenerUsuarios() {
		return [
			[
				"id" => 1,
				"nombre" => "Ana López",
				"correo" => "ana@campusweb.com",
				"password" => "1234",
				"rol" => "editor"
			],
			[
				"id" => 2,
				"nombre" => "Administrador",
				"correo" => "admin@campusweb.com",
				"password" => "5678",
				"rol" => "admin"
			]
		];
	}

	function obtenerPublicaciones() {
		return [
			[
				"titulo" => "Recursos para aprender PHP",
				"contenido" => "Materiales recomendados para continuar practicando PHP y fortalecer los temas vistos en clase.",
				"autor" => "Ana López",
				"fecha" => "14/10/2026"
			],
			[
				"titulo" => "Buenas prácticas en proyectos web",
				"contenido" => "Organizar archivos y reutilizar componentes facilita el mantenimiento de una aplicación web.",
				"autor" => "Administrador",
				"fecha" => "12/10/2026"
			],
			[
				"titulo" => "Preparando el segundo parcial",
				"contenido" => "Campus Web continuará creciendo durante las siguientes semanas con nuevos temas de PHP y MySQL.",
				"autor" => "Administrador",
				"fecha" => "10/10/2026"
			]
		];
	}

	function buscarUsuario($usuarios, $correo, $password) {
		// PRÁCTICA: buscar un usuario que coincida con las credenciales recibidas
	}

	function sesionIniciada() {
		// PRÁCTICA: comprobar si existe una sesión de usuario activa
	}

	function requerirSesion() {
		// PRÁCTICA: restringir el acceso cuando no exista una sesión activa
	}

	function esAdministrador() {
		// PRÁCTICA: comprobar si el usuario actual tiene rol de administrador
	}