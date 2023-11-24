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
    $username = $_POST['txtusuario'];
    $password = $_POST['txtcontrasena'];
    $perfil = $_POST['selecciona'];

    if ($perfil === "Aprendiz") {
        $sql = "SELECT aprRol FROM tblaprendices WHERE aprDocumento = ? AND aprContrasena = ?";
    } elseif ($perfil === "Instructor") {
        $sql = "SELECT insRol FROM tblinstructores WHERE insDocumento = ? AND insContrasena = ?";
    } elseif ($perfil === "Administrador") {
        $sql = "SELECT admRol FROM tbladministracion WHERE admDocumento = ? AND admContrasena = ?";
    } elseif ($perfil === "Psicologo") {
        $sql = "SELECT pscRol FROM tblpsicologos WHERE pscDocumento = ? AND pscContrasena = ?";
    } else {
        $error = "Perfil no válido";
    }

    if (isset($sql)) {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION['txtusuario'] = $username;
            $_SESSION['txtcontrasena'] = $password;
            $_SESSION['perfil'] = $perfil;


            switch ($perfil) {
                case "Aprendiz":
                    header("Location: aprendiz/aprendiz.php");
                    break;
                case "Instructor":
                    header("Location: instructor/inst.php");
                    break;
                case "Administrador":
                    header("Location: administrador/admin.php");
                    break;
                case "Psicologo":
                    header("Location: psicologo/psicologo.php");
                    break;
                default:
                    $error = "Perfil no válido";
                    break;
            }
        } else {
            $error = "Credenciales incorrectas";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="wrapper">
    <form method="POST" action="Login.php">
        <h1>Login</h1>
        <div class="profile">
            <select name="selecciona">
                <option value="opcion0" selected> Elija su perfil</option>
                <option value="Aprendiz">Aprendiz</option>
                <option value="Instructor">Instructor</option>
                <option value="Administrador">Administrador</option>
                <option value="Psicologo">Psicologo</option>
            </select>
        </div>
        <div class="input-box">
            <input type="text" placeholder="usuario" name="txtusuario" required>
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <input type="password" placeholder="contrasena" name="txtcontrasena" required>
            <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox"> Recuérdame
                    </label>
                </div>
            </div>
        </div>
        <br>
        <div class="social-auth-links text-center">
            <p>- Verificación Credenciales -</p>
            <div class="alert alert-dark" role="alert">
                <?php echo isset($error) ? $error : ""; ?>
            </div>
        </div>
        <br>
        <input type="submit" class="btn" name="accion" value="INGRESAR">
    </form>
    <div class="register-link">
        <p> ¿No tienes una cuenta?
            <a href="#">Registrarse</a></p>
    </div>
    <div class="contenedor"></div>
</div>
</body>
</html>
