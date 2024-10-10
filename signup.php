<?php
$servidor = "localhost";
$usuario = "root";
$clave = "root";
$baseDeDatos = "aprovDep";
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
?>



<!DOCTYPE html>
<html>

<head>
    <title>
        Aprovechamiento de Espacios Deportivos
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .canvas {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;

            background-image: url("https://www.rivasciudad.es/wp-content/uploads/2019/04/Plano-centro-deportivo-La-Luna.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .item {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5%;
            background-color: rgba(255, 255, 255, .85);
            padding: 1vh;
            width: 50vh;

        }

        .alert-fixed {
            position: fixed;
            top: 0px;
            z-index: 9999;
            border-radius: 0px
        }
    </style>
</head>

<body class="canvas">
    <div class="item">
        <div class="container-fluid">
            <form action="#" name="signUp" method="post">
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example1">Nombre</label>
                    <input type="text" name="nombre" class="form-control" />
                </div>
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example1">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" />
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example2">Contraseña</label>
                    <input type="password" name="pass" class="form-control" />
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    
                    <div class="col">
                        <!-- Simple link -->
                        <a href="#!">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <input type="submit" name="sign" data-mdb-button-init data-mdb-ripple-init
                    class="btn btn-primary btn-block mb-4" value="Regístrate">

                <!-- Register buttons -->
                <div class="text-center">
                    <p>¿Ya tienes cuenta?<a href="login.php">Inicia Sesión</a></p>
                    
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php

    if(isset($_POST["sign"])){
        $nombre= $_POST["nombre"];
        $email= $_POST["email"];
        $pass= $_POST["pass"];
        $id;

        $insertarRegistro = "INSERT INTO usuario (nombre,correo,pass,reputacion,imagen) VALUES('$nombre','$email','$pass',0,'img/default.jpg')";

        $ejecutarRegistro = mysqli_query($enlace,$insertarRegistro);
        
        header("Location: login.php", true, 301);

        exit();

    }

?>
