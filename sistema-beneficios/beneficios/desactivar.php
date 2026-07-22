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

$sql = "UPDATE beneficio SET estado = 0 WHERE idbeneficio = ?";
$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $idbeneficio);

if ($stmt->execute()) {
    header("Location: listado_beneficios.php");
    exit;
} else {
    echo "No se pudo eliminar el beneficio.";
}

?>