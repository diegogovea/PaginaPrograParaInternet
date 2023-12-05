<?php
include 'ingresar.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Alta de Empleados</title>
  	<link rel="stylesheet" href="estilos/est_ingresar.css">

</head>

<body>
<?php include 'bienvenido.php';?>
    <h1>Alta de Empleados</h1>
    <div id="error-message"><?php echo $error_message; ?></div>
    <div id="success-message"><?php echo $success_message; ?></div>
    <form method="POST" action="ingresar.php" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required value="<?php echo $nombre; ?>">

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" required value="<?php echo $apellidos; ?>">

        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" required onblur="checkEmail()" value="<?php echo $correo; ?>">
        <div id="email-exists" style="color: red;"></div>
 
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required value="<?php echo $password; ?>">

        <label for="rol">Rol:</label>
        <select name="rol" id="rol" required>
            <option value="Gerente" <?php echo ($rol === 'Gerente') ? 'selected' : ''; ?>>Gerente</option>
            <option value="Ejecutivo" <?php echo ($rol === 'Ejecutivo') ? 'selected' : ''; ?>>Ejecutivo</option>
            </select>

		<label for="foto">Foto:</label>
		<input type="file" name="foto" accept="image/*"><br><br>

<input type="submit" value="Guardar" class="btn-create">
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
                        setTimeout(function() {
                            $('#email-exists').text('');
                        }, 5000);
                    } else {
                        $('#email-exists').text('');
                    }
                }
            });
        }
    </script>
</body>
</html> 