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

$idusuario = $_SESSION["idusuario"];


$sql = "SELECT venta.*, usuarios.nombre, usuarios.apellido FROM venta INNER JOIN usuarios ON venta.idusuario = usuarios.idusuario WHERE venta.idusuario = ? ORDER BY fecha_venta DESC";

$stmt = $conex->prepare($sql);
$stmt->bind_param("i", $idusuario);
$stmt->execute();

$resultado = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Inicio</title>
</head>
<body>


  <div class="container text-center ">
    <div class="text-center my-5">
      <h2>Listado De Ventas</h2>
    </div>
    <div class="col-11 d-flex justify-content-end">

    <a href="index.php" class="btn btn-primary">Volver</a>

  </div>
  </div>
  

  <section>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo Venta</th>
      <th scope="col">Monto</th>
      <th scope="col">Fecha Venta</th>
      <th scope="col">Hecha por</th>
      <th scope="col">Estado</th>
      <th scope="col">Accion</th>
    </tr>
  </thead>
  <tbody>
    <?php

    if($resultado->num_rows>0)
      while($fila=$resultado->fetch_assoc()){

    
  
    ?>

    <tr>
        <th scope="row"><?php echo $fila["idventa"]; ?></th>
        <td><?php echo $fila["monto"];?></td>
        <td><?php echo $fila["fecha_venta"];?></td>
        <td><?php echo $fila["nombre"];echo " "; echo $fila["apellido"];?></td>
        <td><?php echo $fila["estado_venta"];?></td>
        <td>
          <div class="d-flex gap-2">

            <form action="../ventas/detalle_venta.php" method="post">
              <input type="hidden" name="idventa" id="idventa" value="<?php echo $fila["idventa"]; ?>">
              <button type="submit" class="btn btn-outline-secondary">Ver Detalles</button>
            </form>
          </div>

        </td>
        

        
        
        </td>
    </tr>
  <?php
      } else{

      }
    ?>  

  </tbody>
</table>
  

   
  </section>
  


   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>