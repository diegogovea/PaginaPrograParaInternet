<?php
session_start();
 
if (!isset($_SESSION['nombre_completo'])) {
    header("Location: index.php");
    exit();
}

$nombre_completo = $_SESSION['nombre_completo'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

	 <style>
        /* Estilo general del cuerpo de la página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Encabezado h1 */
        h1 {
            
			background-color: #f0f0f0; /* Fondo gris claro */
			color: #007bff; /* Texto azul claro */
			text-align: center;
			padding: 20px;


        }

        /* Estilo de la sección de creación */
        .create-section {
            text-align: right;
            margin: 20px;
            text-align: center;
        }

        /* Estilo del botón de creación */
        .btn-create {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #9c27b0; /* Morado claro */
            color: #fff;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Estilo de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        /* Estilo de las celdas del encabezado de la tabla */
        th {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: left;
        }

        /* Alternar colores de filas en la tabla */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Estilo de las celdas de datos */
        td {
            padding: 10px;
        }

        /* Estilo del botón de eliminar */
        .btn-delete {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #9c27b0; /* Morado claro */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>

    <title>Listado de Empleados</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<style>

	</style>
</head>

<body>
    <h1>Sesión de <?php echo $nombre_completo; ?> </h1>

    <table>
        <thead>
            <tr>
                <th><a href="bienvenido.php"><button class="btn-delete">Inicio</button></a></th>
                <th><a href="actividadB2.php"><button class="btn-delete">Administradores</button></a></th>
                <th><a href="productos/listaProductos.php"><button class="btn-delete">Productos</button></th>
                <th><button class="btn-delete">Banners</button></th>
                <th><button class="btn-delete">Pedidos</button></th>
                <th><button class="btn-delete">Cerrar Sesión</button></th>
            </tr>

        </thead>
    </table>
	
</body>

</html>
