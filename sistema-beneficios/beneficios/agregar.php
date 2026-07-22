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

<div class="container mt-5">

    <h2>Nuevo Beneficio</h2>

    <form action="guardar.php" method="post">

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fecha Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Estado</label>

            <select name="estado" class="form-select">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>

        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" rows="4" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Guardar</button>

        <a href="listado_beneficios.php" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

</body>
</html>