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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h1 class="text-center mb-5">
        Panel de Usuario
    </h1>

    <h5 class="text-center mb-4">Bienvenido,<?php echo $_SESSION["nombre"] . " " . $_SESSION["apellido"]; ?></h5>

    <div class="row g-4">

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h4>Beneficios</h4>

                    <p>Ver beneficios disponibles</p>

                    <a href="beneficio.php" class="btn btn-primary">Ir</a>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h4>Mis Solicitudes</h4>

                    <p>Solicitar mis inscripciones realizadas</p>

                    <a href="mis_solicitudes.php" class="btn btn-success">Ir</a>

                </div>

            </div>

        </div>

        

        

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h4>Cerrar sesión</h4>

                    <p>Salir del sistema.</p>

                    <a href="../login/cerrar_sesion.php" class="btn btn-danger">Salir</a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>