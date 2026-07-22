<?php
session_start();

if(!isset($_SESSION["idusuario"])){
    header("Location: ../login/login.php");
    exit;
}

if($_SESSION["rol"] != "vendedor"){
    header("Location: ../login/login.php");
    exit;
}

require_once "../conexion.php";

$sql = "SELECT * FROM productos WHERE stock_actual > 0 ORDER BY nombre_prod";

$stmt = $conex->prepare($sql);
$stmt->execute();

$resultado = $stmt->get_result();

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5 col-md-6">

    <h2>Nueva Venta</h2>

    <form action="guardar_venta.php" method="post">

        <div class="mb-3">

            <label>Producto</label>

            <select name="idproducto" class="form-select" id="idproducto" required>
                <option value="">Seleccione un Producto</option>

                <?php while($fila = $resultado->fetch_assoc()){ ?>

                    <option value="<?php echo $fila["idproductos"]; ?>">
                        <?php
                            echo $fila["nombre_prod"];
                            echo " | Stock: ".$fila["stock_actual"];
                            echo " | $".$fila["precio"];
                        ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">

            <label>Cantidad</label>

            <input type="text" name="cantidad" id="cantidad" min="1" class="form-control" required>

        </div>

        <button class="btn btn-success">Registrar</button>

        <a href="../vendedor/index.php" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

</body>
</html>