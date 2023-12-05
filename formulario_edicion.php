<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
		<link rel="stylesheet" href="estilos/est_ingresar.css">

</head>
<body>

<?php
include 'conexion.php';

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['rol'])) {
        $error_message = 'Faltan campos por llenar.';
    } else {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $rol = $_POST['rol'];

        if (!empty($_FILES['foto']['name'])) {
            $query_select = "SELECT foto_nombre_real, foto_nombre_encriptado FROM empleados WHERE id = ?";
            $stmt_select = $conn->prepare($query_select);
            $stmt_select->bind_param("i", $employee_id);
            $stmt_select->execute();
            $stmt_select->bind_result($foto_nombre_real_anterior, $foto_nombre_encriptado_anterior);
            $stmt_select->fetch();
            $stmt_select->close();
 
            if ($foto_nombre_real_anterior) {
                unlink('fotos/' . $foto_nombre_encriptado_anterior);
            }

            $foto_nombre_real = $_FILES['foto']['name'];
			$foto_nombre_encriptado = md5($foto_nombre_real);
            $foto_temp = $_FILES['foto']['tmp_name'];
            move_uploaded_file($foto_temp, 'fotos/' . $foto_nombre_encriptado);

            $query = "UPDATE empleados SET nombre_completo = ?, correo = ?, rol = ?, foto_nombre_real = ?, foto_nombre_encriptado = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssssi", $nombre, $correo, $rol, $foto_nombre_real, $foto_nombre_encriptado, $employee_id);
        } else {
            $query = "UPDATE empleados SET nombre_completo = ?, correo = ?, rol = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssi", $nombre, $correo, $rol, $employee_id);
        }

        if ($stmt->execute()) {
            $success_message = 'Empleado actualizado con éxito.';
            header("Location: actividadB2.php");
            exit();
        } else {
            $error_message = 'Error al actualizar el empleado.';
        }
    }
}

// Obtener los datos del empleado para prellenar el formulario
if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];
    $query_select_employee = "SELECT nombre_completo, correo, rol FROM empleados WHERE id = ?";
    $stmt_select_employee = $conn->prepare($query_select_employee);
    $stmt_select_employee->bind_param("i", $employee_id);
    $stmt_select_employee->execute();
    $stmt_select_employee->bind_result($nombre_completo, $correo, $rol);
    $stmt_select_employee->fetch();
    $stmt_select_employee->close();
}
?>
<?php include 'bienvenido.php';?>

<h2>Editar Empleado</h2>

<form action="" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo isset($nombre_completo) ? $nombre_completo : ''; ?>" required>

    <br>

    <label for="correo">Correo:</label>
    <input type="email" name="correo" value="<?php echo isset($correo) ? $correo : ''; ?>" required>
	
	<br>
	
	<label for="password">Nueva Contraseña (opcional):</label>
    <input type="password" name="password" id="password">

    <br>

    <label for="rol">Rol:</label>
    <input type="text" name="rol" value="<?php echo isset($rol) ? $rol : ''; ?>" required>

    <br>

    <label for="foto">Foto:</label>
    <input type="file" name="foto">

    <br>

    <?php if (!empty($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>

    <?php if (!empty($success_message)) { ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php } ?>

    <input type="submit" value="Actualizar">
	<a href="actividadB2.php" class="btn-delete">Regresar al listado</a>
</form>

	<script>
        document.querySelector('form').addEventListener('submit', function(event) {
            const nombre = document.getElementById('nombre').value;
            const correo = document.getElementById('correo').value;
            const rol = document.getElementById('rol').value;

            if (!nombre || !correo || !rol) {
                event.preventDefault();
                document.getElementById('error-message').textContent = 'Faltan campos por llenar.';
                setTimeout(() => {
                    document.getElementById('error-message').textContent = '';
                }, 5000);
            }
        }); 
    </script>

</body>
</html>




    