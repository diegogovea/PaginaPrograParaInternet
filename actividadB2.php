<?php
include 'conexion.php';

$query = "SELECT * FROM empleados WHERE activo = TRUE";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="estilos/estilo.css">

    <title>Listado de Empleados</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<style>
	
		h5 {
            background-color: #007bff; /* Fondo azul */
            color: #000; /* Texto negro */
            padding: 10px; /* Espaciado interno */
            text-align: center; /* Alineación centrada */
        }
</style>
</head>

<body>
	<?php include 'bienvenido.php';?>
	 <h5>LISTADO DE EMPLEADOS</h5>
    <div class="create-section">
        <a href="crear_usuario.php" class="btn-create">Crear nuevo registro</a>
    </div>
    <table>
        <thead>
            <tr>
                <th class="id">ID</th>
                <th class="nombre">Nombre completo</th>
                <th class="correo">Correo</th>
                <th class="rol">Rol</th>
                <th class="accion">Acción</th>
				
            </tr>
        </thead>
        <tbody>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre_completo']; ?></td>
            <td><?php echo $row['correo']; ?></td>
            <td><?php echo $row['rol']; ?></td>
			<td><a href="editar.php?id=<?php echo $row['id']; ?>" class="btn-edit">Editar</a></td>
            <td><button class="btn-delete" data-id="<?php echo $row['id']; ?>">Eliminar</button></td>
            <td><a href="detalles.php?id=<?php echo $row['id']; ?>" class="btn-view">Ver detalle</a></td>

        </tr>
    <?php endwhile; ?>
    
</tbody>

    </table>
	
	<script>
        var myScript = function() {
			$(document).ready(function() {
				$(".btn-delete").on('click', function() {
					var id = $(this).data('id');
					if (confirm('¿Desea eliminar este registro?')) {
						$.ajax({
							url: 'borrar_empleado.php',
							type: 'POST',
							data: {
								employee_id: id
							},
							success: function(response) {
								if (response == 'success') {
									$('button[data-id="' + id + '"]').closest('tr').remove();
								} else {
									alert('Hubo un error al eliminar el empleado.');
								}
							}
						});
					}
				});
			});
		};

myScript();

    </script>
</body>

</html>
