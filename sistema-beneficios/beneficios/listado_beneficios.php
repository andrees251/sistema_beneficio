
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
$sql="select * from beneficio order by idbeneficio";
$stmt=$conex->prepare($sql);
if($stmt->execute()){
  $resultado=$stmt->get_result();

}

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
      <h2>Listado De Beneficios</h2>
    </div>
  </div>
  
  <div class="col-11 d-flex justify-content-end">

    <a href="agregar.php" class="btn btn-primary">Agregar</a>

  </div>
  <section>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo Beneficio</th>
      <th scope="col">Nombre</th>
      <th scope="col">Fecha de Inicio</th>
      <th scope="col">Fecha de Fin</th>
      <th scope="col">Estado</th>
      <th scope="col">Descripción</th>
    </tr>
  </thead>
  <tbody>
    <?php

    if($resultado->num_rows>0)
      while($fila=$resultado->fetch_assoc()){

    
  
    ?>

    <tr>
        <th scope="row"><?php echo $fila["idbeneficio"]; ?></th>
        <td><?php echo $fila["nombre"];?></td>
        <td><?php echo $fila["fecha_inicio"];?></td>
        <td><?php echo $fila["fecha_fin"];?></td>
        <td>
            <?php
            if ($fila["estado"] == 1) {
                echo "Activo";
            } else {
                echo "Inactivo";
            }
            ?>
       </td>
        <td><?php echo $fila["descripcion"];?></td>
        <td>
          <div class="d-flex gap-2">
              <form action="editar.php" method="post">
                  <input type="hidden" name="idbeneficio" id="idbeneficio" value="<?php echo $fila["idbeneficio"]; ?>">
                  <button type="submit" class="btn btn-outline-success">Editar</button>
              </form>

              <form action="detalle.php" method="post">
                  <input type="hidden" name="idbeneficio" id="idbeneficio" value="<?php echo $fila["idbeneficio"]; ?>">
                  <button type="submit" class="btn btn-outline-secondary">Ver Detalles</button>
              </form>
          </div>
        </td>
        
    </tr>
  <?php
      } else{

      }
    ?>  

  </tbody>
</table>

  <div class="col-11 d-flex justify-content-end">

    <a href="../admin/inicio_admin.php" class="btn btn-primary">Volver</a>

  </div>

   
  </section>
  


   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>