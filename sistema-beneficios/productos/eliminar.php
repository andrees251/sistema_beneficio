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

$idbeneficio = $_POST["idbeneficio"];
$idproductos = $_POST["idproductos"];

$sql = "DELETE FROM beneficio_producto WHERE idbeneficio = ? AND idproductos = ?";

$stmt = $conex->prepare($sql);

$stmt->bind_param("ii", $idbeneficio, $idproductos);

if ($stmt->execute()) {
    header("Location: ../beneficios/listado_beneficios.php");
    exit;
} else {
    echo "No se pudo eliminar el beneficio.";
}
