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

        $foto_nombre_real = $row['foto_nombre_real'];
        $foto_ruta = 'fotos/' . $row['foto_nombre_encriptado'];

    } else {
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
	<link rel="stylesheet" href="estilos/est_detalles.css">

</head>

<body>
	<?php include 'bienvenido.php';?>
    <h1>Detalle de Empleado</h1>
    <div class="container">
        <p><strong>Nombre completo:</strong> <?php echo $nombreCompleto; ?></p>
        <p><strong>Correo:</strong> <?php echo $correo; ?></p>
        <p><strong>Rol:</strong> <?php echo $rol; ?></p>
        <p><strong>Status:</strong> <?php echo $status; ?></p>
        <?php if (!empty($foto_nombre_real)) : ?>
            <img src="<?php echo $foto_ruta . '?timestamp=' . time(); ?>" alt="Foto de empleado" class="employee-photo">
        <?php else : ?>
            <p>No hay foto disponible.</p>
        <?php endif; ?>
    </div>
    <a href="actividadB2.php" class="btn-back">Regresar al listado</a>
</body>

</html>
