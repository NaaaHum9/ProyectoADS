<?php
$servidor = "localhost";
$usuario = "root";
$clave = "root";
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
                <h3>Ingrese la información de su Partida</h3>
            </div>
            <form action="#" id="resgistro-usuario">
                <ul>
                    <li>
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" />
                    </li>
                    <li>
                        <label for="descripcion">Descripción:</label>
                        <input type="text" name="descripcion" id="descripcion" />
                    </li>
                    <li>
                        <table>
                            <tr>
                                <td>
                                    <label for="lugar">Lugar:</label>
                                    <input type="text" name="lugar" id="lugar" />
                                </td>
                                <td>
                                    <label for="fecha">Fecha:</label>
                                    <input type="date" name="fecha" id="fecha" />
                                </td>
                            </tr>
                        </table>
                    </li>
                    <li>
                        <table>
                            <tr>
                                <td>
                                    <label for="duracion">Duración:</label>
                                    <input type="time" name="duracion" id="duracion"><b></b>
                                </td>
                                <td>
                                    <label for="hora">Hora de reunión:</label>
                                    <input type="time" name="hora" id="hora" />
                                </td>
                            </tr>
                        </table>
                    </li>
                    <li>
                        <table>
                            <tr>
                                <td>
                                    <label for="deporte">Deporte:</label>
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
                                </td>
                                <td>
                                    <label for="deporte">Uniforme requerido:</label>
                                    <input type="text" name="uniforme" id="uniforme" />
                                </td>
                            </tr>
                        </table>
                    </li>
                    
                    <li>

                    </li>
                    <li>
                        <label for="empresa">Empresa que lo realiza:</label>
                        <input type="text" name="empresa" id="empresa" />
                    </li>
                    <li>
                        <label for="empresa">Público Dirigido:</label>
                        <input type="text" name="publico" id="publico" />
                    </li>
                    <li>
                        <label for="empresa">Nivel de experiencia:</label>
                        <input type="text" name="experiencia" id="experiencia" />
                    </li>
                    <li>
                        <label for="extra">Indicaciones extra</label>
                        <input type="text" name="extra" id="extra" />
                    </li>
                    <li>
                        <div class="div-boton-resgistro">
                                <input type="submit" name="sign" value="Subir Partida">
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

        table {
            width: 100%;
        }

        td {

            padding: 10px;
            text-align: center;
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
    $desc = $_POST["descripcion"];
    $lugar = $_POST["lugar"];
    $fecha = $_POST["fecha"];
    $duracion = $_POST["duracion"];
    $hora = $_POST["hora"];
    $deporte = $_POST["deporte"];
    $uniforme = $_POST["uniforme"];
    $empresa = $_POST["empresa"];
    $publico = $_POST["publico"];
    $experiencia = $_POST["experiencia"];
    $extra = $_POST["extra"];

    $insertarRegistro = "INSERT INTO usuario (nombrePartida,descrpicionPartida,lugarPartida,fechaPartida,duracionPartida,horaReunion,
    deportePartida,uniformes,empresaPatrocinioPartida,publicoDirigido,nivelExperiencia,indicacionesExtra) 
        VALUES('$nombre','$desc','$lugar','$fecha','$duracion','$hora','$derpote','$uniforme','$empresa','$publico','$experiencia','$extra')";

    $ejecutarRegistro = mysqli_query($enlace, $insertarRegistro);

    echo '<script type="text/javascript">
        window.location.href = "login.php";
      </script>';

}

?>