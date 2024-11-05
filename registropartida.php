<?php
include 'php/connection.php';
include 'php/buscadorBack.php';
$enlace = conexion();
session_start();
$idDepor = $_GET['id'];
$consulta = "SELECT * FROM deportivo where idDeportivo=" . $idDepor;
$query = mysqli_query($enlace, $consulta);
$depor = mysqli_fetch_array($query);

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
            <form  id="buscarform">
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
                <h3>Agregando Partida en <?php echo $depor[1]; ?></h3>
            </div>
            <form action="#" method="post" id="resgistro-usuario">
                <ul>
                    <li>
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre"  />
                    </li>
                    <li>
                        <label for="descripcion">Descripción:</label>
                        <input type="text" name="descripcion" id="descripcion"  />
                    </li>
                    <li>
                        <table>
                            <tr>
                                <td>
                    <li>
                        <label for="cancha">Cancha:</label>
                        <select name="cancha" id="cancha">
                            <?php
                            $cons = "SELECT * FROM cancha WHERE idDeportivo=" . $idDepor;
                            $res = mysqli_query($enlace, $cons);
                            while ($fila = mysqli_fetch_assoc($res)) {
                                // Acceder a cada valor
                                echo "<option value=" . $fila['idCancha'] . ">" . $fila['etiqueta'] . "</option>";
                            }
                            ?>
                        </select>
                    </li>
                    </td>
                    <td>
                        <label for="fecha">Fecha:</label>
                        <input type="date" name="fecha" id="fecha"  />
                    </td>
                    </tr>
                    </table>
                    </li>
                    <li>
                        <table>
                            <tr>
                                <td>
                                    <label for="duracion">Duración:</label>
                                    <input type="number" name="duracion" id="duracion">min.
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
                    <li>
                        <label for="ubicacion">Deporte:</label>
                        <select name="deporte" id="deporte">
                            <option value="Fútbol">Fútbol</option>
                            <option value="Natacion">Natacion</option>
                            <option value="Atletismo">Atletismo</option>
                            <option value="Voleibol">Voleibol</option>
                            <option value="Baloncesto">Baloncesto</option>
                            <option value="Tenis">Tenis</option>
                            <option value="Fútbol Americano">Fútbol Americano</option>
                            <option value="Gimnasio">Gimnasio</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </li>
                    </td>
                    <td>
                        <label for="deporte">Uniforme requerido:</label>
                        <input type="text" name="uniforme" id="uniforme" />
                    </td>
                    </tr>
                    </table>
                    </li>
                    <li>
                        <label for="empresa">Empresa que lo realiza:</label>
                        <input type="text" name="empresa" id="empresa" />
                    </li>
                    <li>
                        <label for="ubicacion">Público dirigido:</label>
                        <select name="publico" id="publico">
                            <option value="todos">Todos</option>
                            <option value="amigos">Sólo amigos</option>
                            <option value="club">Sólo club</option>
                        </select>
                    </li>
                    <li>
                        <label for="experiencia">Nivel de experiencia:</label>
                        <select name="experiencia" id="experiencia">
                        <option value="Sin experiencia necesaria">Sin experiencia necesaria</option>
                            <option value="principante">Principiante</option>
                            <option value="intermedio">Intermedio</option>
                            <option value="avanzado">Avanzado</option>
                        </select>
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
    $lugar = $_POST["cancha"];
    $fecha = $_POST["fecha"];
    $duracion = $_POST["duracion"];
    $hora = $_POST["hora"];
    $deporte = $_POST["deporte"];
    $uniforme = $_POST["uniforme"];
    $empresa = $_POST["empresa"];
    $publico = $_POST["publico"];
    $experiencia = $_POST["experiencia"];
    $extra = $_POST["extra"];
    
    $insertarRegistro = "INSERT INTO partida (nombrePartida,descripcionPartida,lugarPartida,fechaPartida,duracionPartida,horaReunion,deportePartida,uniformes,empresaPatrocinioPartida,publicoDirigido,nivelExperiencia,indicacionesExtra,idDeportivo,idUsuario)VALUES('$nombre','$desc','$lugar','$fecha','$duracion','$hora','$deporte','$uniforme','$empresa','$publico','$experiencia','$extra',".$idDepor.",".$_SESSION['id'].")";
    echo $insertarRegistro;
    $ejecutarRegistro = mysqli_query($enlace, $insertarRegistro);
    

    echo '<script type="text/javascript">
        window.location.href = "deportivo.php?id='.$idDepor.'";
      </script>';

}

?>