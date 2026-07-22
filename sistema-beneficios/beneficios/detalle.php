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
    die("El beneficio no existe.");
}

$fila = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Detalle Beneficio</title>
</head>

<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header">
            <h3>Detalle del Beneficio</h3>
        </div>

        <div class="card-body">

            <p><strong>Código:</strong> <?php echo $fila["idbeneficio"]; ?></p>

            <p><strong>Nombre:</strong> <?php echo $fila["nombre"]; ?></p>

            <p><strong>Fecha Inicio:</strong> <?php echo $fila["fecha_inicio"]; ?></p>

            <p><strong>Fecha Fin:</strong> <?php echo $fila["fecha_fin"]; ?></p>

            <p><strong>Estado:</strong>
                <td>
                    <?php
                    if ($fila["estado"] == 1) {
                        echo "Activo";
                    } else {
                        echo "Inactivo";
                    }
                    ?>
                </td>
            </p>

            <p><strong>Descripción:</strong></p>

            <div class="border rounded p-3">
                <?php echo $fila["descripcion"]; ?>
            </div>

        </div>

        <div class="card-footer d-flex justify-content-between">

            

            <form action="desactivar.php" method="post"
                onsubmit="return confirm('¿Está seguro de eliminar este beneficio?');">

                <input type="hidden" name="idbeneficio"
                    value="<?php echo $fila["idbeneficio"]; ?>">

                <button type="submit" class="btn btn-danger">
                    Desactivar
                </button>

            </form>
            <form action="../productos/administrar.php" method="post">

                <input type="hidden" name="idbeneficio" value="<?php echo $fila["idbeneficio"]; ?>">

                <button type="submit" class="btn btn-primary">
                    Administrar productos.
                </button>

            </form>

            <a href="listado_beneficios.php" class="btn btn-primary">
                Volver
            </a>
        </div>

        

    </div>

</div>

</body>
</html>