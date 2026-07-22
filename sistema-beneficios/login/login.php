<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    
    <div class="container">

        <div class="col-11 d-flex justify-content-end mt-5">
    
            <a href="../index.php" class="btn btn-primary">Volver al Inicio</a>
    
        </div>

        <div class="row justify-content-center">

            <div class="col-md-5">

                <div class="mt-5">

                    <div class="text-center">

                    <h3>Iniciar Sesión</h3>

                    </div>

                    <div class="">

                        <form action="validar_login.php" method="post">

                            <div class="mb-3">

                                <label>Email</label>

                                <input type="email" name="email"class="form-control" required>

                            </div>

                            <div class="mb-3">

                                <label>Contraseña</label>

                                <input type="password" name="password"class="form-control" required>

                            </div>

                            <button class="btn btn-primary w-100">Ingresar</button>

                            <div class="text-center mt-3">
                                ¿No tienes una cuenta?
                                <a href="registrarse.php">Registrarse</a>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>