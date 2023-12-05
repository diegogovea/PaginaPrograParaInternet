<?php
include 'conexion.php';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$incompleteDataError = '';
$incorrectCredentialsError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $pass = $_POST["pass"];

    if (empty($correo) || empty($pass)) {
        $incompleteDataError = 'Los campos no pueden estar vacíos.';
    } else {
        $sql = "SELECT * FROM empleados WHERE correo = '$correo'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedPass = $row["password"];

//Aqui es donde se inicializan el resto de variables.
            if (password_verify($pass, $storedPass)) {
				 session_start();
                $_SESSION['nombre_completo'] = $row["nombre_completo"]; 
                $_SESSION['id_usuario'] = $row["id"];
				$_SESSION['correo_usuario'] = $row["correo"];
				$_SESSION['rol_usuario'] = $row["rol"];
				$_SESSION['activo_usuario'] = $row["activo"];
				
                header("Location: bienvenido.php");
                exit();
            } else {
                $incorrectCredentialsError = 'Datos incorrectos.';
            }
        } else {
            $incorrectCredentialsError = 'Datos incorrectos.';
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
	<link rel="stylesheet" href="estilos/est_login.css">
</head> 
<body>
    <form name="form" id="form" method="post" action="" onsubmit="return valForm()">
        <h2>Login</h2>
        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" placeholder="Escribe tu correo" />
        <label for="pass">Contraseña:</label>
        <input type="password" name="pass" id="pass" placeholder="Escribe tu contraseña" />
        <div class="error-message" id="error-container"><?php echo $incompleteDataError . $incorrectCredentialsError; ?></div>
        <input type="submit" value="Enviar" class="btn-create" />
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function valForm() {
            var correo = document.getElementById('correo').value;
            var pass = document.getElementById('pass').value;

            if (correo.trim() === '' || pass.trim() === '') {
                document.getElementById('error-container').innerHTML = 'Los campos no pueden estar vacíos.';
                return false;
            } else {
                document.getElementById('error-container').innerHTML = '';
                return true; 
            }
        }
    </script>
</body>
</html>
