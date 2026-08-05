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

$nombre_prod = $_POST["nombre_prod"];
$precio = $_POST["precio"];
$stock_inicial = $_POST["stock_inicial"];


$sql = "INSERT INTO productos (nombre_prod,precio,stock_inicial,stock_actual) VALUES (?,?,?,?)";

$stock_actual = $stock_inicial;

$stmt = $conex->prepare($sql);

$stmt->bind_param(
    "ssss",$nombre_prod,$precio,$stock_inicial,$stock_actual);

if($stmt->execute()){
    header("Location: listado_productos.php");
    exit;
}else{
    echo "Error al guardar.";
}

?>