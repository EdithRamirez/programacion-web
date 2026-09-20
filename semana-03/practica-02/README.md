# PHP + HTML: Inventario dinámico

## Descripción

Convierte una página desarrollada con **HTML y CSS** en una página dinámica, integrando **PHP** con los elementos existentes.

## Requisitos

Genera de manera dinámica los siguientes apartados. No dejes la información indicada escrita de forma estática en el HTML.

- Título de la página e información general del almacén.
- Opciones del menú, agregando la clase `active` al enlace **Inicio**.
- Categorías disponibles.
- Información de los productos dentro de la tabla.
- Estado de cada producto como **Disponible**, **Bajo stock** o **Agotado**, según la cantidad existente.
- Resumen con la cantidad de productos registrados, el total de unidades disponibles y los productos agotados.
- Nombre del sitio en el pie de página.
- Conserva la estructura visual y los estilos proporcionados.

## Apoyo

La función `count()` permite conocer la cantidad de elementos almacenados dentro de un arreglo.

```php
count($arreglo);
```

La función `number_format()` permite dar formato a un valor numérico para facilitar su lectura.

```php
number_format($numero);
```

## Tecnologías utilizadas

- HTML5
- CSS3
- PHP
- XAMPP
- Visual Studio Code

## Estructura de archivos

```text
semana-03/
└── practica-02/
    ├── index.php
    └── css/
        └── style.css
```