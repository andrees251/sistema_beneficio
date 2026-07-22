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


$idusuario = $_SESSION["idusuario"];
$idbeneficio = $_POST["idbeneficio"];


$sql = "SELECT historial_id FROM historial WHERE usuario_id=? AND beneficio_id=?";

$stmt = $conex->prepare($sql);

$stmt->bind_param("ii",$idusuario,$idbeneficio);

$stmt->execute();

$resultado = $stmt->get_result();

if($resultado->num_rows>0){

    echo "<script>

    alert('Ya tienes una solicitud para este beneficio.');

    window.location='beneficio.php';

    </script>";

    exit;

}




$sql="INSERT INTO historial(beneficio_id,usuario_id,fecha_inscripto,estado) VALUES (?,?,CURDATE(),'Pendiente')";

$stmt=$conex->prepare($sql);

$stmt->bind_param("ii",$idbeneficio,$idusuario);

if($stmt->execute()){

echo "<script> alert('Solicitud enviada correctamente. Debe ser aprobada por un administrador.');

    window.location='beneficio.php';

</script>";

}else{

echo "Error.";

}