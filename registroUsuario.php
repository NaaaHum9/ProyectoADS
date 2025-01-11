<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "test";
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario</title>
</head>

<body>
    <header>

    </header>
    <nav>
        <div class="buscador">
            <form method="get" id="buscarform">
                <fieldset>
                    <input type="text" id="" value="" placeholder="Buscar">
                    <button>Click</button>
                    <i class="search"></i>
                </fieldset>
            </form>
        </div>

        <div class="perfil-usuario">
            <img src="" alt="">
        </div>

        <div class="botones-container">
            <a href="index.php"><button class="boton">Inicio</button></a>
            <a href="buscador.php"><button class="boton">Espacios</button></a>
            <a href="#"><button class="boton">Partida</button></a>
            <a href="formularioReportes.html"><button class="boton">Reporte</button></a>
        </div>
    </nav>

    <main>
        <section>
            <div>
                <h3>Registro de usuario</h3>
            </div>
            <form action="#" id="resgistro-usuario" method="post">
                <ul>
                    <li>
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" />
                    </li>
                    <li>
                        <label for="apellidos">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" />
                    </li>
                    <li>
                        <label for="correo">Correo</label>
                        <input type="email" name="correo" id="correo" />
                    </li>
                    <li>
                        <label for="contra">Contraseña</label>
                        <input type="password" name="contra" id="contra" />
                    </li>
                    <li>
                        <label for="confirmar-contra">Confirmar contraseña</label>
                        <input type="password" name="confirmar-contra" id="confirmar-contra">
                    </li>
                    <li>
                        <label for="nombre-usuario">Nombre de usuario</label>
                        <input type="text" name="nombre-usuario" id="nombre-usuario" />
                    </li>
                    <li>
                        <label for="sexo">Sexo</label>
                        <input type="text" name="sexo" id="sexo" list="sexo-opciones" />
                        <datalist id="sexo-opciones">
                            <option value="Masculino"></option>
                            <option value="Femenino"></option>
                            <option value="Otro"></option>
                            <option value="Prefiero no decirlo"></option>
                        </datalist>
                    </li>
                    <li>
                        <label for="alcaldia">Alcaldia</label>
                        <input type="text" name="alcaldia" id="alcaldia" list="alcaldia-opciones" />
                        <datalist id="alcaldia-opciones">
                            <option value="Álvaro Obregón"></option>
                            <option value="Azcapotzalco"></option>
                            <option value="Benito Juárez"></option>
                            <option value="Coyoacán"></option>
                            <option value="Cuajimalpa de Morelos"></option>
                            <option value="Cuauhtémoc"></option>
                            <option value="Gustavo A. Madero"></option>
                            <option value="Iztacalco"></option>
                            <option value="Iztapalapa"></option>
                            <option value="La Magdalena Contreras"></option>
                            <option value="Miguel Hidalgo"></option>
                            <option value="Milpa Alta"></option>
                            <option value="Tláhuac"></option>
                            <option value="Tlalpan"></option>
                            <option value="Venustiano Carranza"></option>
                            <option value="Xochimilco"></option>
                        </datalist>
                    </li>
                    <li>
                        <label for="deporte">Deportes que realizas</label>
                        <input type="text" name="deporte" id="deporte" list="lista-deportes" />
                        <datalist id="lista-deportes">
                            <option value="Fútbol"></option>
                            <option value="Natacion"></option>
                            <option value="Atletismo"></option>
                            <option value="Voleibol"></option>
                            <option value="Baloncesto"></option>
                            <option value="Tenis"></option>
                            <option value="Fútbol Americano"></option>
                            <option value="Gimnasio"></option>
                            <option value="Otro"></option>
                        </datalist>
                    </li>
                    <li>
                        <label for="club">Club que perteneces</label>
                        <input type="text" name="club" id="club" />
                    </li>
                    <li>
                        <div class="div-boton-resgistro">
                            <input type="submit" name="sign" value="Regístrarme">
                        </div>
                    </li>
                </ul>

            </form>


        </section>
    </main>
    <footer>

    </footer>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        nav {
            background-color: #D9D9D9;
        }

        .botones-container {
            padding-bottom: 10px;
            display: flex;
            justify-content: center;
            gap: 70px;
        }

        .boton {
            padding: 5px 20px;
            cursor: pointer;
        }

        #resgistro-usuario {
            display: flex;
            justify-content: center;
            font-size: 22px;
        }

        h3 {
            border: 2px solid;
            padding: 15px;
            margin-left: 150px;
            margin-right: 150px;
            text-align: center;
            background-color: #D9D9D9;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 50%;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 20px;
        }

        li {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .div-boton-resgistro {
            padding-top: 50px;
            display: flex;
            justify-content: center;
        }

        .boton-registro {
            font-size: 22px;
            padding: 10px 40px;
            cursor: pointer;
        }
    </style>
</body>

</html>

<?php
if (isset($_POST["sign"])) {
    $nombre = $_POST["nombre"];
    $apell = $_POST["apellidos"];
    $email = $_POST["correo"];
    $pass = $_POST["contra"];
    $confPass = $_POST["confirmar-contra"];
    $user = $_POST["nombre-usuario"];
    $sexo = $_POST["sexo"];
    $alcaldia = $_POST["alcaldia"];
    $deporte = $_POST["deporte"];
    $club = $_POST["club"];

    $insertarRegistro = "INSERT INTO usuario (nombre,apellidos,correo,pass,nombreUsuario,alcaldia,clubOrganizacion,reputacion,imagen,tipoUsuario) 
        VALUES('$nombre','$apell','$email','$pass','$user','$alcaldia','$club',0,'img/default.jpg',2)";

    $ejecutarRegistro = mysqli_query($enlace, $insertarRegistro);

    echo '<script type="text/javascript">
        window.location.href = "login.php";
      </script>';

}

?>