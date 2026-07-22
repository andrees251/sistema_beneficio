<?php

session_start();

if(!isset($_SESSION["idusuario"])){
    header("Location: ../login/login.php");
    exit;
}

if($_SESSION["rol"] != "vendedor"){
    header("Location: ../login/login.php");
    exit;
}

require_once "../conexion.php";

$idproducto = $_POST["idproducto"];
$cantidad = $_POST["cantidad"];
$idvendedor = $_SESSION["idusuario"];



$sql = "SELECT * FROM productos WHERE idproductos = ?";

$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $idproducto);
$stmt->execute();

$producto = $stmt->get_result()->fetch_assoc();

if (!$producto) {

    die("Producto inexistente.");

}

if ($cantidad > $producto["stock_actual"]) {

    die("No hay stock suficiente.");

}

$precio = $producto["precio"];
$total = $precio * $cantidad;


$sql = "INSERT INTO venta (monto, estado_venta, fecha_venta, idusuario) VALUES (?, 'Registrada', CURDATE(), ?)";

$stmt = $conex->prepare($sql);
$stmt->bind_param("di", $total, $idvendedor);
$stmt->execute();

$idventa = $conex->insert_id;



$sql = "INSERT INTO detalle_venta (idproductos,idventa,cantidad,precio_unitario) VALUES (?,?,?,?)";

$stmt = $conex->prepare($sql);
$stmt->bind_param("iiid",
    $idproducto,
    $idventa,
    $cantidad,
    $precio
);

$stmt->execute();



$sql = "UPDATE productos SET stock_actual = stock_actual - ? WHERE idproductos = ?";

$stmt = $conex->prepare($sql);
$stmt->bind_param("ii",$cantidad,$idproducto);

$stmt->execute();

if ($_SESSION["rol"] == "vendedor") {
    header("Location: ../vendedor/mis_ventas.php");
}
exit;