<?php
$servername = "localhost:1900";
$username = "root";
$password = "2556229";
$dbname = "saba";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $documento = $_POST['documento'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol'];

    // Utiliza sentencias preparadas para prevenir inyecciones SQL
    $stmt = null;

    switch ($rol) {
        case "Aprendiz":
            $campoAdicional = $_POST['campo_aprendiz'];
            $stmt = $conn->prepare("INSERT INTO tblaprendices (aprNombre, aprDocumento, contrasena, campo_adicional) VALUES (?, ?, ?, ?)");
            break;
        case "Instructor":
            $campoAdicional = $_POST['campo_instructor'];
            $stmt = $conn->prepare("INSERT INTO tblinstructores (insId, insNombre, insApellido, insTd, insDocumento, insFechaNacimiento, insCorreo, insEstadoCivil, insSexo, 
                             insDireccion, insTelefono, insCelular, insFechaIngreso, tblambientes_ambId, insRol, insContrasena) VALUES (?, ?, ?, ?)");
            break;
        case "Administrador":
            $campoAdicional = $_POST['campo_administrador'];
            $stmt = $conn->prepare("INSERT INTO tbladministracion (nombre, documento, contrasena, campo_adicional) VALUES (?, ?, ?, ?)");
            break;
        case "Psicologo":
            $campoAdicional = $_POST['campo_psicologo'];
            $stmt = $conn->prepare("INSERT INTO tblpsicologos (nombre, documento, contrasena, campo_adicional) VALUES (?, ?, ?, ?)");
            break;
        default:
            $error = "Rol no válido";
            break;
    }

    if ($stmt) {
        $stmt->bind_param("ssss", $nombre, $documento, $contrasena, $campoAdicional);
        $stmt->execute();

        // Redireccionar a la página correspondiente según el rol
        switch ($rol) {
            case "Aprendiz":
                header("Location: pagina_aprendiz.php");
                break;
            case "Instructor":
                header("Location: pagina_instructor.php");
                break;
            case "Administrador":
                header("Location: pagina_administrador.php");
                break;
            case "Psicologo":
                header("Location: pagina_psicologo.php");
                break;
            default:
                $error = "Rol no válido";
                break;
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Registro</title>
</head>

<body>
<h2>Registro de Usuario</h2>
<form method="post" action="">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required><br>

    <label for="documento">Documento:</label>
    <input type="text" name="documento" required><br>

    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" required><br>

    <label for="rol">Rol:</label>
    <select name="rol" id="rol" onchange="mostrarCampos()">
        <option value="Aprendiz">Aprendiz</option>
        <option value="Instructor">Instructor</option>
        <option value="Administrador">Administrador</option>
        <option value="Psicologo">Psicologo</option>
    </select><br>

    <!-- Campos adicionales específicos para cada rol -->
    <div id="campo_aprendiz" style="display:none;">
        <label for="campo_aprendiz">Campo Aprendiz:</label>
        <input type="text" name="campo_aprendiz">
    </div>

    <div id="campo_instructor" style="display:none;">
        <label for="campo_instructor">Campo Instructor:</label>
        <input type="text" name="campo_instructor">
    </div>

    <div id="campo_administrador" style="display:none;">
        <label for="campo_administrador">Campo Administrador:</label>
        <input type="text" name="campo_administrador">
    </div>

    <div id="campo_psicologo" style="display:none;">
        <label for="campo_psicologo">Campo Psicologo:</label>
        <input type="text" name="campo_psicologo">
    </div>

    <input type="submit" value="Registrar">
</form>

<script>
    function mostrarCampos() {
        var rol = document.getElementById("rol").value;

        // Oculta todos los campos adicionales
        var campos = ["campo_aprendiz", "campo_instructor", "campo_administrador", "campo_psicologo"];
        for (var i = 0; i < campos.length; i++) {
            document.getElementById(campos[i]).style.display = "none";
        }

        // Muestra el campo adicional correspondiente al rol seleccionado
        document.getElementById("campo_" + rol).style.display = "block";
    }
</script>
</body>

</html>
