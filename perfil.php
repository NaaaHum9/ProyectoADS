<?php
include 'php/connection.php';
include 'php/deporBack.php';
$enlace = conexion();
session_start();

if ($_SESSION != null) {

    if (isset($_GET['myFlag'])) {
        $idUser = $_SESSION["id"];

    } else {
        $idUser = $_GET['id'];
    }
} else {
    $idUser = $_GET['id'];
}

$consulta = "SELECT * from usuario where idUsuario=$idUser";
$sql = mysqli_query($enlace, $consulta);
$arr = mysqli_fetch_array($sql);

$sql2 = mysqli_query($enlace, "SELECT *
    FROM comentUsuario INNER JOIN usuario ON comentUsuario.autor = usuario.idUsuario where comentUsuario.idUsuario=$idUser");
$arr2 = mysqli_fetch_array($sql);

$sql3 = mysqli_query($enlace, "SELECT 
    contenido, 
    fecha, 
    autorID, 
    autorIDUsuario,         -- idUsuario del autor
    imagen, 
    comentedNombre, 
    comentedIDDeportivo     -- idDeportivo del espacio comentado
FROM (
    -- Primera subconsulta: Comentarios de usuario con usuario comentado
    SELECT 
        contenido, 
        fecha, 
        autor.nombre AS autorID, 
        autor.idUsuario AS autorIDUsuario,   -- idUsuario del autor
        autor.imagen AS imagen, 
        comentado.nombre AS comentedNombre, 
        NULL AS comentedIDDeportivo          -- Valor NULL para mantener las columnas alineadas
    FROM 
        comentUsuario
    INNER JOIN 
        usuario AS autor ON comentUsuario.autor = autor.idUsuario
    INNER JOIN 
        usuario AS comentado ON comentUsuario.idUsuario = comentado.idUsuario
    WHERE 
        comentUsuario.autor = 1

    UNION ALL

    -- Segunda subconsulta: Comentarios deportivos con el nombre del deporte correcto
    SELECT 
        contenido, 
        fecha, 
        usuario.nombre AS autorID, 
        usuario.idUsuario AS autorIDUsuario,  -- idUsuario del autor
        usuario.imagen AS imagen, 
        deportivo.nombre AS comentedNombre, 
        deportivo.idDeportivo AS comentedIDDeportivo  -- idDeportivo del espacio comentado
    FROM 
        comentDeportivo
    INNER JOIN 
        usuario ON comentDeportivo.autor = usuario.idUsuario
    INNER JOIN 
        deportivo ON comentDeportivo.idDeportivo = deportivo.idDeportivo
    WHERE 
        comentDeportivo.autor = 1

) AS comentarios_comb

ORDER BY fecha DESC;
");

function checkFlag($enlace)
{

    if ($_SESSION != NULL) {
        if (!isset($_GET['myFlag'])) {
            if ($_GET['id'] != $_SESSION['id']) {
                $query = "SELECT * FROM amigo where idAmigo1=" . $_GET['id'] . " OR idAmigo2=" . $_GET['id'];
                    $find = mysqli_query($enlace, $query);
                    $fetch = mysqli_fetch_array($find);

                    if (!empty($fetch)) {

                        echo '<div class="d-grid gap-2">
                                            <a class="btn btn-danger" href="php/participarPartida.php?func=del&idPartida=' . $fetch['idPartida'] . '&id=' . $_SESSION['id'] . '" >Eliminar Amigo</a>
                                            </div>';

                    } else {
                        $query = "SELECT * FROM soliamigo where idAmigo1=" . $_GET['id'];
                        $find = mysqli_query($enlace, $query);
                        $fetch = mysqli_fetch_array($find);
                        if (!empty($fetch)) {

                            echo $fetch[0];
                            echo '<div class="d-grid gap-2">
                                                <a class="btn btn-warning" href="amigo.php?func=aceptar&idPerfil=' . $_GET['id'] . '&id=' . $_SESSION['id'] . '" >Aceptar Solicitud de Amistad</a>
                                                </div>';
                        } else {

                            $query = "SELECT * FROM soliamigo where idAmigo2=" . $_GET['id'];
                            $find = mysqli_query($enlace, $query);
                            $fetch = mysqli_fetch_array($find);
                            if (!empty($fetch)) {

                                echo '<div class="d-grid gap-2"><a class="btn btn-danger" href="amigo.php?func=cancel&idPerfil='.$_GET['id'].'&id='.$_SESSION['id'].'" >Cancelar Solicitud de Amistad</a></div>';

                            }else{
                                echo '<div class="d-grid gap-2"><a class="btn btn-primary" href="amigo.php?func=soli&idPerfil=' . $_GET['id'] . '&id=' . $_SESSION['id'] . '" >Enviar Solicitud de Amistad</a></div>';
                            }
                        }
                    }
                echo '<hr><h4>Ingresa un comentario:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <textarea class="form-control" name="comentario" rows="3"
                                placeholder="Recuerda ser respetuoso en todo momento." required></textarea>
                        </div><br>
                        <input type="submit" class="btn btn-success" name="subComm" value="Enviar comentario">
                    </form>
                    <hr><br>';

            }
        }

    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>
        Aprovechamiento de Espacios Deportivos
    </title>

    <link href="libraries/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: rgb(35, 81, 0);
            display: flex;
            flex-direction: column;
        }

        nav {
            background-color: rgb(35, 81, 0);
        }

        .sectCom {
            height: 60vw;
            max-height: 20vw;
            overflow-y: scroll;
            overflow-x: hidden;
            border: 1px solid #ccc;
        }

        .navButton {
            flex: auto;
            text-align: center;
            text-decoration: none;
            color: white;

        }

        textarea {
            width: 100%;
        }

        .canvas2 {
            display: flex;
            align-items: center;

        }

        .canvas {
            display: flex;

        }

        .coment {
            padding: 2%;
        }

        #imgDep {
            width: 100%;
        }

        #perfil {
            width: 10vh;
            height: 10vh;
        }

        .side {
            background-color: aliceblue;
            width: 33%;
            padding: 2%;
        }

        .info {
            background-color: aliceblue;
            width: 66%;
            padding: 2%;
        }

        .footer {
            padding: 20px;
            text-align: center;
            background: green;
        }

        a {
            color: black;
            text-decoration: none;
        }
    </style>
    <script>
        // Función JavaScript para alternar los divs
        function alternarDivs() {
            var div1 = document.getElementById('toMe');
            var div2 = document.getElementById('fromMe');
            var btn = document.getElementById('alter')
            var lab = document.getElementById('label');
            if (div1.style.display === 'none') {
                div1.style.display = 'flex';
                div2.style.display = 'none';
                btn.textContent = "Ver comentarios hechos por el usuario";
                lab.textContent = "Comentarios sobre ti:"
            } else {
                div1.style.display = 'none';
                div2.style.display = 'flex';
                btn.textContent = "Ver comentarios hechos al usuario";
            }
        }
    </script>
</head>

<body style="background-color: white;">
    <nav class="navbar navbar-expand-lg navbar-light bg-ligh">
        <a class="navButton" href="index.php">Inicio</a>
        <a class="navButton" href="buscador.php">Deportivos</a>
        <a class="navButton" disabled href="#"></a>
        <?php
        if ($_SESSION != NULL) {
            echo "<a class='navButton' href='perfil.php?myFlag'>Mi Cuenta</a><br>";
            echo "<a class='navButton' href='logout.php'>Cerrar Sesión</a>";
        } else {
            echo "<a class='navButton' href='login.php'>Inicio Sesión</a><br>";
            echo "<a class='navButton' href='signup.php'>Registrar</a>";
        }
        ?>

    </nav>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-4 sidenav">
                <?php

                if (!empty($_SESSION)) {
                    if ($idUser == $_SESSION['id']) {
                        echo '<a href="#" data-bs-toggle="modal" data-bs-target="#myModal">';
                    } else {
                        echo '<a href="#">';
                    }
                } else {
                    echo '<a href="#">';
                }
                ?>
                <img id="imgDep" class="img-thumbnail" src=<?php echo '"' . $arr[5] . '"'; ?>></a>

                <b>
                    <p>Reputación: <?php echo $arr[9]; ?>/5.0</p>
                </b>
                <b>
                    <p>Deportes:</p>
                </b>
                <p>
                    <?php ?>
                </p>
                <b>
                    <p>Correo electrónico:</p>
                </b>
                <p><?php echo $arr[2] ?></p>
                <b>
                    <p>Descripción:</p>
                </b>
                <p></p>
            </div>

            <div class="col-sm-6">
                <h1><?php echo $arr[1]; ?></h1>
                <hr>
                <?php
                if (!empty($_SESSION)) {
                    
                }
                ?>
                
                <?php checkFlag($enlace); ?>

                <button id="alter" class="btn btn-success" onclick="alternarDivs()">Ver comentarios hechos por el
                    usuario</button>
                <br><br>
                <p id="label">Comentarios sobre ti:</p>
                <hr>
                <div class="row" id="toMe">

                    <?php while ($row = $sql2->fetch_assoc()) {
                        if ($row['imagen'] != NULL) {
                            $ruta = $row['imagen'];
                        }
                        $fecha = new DateTime($row['fecha']);
                        $date = $fecha->format('d-m-Y H:i A');
                        echo '<script>alert("' . $row['imagen'] . '");</script>';
                        ?>
                        <div class="col-sm-2 text-center">
                            <a href=<?php echo '"perfil.php?id=' . $row['autorIDUsuario'] . '"' ?>>
                                <img id="perfil" src=<?php echo "'$ruta'"; ?> class="rounded" height="65" width="65"
                                    alt="Avatar">
                            </a>
                        </div>
                        <div class="col-sm-10">
                            <h5><b><?php echo $row['nombre'] . " "; ?></b><small><?php echo $date; ?></small></h5>
                            <p><?php echo $row['contenido']; ?></p>
                            <br>
                        </div>
                    <?php } ?>
                </div>
                <div class="row" id="fromMe" style="display: none;">

                    <?php while ($row = $sql3->fetch_assoc()) {
                        if ($row['imagen'] != NULL) {
                            $ruta = $row['imagen'];
                        }

                        $fecha = new DateTime($row['fecha']);
                        $date = $fecha->format('d-m-Y H:i A');
                        ?>
                        <div class="col-sm-2 text-center">
                            <a href=<?php echo '"perfil.php?id=' . $row['autorIDUsuario'] . '"' ?>>
                                <img id="perfil" src=<?php echo "'$ruta'"; ?> class="rounded" height="65" width="65"
                                    alt="Avatar">
                            </a>
                        </div>
                        <div class="col-sm-10">
                            <h5><?php echo "&raquo <b>" . $row['comentedNombre'] . " "; ?></b><small><?php echo $date; ?></small>
                            </h5>
                            <p><?php echo $row['contenido']; ?></p>
                            <br>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div><br>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Subir una imagen de perfil</h4>
                </div>
                <div class="modal-body">
                    <form action="subirImg.php" method="post" enctype="multipart/form-data">
                        <label for="imagen">Selecciona una imagen:</label>
                        <input class="form-control" type="file" name="imagen" id="imagen"><br>
                        <input type="submit" class="btn btn-success" name="submit" value="Subir Imagen">
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php

if (!empty($_POST["subComm"])) {

    if ($_SESSION == NULL) {
        //Redireccion por JavaScript
        echo '<script type="text/javascript">';
        echo 'window.location.href="login.php";';
        echo '</script>';
    }

    if (!empty($_POST["comentario"])) {

        $contenido = $_POST['comentario'];
        $autor = $_SESSION["id"];
        echo $autor;
        echo $idUser;
        $fecha = date("Y-m-d H:i:s");
        $sql = mysqli_query($enlace, "INSERT INTO comentusuario(autor,contenido,fecha,idUsuario) VALUES ($autor,'$contenido','$fecha',$idUser)");
        echo '<script type="text/javascript">';
        echo 'window.location.href="perfil  .php?id=' . $idUser . '";';
        echo '</script>';

    }
}
?>