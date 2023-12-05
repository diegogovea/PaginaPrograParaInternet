<?php
include 'conexion.php';
 
$error_message = '';
$success_message = '';
$nombre = '';
$apellidos = '';
$correo = '';
$password = '';
$rol = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['correo']) || empty($_POST['password']) || empty($_POST['rol'])) {
        $error_message = 'Faltan campos por llenar.';
    } else {
        $correo = $_POST['correo'];
 
        $query = "SELECT COUNT(*) AS count FROM empleados WHERE correo = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            $error_message = 'El correo ' . $correo . ' ya existe.';
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $password = $_POST['password'];
            $rol = $_POST['rol'];
        } else {
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $rol = $_POST['rol'];

            $foto_nombre_real = null;
            $foto_nombre_encriptado = null;

            if (!empty($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $foto_nombre_real = $_FILES['foto']['name'];
                $foto_nombre_encriptado = md5($foto_nombre_real . time());

                $upload_directory = 'fotos/';
                $foto_ruta = $upload_directory . $foto_nombre_encriptado;

                if (!move_uploaded_file($_FILES['foto']['tmp_name'], $foto_ruta)) {
                    $error_message = 'Error al subir la foto.';
                }
            }

            $query = "INSERT INTO empleados (nombre_completo, correo, password, rol, activo, foto_nombre_real, foto_nombre_encriptado) VALUES (?, ?, ?, ?, TRUE, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssss", $nombre_completo, $correo, $password, $rol, $foto_nombre_real, $foto_nombre_encriptado);
            $nombre_completo = $nombre . ' ' . $apellidos;

            if ($stmt->execute()) {
                $success_message = 'Empleado agregado con éxito.';
                header("Location: actividadB2.php");
                exit();
            } else {
                $error_message = 'Error al agregar el empleado.';
            }
        }
    }
}
?>

