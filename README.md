# README - Listado de Empleados

Este repositorio contiene el código fuente de una página web que muestra un listado de empleados activos y permite realizar diversas acciones como editar, eliminar y ver detalles de cada empleado.

## Contenido del Repositorio

- **conexion.php**: Este archivo contiene la lógica de conexión a la base de datos.

- **estilo.css**: Hoja de estilos utilizada para dar formato a la página.

- **index.php**: Página principal que muestra el listado de empleados y permite realizar diversas acciones.

- **ingresar.php**: Página para crear un nuevo registro de empleado.

- **editar_empleado.php**: Página para editar la información de un empleado específico.

- **detalles.php**: Página que muestra detalles específicos de un empleado.

- **borrar_empleado.php**: Script que maneja la eliminación de un empleado a través de una solicitud AJAX.

## Uso

1. Asegúrese de tener una base de datos configurada y actualice las credenciales de conexión en el archivo `conexion.php`.

2. Acceda a la página principal (`index.php`) para ver el listado de empleados activos.

3. Utilice los enlaces proporcionados para crear un nuevo registro, editar un empleado, ver detalles o eliminar un empleado.

4. La eliminación de un empleado se realiza mediante una confirmación y se maneja de forma asíncrona a través de AJAX.

## Tecnologías Utilizadas

- HTML
- CSS
- PHP
- jQuery (incluido a través de CDN)

## Contribuciones

Si encuentra algún problema o tiene sugerencias para mejorar el código, no dude en abrir un problema o enviar una solicitud de extracción.

---

**Nota:** Este código asume que se ha configurado una base de datos con la tabla `empleados` que contiene los campos `id`, `nombre_completo`, `correo`, `rol` y `activo`.
