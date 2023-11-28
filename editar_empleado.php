<?php
include 'conexion.php';

// Verificar si se ha enviado un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar los datos del empleado seleccionado
    $query = "SELECT * FROM empleados WHERE id = $id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre_completo = $row['nombre_completo'];
        $correo = $row['correo'];
        $rol = $row['rol'];
    } else {
        echo "Empleado no encontrado.";
        exit();
    }
} else {
    echo "ID de empleado no proporcionado.";
    exit();
}

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $nombre_completo_nuevo = $_POST['nombre_completo'];
    $correo_nuevo = $_POST['correo'];
    $rol_nuevo = $_POST['rol'];

    // Verificar si se proporcionó una nueva contraseña
    $nueva_contrasena = $_POST['password'];
    $contrasena_actualizada = !empty($nueva_contrasena) ? ", password = '$nueva_contrasena'" : "";

    // Actualizar los datos del empleado en la base de datos
    $query_update = "UPDATE empleados SET nombre_completo = '$nombre_completo_nuevo', correo = '$correo_nuevo', rol = '$rol_nuevo' $contrasena_actualizada WHERE id = $id";

    if ($conn->query($query_update) === TRUE) {
        echo "Datos actualizados correctamente.";
		 // Redirigir a la página actividadB2.php después de guardar
        header("Location: actividadB2.php");
    } else {
        echo "Error al actualizar los datos: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="est_ingresar.css">
    <title>Editar Empleado</title>
</head>

<body>
    <h1>Editar Empleado</h1>
    <form action="" method="post">
        <label for="nombre_completo">Nombre completo:</label>
        <input type="text" name="nombre_completo" value="<?php echo $nombre_completo; ?>" required>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" required onblur="checkEmail()" value="<?php echo $correo; ?>">
        <div id="email-exists" style="color: red;"></div>

		<label for="rol">Rol:</label>
        <select name="rol" id="rol" required>
            <option value="Gerente" <?php echo ($rol === 'Gerente') ? 'selected' : ''; ?>>Gerente</option>
            <option value="Ejecutivo" <?php echo ($rol === 'Ejecutivo') ? 'selected' : ''; ?>>Ejecutivo</option>
        </select>
		
        <label for="password">Nueva contraseña (opcional):</label>
        <input type="password" name="password">

        <button type="submit" class="btn-create" value="Guardar" disabled>Guardar cambios</button>
		<a href="actividadB2.php" class="btn-delete">Regresar al listado</a>
    </form>
	
	 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function checkEmail() {
        var correo = $('#correo').val();
        $.ajax({
            url: 'checar_correo.php',
            type: 'POST',
            data: { correo: correo },
            success: function(response) {
                if (response === 'exists') {
                    $('#email-exists').text('El correo ' + correo + ' ya existe.');
                    $('button[type="submit"]').prop('disabled', true); // Disable submit button
                } else {
                    $('#email-exists').text('');
                    $('button[type="submit"]').prop('disabled', false); // Enable submit button
                }
            }
        });
    }
</script>

</body>

</html>
