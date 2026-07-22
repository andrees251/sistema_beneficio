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


if(!isset($_POST["idbeneficio"])){
    die("Beneficio no encontrado.");
}

$idbeneficio = $_POST["idbeneficio"];

require_once "../conexion.php";

$sql = "SELECT productos.idproductos, productos.nombre_prod, beneficio_producto.cantidad FROM beneficio_producto INNER JOIN productos ON beneficio_producto.idproductos = productos.idproductos WHERE beneficio_producto.idbeneficio = ?";

$stmt = $conex->prepare($sql);

$stmt->bind_param("i", $idbeneficio);
$stmt->execute();

$resultado = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Administrar Productos</title>
</head>

<body>

<div class="container mt-5">

    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php

            

            while($fila=$resultado->fetch_assoc()){?>

            <tr>
                
                <td><?php echo $fila["nombre_prod"];?></td>
                <td><?php echo $fila["cantidad"];?></td>
                <td>
                    <form action="eliminar.php" method="post">

                        <input type="hidden" name="idbeneficio" value="<?php echo $idbeneficio; ?>">

                        <input type="hidden" name="idproductos" value="<?php echo $fila["idproductos"]; ?>">

                        <button class="btn btn-danger">Eliminar</button>

                    </form>
                </td>

            </tr>

            <?php

                }
            ?>

        </tbody>

    </table>
    <div class="">
        <form action="agregar.php" method="post">

            <input type="hidden" name="idbeneficio" value="<?php echo $idbeneficio; ?>">

            <button class="btn btn-success">Agregar Producto</button>
        </form>

        
    </div>

    <div class="col-11 d-flex justify-content-end">

        <a href="../beneficios/listado_beneficios.php" class="btn btn-secondary">Volver</a>

    </div>


</div>


</body>
</html>