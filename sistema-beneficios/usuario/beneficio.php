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

$sql = "SELECT * FROM beneficio WHERE estado = 1 ORDER BY idbeneficio";

$stmt = $conex->prepare($sql);
$stmt->execute();
$resultado = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Beneficios Disponibles</title>
</head>

<body>

<div class="container mt-5">

    <h2>Beneficios Disponibles</h2>

    <table class="table table-striped">

        <thead>

            <tr>

                <th>Nombre</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th></th>

            </tr>

        </thead>

        <tbody>

            <?php while($fila = $resultado->fetch_assoc()){ ?>

            <tr>

                <td><?php echo $fila["nombre"]; ?></td>

                <td><?php echo $fila["fecha_inicio"]; ?></td>

                <td><?php echo $fila["fecha_fin"]; ?></td>

                <td>

                <form action="inscribirse.php" method="post">

                <input type="hidden" name="idbeneficio" value="<?php echo $fila["idbeneficio"]; ?>">

                <button class="btn btn-primary">Inscribirse</button>

                </form>

                </td>

            </tr>

            <?php } ?>

        </tbody>

    </table>
     <div class="col-11 d-flex justify-content-end">

    <a href="index.php" class="btn btn-primary">Volver</a>

  </div>

    </div>

</body>

</html>