<?php
session_start();

if(!isset($_SESSION["idusuario"])){
    header("Location: ../login/login.php");
    exit;
}

if($_SESSION["rol"] != "usuario"){
    header("Location: ../login/login.php");
    exit;
}

require_once "../conexion.php";


$idusuario = $_SESSION["idusuario"];

$sql = "SELECT h.fecha_inscripto, h.estado, b.nombre, b.fecha_inicio, b.fecha_fin FROM historial h INNER JOIN beneficio b ON h.beneficio_id = b.idbeneficio WHERE h.usuario_id = ? ORDER BY h.fecha_inscripto DESC";

$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $idusuario);
$stmt->execute();

$resultado = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">

<title>Mis Solicitudes</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">Mis Solicitudes</h2>

<table class="table table-hover">

<thead>

<tr>

<th>Beneficio</th>
<th>Inicio</th>
<th>Fin</th>
<th>Fecha Solicitud</th>
<th>Estado</th>
<!-- <th>Observaciones</th> -->

</tr>

</thead>

<tbody>

<?php while($fila = $resultado->fetch_assoc()){ ?>

<tr>

<td><?php echo $fila["nombre"]; ?></td>

<td><?php echo $fila["fecha_inicio"]; ?></td>

<td><?php echo $fila["fecha_fin"]; ?></td>

<td><?php echo $fila["fecha_inscripto"]; ?></td>

<td>

<?php

switch($fila["estado"]){

    case "Pendiente":
        echo "<span class='badge bg-warning text-dark'>Pendiente</span>";
        break;

    case "Aprobado":
        echo "<span class='badge bg-success'>Aprobado</span>";
        break;

    case "Rechazado":
        echo "<span class='badge bg-danger'>Rechazado</span>";
        break;

}

?>

</td>



</tr>

<?php } ?>

</tbody>

</table>

<a href="index.php" class="btn btn-primary">
    Volver
</a>

</div>

</body>

</html>