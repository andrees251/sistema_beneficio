<?php

session_start();





require_once "../conexion.php";

if (!isset($_POST["idventa"])) {
    die("Venta no encontrada.");
}

$idventa = $_POST["idventa"];

$sql = "SELECT v.idventa,v.monto, v.estado_venta, v.fecha_venta, v.idusuario, dv.idproductos,dv.cantidad, dv.precio_unitario, dv.fecha_entrega, p.* FROM venta AS v INNER JOIN detalle_venta AS dv ON v.idventa = dv.idventa INNER JOIN productos AS p  ON dv.idproductos = p.idproductos WHERE v.idventa = ?";

$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $idventa);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    die("Venta no existe.");
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

<form action="actualizar_venta.php" method="post">

    <input type="hidden" name="idventa" value="<?php echo $fila["idventa"]; ?>">

    <div class="mb-3">
        <label>Monto</label>
        <input
            type="text" name="monto" class="form-control" value="<?php echo $fila["monto"]; ?>">
    </div>

    <label>Estado</label>
    <select name="estado" class="form-select">
        <option value="Pagada">Pagada</option>

        <option value="Pendiente">Pendiente</option>

        <option value="Entregada">Entregada</option>

        <option value="Cancelada">Cancelada</option>

    </select>

    <div class="mb-3">
        <label>Fecha</label>
        <input
            type="date" name="fecha_venta" class="form-control" value="<?php echo $fila["fecha_venta"]; ?>">
    </div>

    <div class="mb-3">
        <label>Monto</label>
        <input
            type="text" name="monto" class="form-control" value="<?php echo $fila["monto"]; ?>">
    </div>

    <button class="btn btn-success mt-3"> Guardar Cambios </button>

    <a href="../vendedor/mis_ventas.php" class="btn btn-secondary mt-3"> Cancelar </a>

</form>

</div>

</body>
</html>