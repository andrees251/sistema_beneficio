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

$sql = "SELECT h.historial_id, h.fecha_inscripto, h.estado, u.nombre, u.apellido, b.nombre AS beneficio FROM historial h INNER JOIN usuarios u ON h.usuario_id = u.idusuario INNER JOIN beneficio b ON h.beneficio_id = b.idbeneficio ORDER BY h.fecha_inscripto DESC";

$stmt = $conex->prepare($sql);
$stmt->execute();

$resultado = $stmt->get_result();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <table class="table table-striped">

        <thead>

            <tr>
            
                <th>Alumno</th>
                <th>Beneficio</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            
            </tr>

        </thead>

        <tbody>

            <?php while($fila=$resultado->fetch_assoc()){ ?>

            <tr>

                <td><?php echo $fila["nombre"]." ".$fila["apellido"]; ?></td>

                <td><?php echo $fila["beneficio"]; ?></td>

                <td><?php echo $fila["fecha_inscripto"]; ?></td>

                <td><?php echo $fila["estado"]; ?></td>

                <td>

                <?php if($fila["estado"]=="Pendiente"){ ?>

                <div class="d-flex gap-2">

                <form action="aprobar.php" method="post">

                <input type="hidden" name="historial_id" value="<?php echo $fila["historial_id"]; ?>">

                <button class="btn btn-success">Aprobar</button>

                </form>

                <form action="rechazar.php" method="post">

                <input type="hidden" name="historial_id" value="<?php echo $fila["historial_id"]; ?>">

                <button class="btn btn-danger">Rechazar</button>

                </form>

                </div>

                <?php } ?>

                </td>

            </tr>

            <?php } ?>

        </tbody>

    </table>

    <div class="col-11 d-flex justify-content-end">

        <a href="../admin/inicio_admin.php" class="btn btn-primary">Volver</a>

    </div>

</body>
</html>