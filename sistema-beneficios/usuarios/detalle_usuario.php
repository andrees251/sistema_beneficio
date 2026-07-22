<?php

session_start();

if(!isset($_SESSION["idusuario"])){

    header("Location: ../login/login.php");
    exit;
}

if($_SESSION["rol"]!="admin"){

    header("Location: ../login/login.php");
    exit;
}

require_once "../conexion.php";

if (!isset($_POST["idusuario"])) {
    die("Usuario no encontrado.");
}

$idusuario = $_POST["idusuario"];

$sql = "SELECT * FROM usuarios WHERE idusuario = ?";

$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $idusuario);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    die("El Usuario no existe.");
}

$fila = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Detalle Usuario</title>
</head>

<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header">
            <h3>Detalle del Usuario</h3>
        </div>

        <div class="card-body">
            <p><strong>Nombre:</strong> <?php echo $fila["nombre"]; ?></p>
            <p><strong>Apellido:</strong> <?php echo $fila["apellido"]; ?></p>
            <p><strong>Dni:</strong> <?php echo $fila["dni"]; ?></p>
            <p><strong>Telefono:</strong> <?php echo $fila["telefono"]; ?></p>
            <p><strong>Email:</strong> <?php echo $fila["email"]; ?></p>
            <p><strong>Dirección:</strong> <?php echo $fila["direccion"]; ?></p>
            <p><strong>Rol:</strong> <?php echo $fila["rol"]; ?></p>

        </div>

        <div class="card-footer d-flex justify-content-between">

            <a href="gestionar_usuarios.php" class="btn btn-primary">
                Volver
            </a>

        </div>

        

    </div>

</div>

</body>
</html>