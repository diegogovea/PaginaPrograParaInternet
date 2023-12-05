<?php
include 'conexion.php'; 
 
if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    $query = "SELECT * FROM empleados WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre_completo'];
        $correo = $row['correo'];
        $rol = $row['rol'];

        include 'formulario_edicion.php';
    } else {
        echo 'Empleado no encontrado.';
    }
} else {
    echo 'ID de empleado no proporcionado.';
}
?>
<script>
    document.querySelector('form').addEventListener('submit', function(event) {


        const nombre = document.getElementById('nombre').value;
        const correo = document.getElementById('correo').value;
        const rol = document.getElementById('rol').value;

        $.ajax({
            url: 'verificar_correo.php',
            type: 'POST',
            data: { correo: correo, id: <?php echo $employee_id; ?> },
            success: function(response) {
                if (response === 'exists') {
                    document.getElementById('email-error').textContent = 'El correo ya está en uso por otro empleado.';
                } else {
                    // El correo es válido, enviar el formulario
                    document.querySelector('form').submit();
                }
            }
        });
    });
</script>

 