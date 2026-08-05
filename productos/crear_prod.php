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

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Beneficio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5 col-md-5">

    <h2>Nuevo Producto</h2>

    <form action="guardar_nuevoprod.php" method="post">

        <div class="mb-3">
            <label>Nombre Producto</label>
            <input type="text" name="nombre_prod" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" name="precio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock_inicial" class="form-control" required>
        </div>

        <button class="btn btn-success">Guardar</button>

        <a href="listado_productos.php" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

</body>
</html>