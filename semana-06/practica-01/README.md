# Organización y reutilización de código

## Descripción

Organiza una aplicación desarrollada con **PHP** separando el código reutilizable en archivos independientes mediante `include`, `require`, `include_once` y `require_once`.
La práctica parte de las páginas existentes de **Campus Web** y busca reducir código repetido sin modificar su funcionamiento.

## Instrucciones

### Parte guiada

- Crea la carpeta `includes/` dentro de la práctica.
- Revisa las diferencias entre `include`, `require`, `include_once` y `require_once`.
- Crea el archivo `includes/funciones.php`.
- Utiliza `consulta.php` como ejemplo para identificar y mover funciones reutilizables.
- Carga el archivo de funciones desde la página y comprueba que la consulta continúe funcionando correctamente.

### Trabajo de práctica

- Revisa `alumnos.php`, `registro.php` e `index.php` e identifica el código que puede reutilizarse.
- Elimina las funciones duplicadas de las páginas y carga el archivo de funciones donde sea necesario.
- Define títulos dinámicos en cada página.
- Modifica el menú para que se genere de manera dinámica a partir del arreglo `$menu`.
- Para asignar la clase `active` a la opción correspondiente utiliza:

```php
($paginaActual === $opcion["pagina"]) ? "active" : ""
```

- Identifica el código de navegación que se repite y sepáralo en `includes/nav.php`.
- Identifica el pie de página repetido y sepáralo en `includes/footer.php`.
- Sustituye el código repetido por la inclusión de los archivos correspondientes.
- Comprueba que todas las páginas conserven su navegación, estilos y funcionamiento.

## Tecnologías utilizadas

- HTML5
- CSS3
- PHP
- XAMPP
- Visual Studio Code

## Estructura de archivos

Al finalizar la práctica, la estructura deberá quedar organizada de la siguiente manera:

```text
semana-06/
└── practica-01/
    ├── index.php
    ├── consulta.php
    ├── registro.php
    ├── alumnos.php
    ├── includes/
    │   ├── funciones.php
    │   ├── nav.php
    │   └── footer.php
    └── css/
        └── style.css
```