<?php

$menu = [
    [
        "pagina" => "inicio",
        "texto" => "Inicio",
        "url" => "index.php"
    ],
    [
        "pagina" => "consulta",
        "texto" => "Consulta",
        "url" => "consulta.php"
    ],
    [
        "pagina" => "registro",
        "texto" => "Registro",
        "url" => "registro.php"
    ],
    [
        "pagina" => "alumnos",
        "texto" => "Alumnos",
        "url" => "alumnos.php"
    ]
];

?>

<header class="site-header">
    <div class="container header-content">

        <div class="brand">Campus Web</div>

        <nav>
            <ul>
                <?php foreach ($menu as $opcion) { ?>
                    <li>
                        <a
                            href="<?php echo $opcion["url"]; ?>"
                            class="<?php echo ($paginaActual === $opcion["pagina"]) ? "active" : ""; ?>"
                        >
                            <?php echo $opcion["texto"]; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>

    </div>
</header>