# Validación de datos

## Descripción

Aplicar validaciones en **PHP** para comprobar la información recibida mediante formularios antes de procesarla o mostrarla en una página web.

## Instrucciones

- Utiliza los archivos HTML, CSS y PHP proporcionados.
- Recibe los datos enviados mediante formularios.
- Utiliza `isset()` para comprobar si los datos fueron enviados antes de utilizarlos.
- Utiliza `trim()` para eliminar espacios al inicio y al final de los valores recibidos.
- Comprueba que los campos obligatorios contengan información.
- Utiliza `strlen()` para validar la longitud de los datos cuando sea necesario.
- Utiliza `filter_var()` para validar el formato del correo electrónico.
- Comprueba que los valores numéricos se encuentren dentro del rango permitido.
- Almacena los mensajes de error en un arreglo.
- Recorre y muestra los errores mediante `foreach`.
- Procesa y muestra la información únicamente cuando los datos sean válidos.
- Utiliza `htmlspecialchars()` al mostrar datos recibidos del usuario.
- Comprueba el resultado desde localhost.

## Tecnologías utilizadas

- HTML5
- CSS3
- PHP
- XAMPP
- Visual Studio Code

## Estructura de archivos

```text
semana-05/
└── practica-01/
    ├── index.php
    ├── consulta.php
    ├── registro.html
    ├── registro.php
    ├── alumnos.php
    └── css/
        └── style.css
```
