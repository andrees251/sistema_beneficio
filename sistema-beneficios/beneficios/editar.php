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

if (!isset($_POST["idbeneficio"])) {
    die("Beneficio no encontrado.");
}

$idbeneficio = $_POST["idbeneficio"];

$sql = "SELECT * FROM beneficio WHERE idbeneficio = ?";
$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $idbeneficio);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    die("Beneficio no existe.");
}

$fila = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Beneficio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Editar Beneficio</h2>

<form action="actualizar.php" method="post">

    <input type="hidden" name="idbeneficio"
           value="<?php echo $fila["idbeneficio"]; ?>">

    <div class="mb-3">
        <label>Nombre</label>
        <input
            type="text" name="nombre" class="form-control" value="<?php echo $fila["nombre"]; ?>">
    </div>

    <div class="mb-3">
        <label>Fecha Inicio</label>
        <input
            type="date" name="fecha_inicio" class="form-control" value="<?php echo $fila["fecha_inicio"]; ?>">
    </div>

    <div class="mb-3">
        <label>Fecha Fin</label>
        <input
            type="date" name="fecha_fin" class="form-control" value="<?php echo $fila["fecha_fin"]; ?>">
    </div>

    <div class="mb-3">
        <label>Estado</label>

        <select name="estado" class="form-select">

            <option value="1"
                <?php if($fila["estado"]==1) echo "selected"; ?>>
                Activo
            </option>

            <option value="0"
                <?php if($fila["estado"]==0) echo "selected"; ?>>
                Inactivo
            </option>

        </select>

    </div>

    <div class="mb-3">
        <label>Descripción</label>

        <textarea
            name="descripcion" class="form-control" rows="4"><?php echo $fila["descripcion"]; ?></textarea>

    </div>

    <button class="btn btn-success"> Guardar Cambios </button>

    <a href="listado_beneficios.php" class="btn btn-secondary"> Cancelar </a>

</form>

</div>

</body>
</html>