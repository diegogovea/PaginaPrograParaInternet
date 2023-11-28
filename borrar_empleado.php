<?php
include 'conexion.php';

if(isset($_POST['employee_id'])) {
    $id = $_POST['employee_id'];
    
    $query = "UPDATE empleados SET activo = FALSE WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    if($result) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
