<?php
session_start();

if(!isset($_SESSION["idusuario"])){
    header("Location: ../login/login.php");
    exit;
}

if($_SESSION["rol"]!="admin"){
    header("Location: ../login/login.php");
    exit;
}

require_once "../conexion.php";

$id = $_POST["historial_id"];

$sql = "UPDATE historial SET estado='Rechazado' WHERE historial_id=?";

$stmt = $conex->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

header("Location:index.php");

exit;


?>