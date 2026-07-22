<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Beneficio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5 col-md-6">

    <h2>Nuevo Usuario</h2>

    <form action="guardar_registro.php" method="post">

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label>Dni</label>
            <input type="number" name="dni" id="dni" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Telefono</label>
            <input type="number" name="telefono" id="telefono" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button class="btn btn-success">Guardar</button>

        <a href="login.php" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

</body>
</html>