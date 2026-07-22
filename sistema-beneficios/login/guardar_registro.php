<?php
session_start();    

require_once "../conexion.php";
if(!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["dni"]) && !empty($_POST["telefono"]) && !empty($_POST["email"]) && !empty($_POST["direccion"]) && !empty($_POST["password"])){

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    $password = $_POST["password"];
    $rol = "usuario";

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, apellido, dni, telefono, email, direccion, password_hash, rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conex->prepare($sql);

    $stmt->bind_param("ssssssss",$nombre,$apellido,$dni,$telefono,$email,$direccion,$password_hash,$rol);


    if ($stmt->execute()) {

        echo "<script>
                alert('Usuario registrado correctamente.');
                window.location='login.php';
              </script>";

    } else {

        echo "<script>
                alert('Error al registrar el usuario.');
                history.back();
              </script>";
    }

}  else {

    echo "<script>
            alert('Debe completar todos los campos.');
            window.location='registrarse.php';
          </script>";

    exit;
}





?>