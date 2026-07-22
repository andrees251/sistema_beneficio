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
$idproductos = $_POST["idproductos"];
$cantidad = $_POST["cantidad"];

$sql = "SELECT * FROM beneficio_producto WHERE idbeneficio=? AND idproductos=?";

$stmt = $conex->prepare($sql);

$stmt->bind_param("ii",$idbeneficio,$idproductos);

$stmt->execute();

$resultado = $stmt->get_result();

if($resultado->num_rows>0){

    echo "<script>
    alert('Ese producto ya fue agregado.');
    window.location='../beneficios/listado_beneficios.php';
    
    </script>";

    exit;
}

$sql="INSERT INTO beneficio_producto (idbeneficio,idproductos,cantidad) VALUES(?,?,?)";

$stmt=$conex->prepare($sql);

$stmt->bind_param("iii",$idbeneficio,$idproductos,$cantidad);

if($stmt->execute()){

    echo "<script>alert('Producto agregado correctamente.');

    window.location='../beneficios/listado_beneficios.php';

    </script>";

}else{

    echo "Error.";
}
?>