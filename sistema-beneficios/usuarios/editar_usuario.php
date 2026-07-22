<?php

session_start();

if(!isset($_SESSION["idusuario"])){
    header("Location: ../login/login.php");
    exit;
}

if($_SESSION["rol"] != "admin"){
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
    die("Usuario no existe.");
}

$fila = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Editar Usuario</h2>

<form action="actualizar_usuario.php" method="post">

    <input type="hidden" name="idusuario" value="<?php echo $fila["idusuario"]; ?>">

    <div class="mb-3">
        <label>Nombre</label>
        <input
            type="text" name="nombre" class="form-control" value="<?php echo $fila["nombre"]; ?>">
    </div>

    <div class="mb-3">
        <label>Apellido</label>
        <input
            type="text" name="apellido" class="form-control" value="<?php echo $fila["apellido"]; ?>">
    </div>

    <div class="mb-3">
        <label>Dni</label>
        <input
            type="text" name="dni" class="form-control" value="<?php echo $fila["dni"]; ?>">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input
            type="email" name="email" class="form-control" value="<?php echo $fila["email"]; ?>">
    </div>

    <div class="mb-3">
        <label>Direccion</label>
        <input
            type="text" name="direccion" class="form-control" value="<?php echo $fila["direccion"]; ?>">
    </div>

    <label>Rol</label>
    <select name="rol" class="form-select">
        <option value="usuario">Usuario</option>

        <option value="vendedor">Vendedor</option>

        <option value="admin">Administrador</option>

    </select>

    <button class="btn btn-success mt-3"> Guardar Cambios </button>

    <a href="gestionar_usuarios.php" class="btn btn-secondary mt-3"> Cancelar </a>

</form>

</div>

</body>
</html>