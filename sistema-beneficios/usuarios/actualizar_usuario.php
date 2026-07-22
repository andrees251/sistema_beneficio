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

$idusuario = $_POST["idusuario"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$dni = $_POST["dni"];
$email = $_POST["email"];
$direccion = $_POST["direccion"];
$rol = $_POST["rol"];


$sql = "UPDATE usuarios SET nombre=?,apellido=?,dni=?,email=?,direccion=?,rol=? WHERE idusuario=?";

$stmt = $conex->prepare($sql);

$stmt->bind_param("ssssssi",$nombre,$apellido,$dni,$email,$direccion,$rol,$idusuario);

if($stmt->execute()){
    header("Location: gestionar_usuarios.php");
    exit;
}else{
    echo "Error al actualizar.";
}

?>