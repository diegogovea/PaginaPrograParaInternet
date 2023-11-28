<?php
include 'conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = 'not_exists';
 
    if (isset($_POST['correo'])) {
        $correo = $_POST['correo'];
        $query = "SELECT COUNT(*) AS count FROM empleados WHERE correo = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            $response = 'exists';
        }
    }

    echo $response;
}
