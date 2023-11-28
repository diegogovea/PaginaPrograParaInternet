<?php
include 'conexion.php';


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $employee_id = $_GET['id'];


    $query = "SELECT * FROM empleados WHERE id = $employee_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombreCompleto = $row['nombre_completo'];
        $correo = $row['correo'];
        $rol = $row['rol'];
        $status = $row['activo'] ? 'Activo' : 'Inactivo';
    } else {
        exit();
    }
} else {
    
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalle de Empleado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #007BFF;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin: 20px;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        .btn-back {
            display: block;
            text-align: center;
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px auto;
            width: 150px;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Detalle de Empleado</h1>
    <div class="container">
        <p><strong>Nombre completo:</strong> <?php echo $nombreCompleto; ?></p>
        <p><strong>Correo:</strong> <?php echo $correo; ?></p>
        <p><strong>Rol:</strong> <?php echo $rol; ?></p>
        <p><strong>Status:</strong> <?php echo $status; ?></p>
    </div>
    <a href="actividadB2.php" class="btn-back">Regresar al listado</a>
</body>

</html>
