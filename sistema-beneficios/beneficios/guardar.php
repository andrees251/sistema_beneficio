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

$nombre = $_POST["nombre"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
$estado = $_POST["estado"];
$descripcion = $_POST["descripcion"];

$sql = "INSERT INTO beneficio (nombre,fecha_inicio,fecha_fin,estado,descripcion) VALUES (?,?,?,?,?)";

$stmt = $conex->prepare($sql);

$stmt->bind_param(
    "sssis",$nombre,$fecha_inicio,$fecha_fin,$estado,$descripcion);

if($stmt->execute()){
    header("Location: listado_beneficios.php");
    exit;
}else{
    echo "Error al guardar.";
}

?>