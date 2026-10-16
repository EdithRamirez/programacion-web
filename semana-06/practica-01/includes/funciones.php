<?php 

	function obtenerTituloPagina($pagina) {
		if ($pagina === "inicio") {
			return "Inicio";
		} elseif ($pagina === "consulta") {
			return "Consulta";
		} elseif ($pagina === "registro") {
			return "Registro";
		} elseif ($pagina === "alumnos") {
			return "Alumnos";
		}
		return "Campus Web";
	}

	function escaparHtml($texto) {
		return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
	}

	function buscarAlumno($alumnos, $matricula) {
		foreach ($alumnos as $alumno) {
			if ($alumno["matricula"] === $matricula) {
				return $alumno;
			}
		}
		return null;
	}

	function obtenerAlumnos() {
		$contenido = file_get_contents(
			__DIR__ . "/../data/alumnos.json"
		);

    	return json_decode($contenido, true);
	}
