<?php

session_start();

if(!isset($_SESSION["idusuario"])){

    header("Location: ../login/login.php");
    exit;
}

if($_SESSION["rol"]!="admin" && $_SESSION["rol"]!="vendedor"){

    header("Location: ../login/login.php");
    exit;
}

require_once "../conexion.php";

if (!isset($_POST["idventa"])) {
    die("Venta no encontrado.");
}

$idventa = $_POST["idventa"];

$sql = "SELECT venta.*, usuarios.nombre, usuarios.apellido FROM venta INNER JOIN usuarios ON venta.idusuario = usuarios.idusuario WHERE venta.idventa = ?";

$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $idventa);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    die("El venta no existe.");
}

$fila = $resultado->fetch_assoc();

$sql = "SELECT detalle_venta.*, productos.nombre_prod FROM detalle_venta INNER JOIN productos ON detalle_venta.idproductos = productos.idproductos WHERE detalle_venta.idventa = ?";

$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $idventa);
$stmt->execute();

$productos = $stmt->get_result();


?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Detalle Venta</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header">
            <h3>Detalle de la Venta</h3>
        </div>

        <div class="card-body">

            <p><strong>Código: </strong> <?php echo $fila["idventa"]; ?></p>

            <p><strong>Vendedor: </strong><?php echo $fila["nombre"]." ".$fila["apellido"]; ?></p>

            <p><strong>Fecha: </strong>
                <?php echo $fila["fecha_venta"]; ?>
            </p>

            <p><strong>Estado: </strong>
                <?php echo ucfirst($fila["estado_venta"]); ?>
            </p>

            <p><strong>Monto Total: </strong>
                $<?php echo $fila["monto"]; ?>
            </p>

            <hr>

            <h5>Productos</h5>

            <?php while($fila = $productos->fetch_assoc()){ ?>

                <p><strong>Producto: </strong> <?php echo $fila["nombre_prod"]; ?></p>

                <p><strong>Cantidad: </strong> <?php echo $fila["cantidad"]; ?></p>

                <p><strong>Precio Unitario: </strong> $<?php echo $fila["precio_unitario"]; ?></p>

                <hr>

            <?php } ?>

        </div>
    <div class="card-footer">
        <?php

    if($_SESSION["rol"]=="admin"){
        $volver="listado_ventas.php";
    }else{
        $volver="../vendedor/mis_ventas.php";
    }

    ?>

    <a href="<?php echo $volver; ?>" class="btn btn-primary">
        Volver
    </a>
</body>
</html>