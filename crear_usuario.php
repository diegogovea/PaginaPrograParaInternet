<?php
include 'conexion.php';

$error_message = '';
$success_message = '';
$nombre = '';
$apellidos = '';
$correo = '';
$password = '';
$rol = '';

function validateInput($data) {
    return isset($_POST[$data]) && !empty($_POST[$data]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    if (!validateInput('nombre') || !validateInput('apellidos') || !validateInput('correo') || !validateInput('password') || !validateInput('rol')) {
        $error_message = 'Faltan campos por llenar.';
    } else {
        $query = "SELECT COUNT(*) AS count FROM empleados WHERE correo = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            $error_message = 'El correo ' . $correo . ' ya existe.';
        } else {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $nombre_completo = $nombre . ' ' . $apellidos;

            $query = "INSERT INTO empleados (nombre_completo, correo, password, rol, activo) VALUES (?, ?, ?, ?, TRUE)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $nombre_completo, $correo, $password, $rol);

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
