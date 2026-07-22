<?php

session_start();

require_once "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: login.php");
    exit;
}

$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

$sql = "SELECT * FROM usuarios WHERE email = ?";

$stmt = $conex->prepare($sql);

$stmt->bind_param("s", $email);

$stmt->execute();


$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {

    echo "<script>
            alert('Correo o contraseña incorrectos.');
            window.location='login.php';
          </script>";

    exit;
}

$usuario = $resultado->fetch_assoc();



if (!password_verify($password, $usuario["password_hash"])) {

    echo "<script>
            alert('Correo o contraseña incorrectos.');
            window.location='login.php';
          </script>";

    exit;
}


$_SESSION["idusuario"] = $usuario["idusuario"];
$_SESSION["nombre"] = $usuario["nombre"];
$_SESSION["apellido"] = $usuario["apellido"];
$_SESSION["email"] = $usuario["email"];
$_SESSION["rol"] = $usuario["rol"];


switch ($usuario["rol"]) {

    case "admin":

        header("Location: ../admin/inicio_admin.php");
        exit;

    case "vendedor":

        header("Location: ../vendedor/index.php");
        exit;

    case "usuario":

        header("Location: ../usuario/index.php");
        exit;

    default:

        session_destroy();

        echo "<script>
                alert('El usuario no tiene un rol asignado.');
                window.location='login.php';
              </script>";

        exit;
}