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

$sql = "SELECT * FROM productos ORDER BY nombre_prod";

$stmt = $conex->prepare($sql);

$stmt->execute();

$resultado = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5 col-md-6">

    <h2>Nuevo Producto</h2>

    <form action="guardar.php" method="post">

        <input type="hidden" name="idbeneficio" value="<?php echo $idbeneficio; ?>">

        <div class="mb-3">

            <label>Producto</label>

            <select name="idproductos" class="form-select" required>
                
                <option value="">Seleccione un producto</option>
                <?php while($fila = $resultado->fetch_assoc()){ ?>

                <option value="<?php echo $fila["idproductos"];?>">
                <?php echo $fila["nombre_prod"];?>

                </option>
                
                <?php
                }
                ?>

            </select>

        </div>

        <div class="mb-3">
            <label>Cantidad</label>

            <input type="number" name="cantidad" class="form-control" required>

        </div>

        <button class="btn btn-success">Guardar</button>

        <a href="../beneficios/listado_beneficios.php" class="btn btn-danger">Cancelar</a>


    </form>

</div>

</body>
</html>