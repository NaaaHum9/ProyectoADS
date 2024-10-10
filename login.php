<?php
$servidor = "localhost";
$usuario = "root";
$clave = "root";
$baseDeDatos = "aprovDep";
session_start();
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
            <form action="#" name="login" method="post">

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
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                            <label class="form-check-label" for="form2Example31"> Recuerdame </label>
                        </div>
                    </div>

                    <div class="col">
                        <!-- Simple link -->
                        <a href="#!">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <input type="submit" name="logSub" data-mdb-button-init data-mdb-ripple-init
                    class="btn btn-primary btn-block mb-4" value="Iniciar Sesión">

                <!-- Register buttons -->
                <div class="text-center">
                    <p>¿No tienes cuenta? <a href="signup.php">Regístrate</a></p>
                    
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php



if (!empty($_POST["logSub"])) {
    if (empty($_POST["email"]) or empty($_POST["pass"])) {
        echo '<div class="alert alert-warning alert-fixed alert-dismissible position-fixed">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Algun campo está vacío.</strong>
                </div>';
    } else {
        $correo = $_POST["email"];
        $pass = $_POST["pass"];
        $sql = mysqli_query($enlace, "select * from usuario where correo='$correo' and pass='$pass'");
        $arr = mysqli_fetch_array($sql);

        if (empty($arr)) {

            echo '<div class="alert alert-danger alert-fixed alert-dismissible position-fixed">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Correo o contraseña incorrectos.</strong>
                </div>';


        } else {
            $_SESSION["nombre"] = $arr[1];
            $_SESSION["correo"] = $arr[2];
            $_SESSION["id"] = $arr[0];

            echo '<script type="text/javascript">';
            echo 'window.location.href="index.php";';
            echo '</script>';
        }
    }
}

?>