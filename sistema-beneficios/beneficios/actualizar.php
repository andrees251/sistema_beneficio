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
$nombre = $_POST["nombre"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
$estado = $_POST["estado"];
$descripcion = $_POST["descripcion"];

$sql = "UPDATE beneficio SET nombre=?,fecha_inicio=?,fecha_fin=?,estado=?,descripcion=? WHERE idbeneficio=?";

$stmt = $conex->prepare($sql);

$stmt->bind_param("sssisi",$nombre,$fecha_inicio,$fecha_fin,$estado,$descripcion, $idbeneficio);

if($stmt->execute()){
    header("Location: listado_beneficios.php");
    exit;
}else{
    echo "Error al actualizar.";
}

?>