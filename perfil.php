<?php
include 'php/connection.php';
include 'php/deporBack.php';
$enlace = conexion();
session_start();

if ($_SESSION != null) {

    if (isset($_GET['myFlag'])) {
        $idUser = $_SESSION["id"];

    } elseif($_GET['id']==$_SESSION['id']){
        echo '<script> window.location.href = "perfil.php?myFlag";</script>';
        
    }else {
        $idUser = $_GET['id'];
    }
} else {
    $idUser = $_GET['id'];
}
function updateRate($link, $cons, $idUser)
{
    if ($idUser == -1) {
        echo '<script> window.location.href = "login.php";</script>';
    } else {
        $query = mysqli_query($link, $cons);
        echo '<script> window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
    }
}


if (isset($_POST['rating'])) {

    if (empty($calif)) {
        $consulta = "INSERT INTO reputacion(autor,calificado,reputacion) VALUES (" . $_SESSION['id'] . ",$idUser," . $_POST['rating'] . ")";
        echo '<script>alert("' . $consulta . '");</script>';
    } else {
        $consulta = "UPDATE reputacion SET calificacion = " . $_POST['rating'] . " WHERE autor = $_SESSION AND calificado = $idUser;";
    }
    updateRate($enlace, $consulta, $idUser);

}

$consulta = "SELECT * from usuario where idUsuario=$idUser";
$sql = mysqli_query($enlace, $consulta);
$arr = mysqli_fetch_array($sql);

$sql2 = mysqli_query($enlace, "SELECT *
    FROM comentUsuario INNER JOIN usuario ON comentUsuario.autor = usuario.idUsuario where comentUsuario.idUsuario=$idUser ORDER BY comentUsuario.fecha DESC;");
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
        comentUsuario.autor = $idUser

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
        comentDeportivo.autor = $idUser

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
                                            <a class="btn btn-danger" href="amigo.php?func=del&idPerfil=' . $_GET['id'] . '&id=' . $_SESSION['id'] . '" >Eliminar Amigo</a>
                                            </div>';

                } else {
                    $query = "SELECT * FROM soliamigo where idAmigo1=" . $_GET['id'];
                    $find = mysqli_query($enlace, $query);
                    $fetch = mysqli_fetch_array($find);
                    if (!empty($fetch)) {

                        echo '<div class="d-grid gap-2">
                                                <a class="btn btn-warning" href="amigo.php?func=aceptar&idPerfil=' . $_GET['id'] . '&id=' . $_SESSION['id'] . '" >Aceptar Solicitud de Amistad</a>
                                                </div>';
                    } else {

                        $query = "SELECT * FROM soliamigo where idAmigo2=" . $_GET['id'];
                        $find = mysqli_query($enlace, $query);
                        $fetch = mysqli_fetch_array($find);
                        if (!empty($fetch)) {

                            echo '<div class="d-grid gap-2"><a class="btn btn-danger" href="amigo.php?func=cancel&idPerfil=' . $_GET['id'] . '&id=' . $_SESSION['id'] . '" >Cancelar Solicitud de Amistad</a></div>';

                        } else {
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
        .star-cb-group {
            /* remove inline-block whitespace */
            font-size: 0;
            /* flip the order so we can use the + and ~ combinators */
            unicode-bidi: bidi-override;
            direction: rtl;
            /* the hidden clearer */
        }

        .star-cb-group * {
            font-size: 1rem;
        }

        .star-cb-group>input {
            display: none;
        }

        .star-cb-group>input+label {
            /* only enough room for the star */
            display: inline-block;
            overflow: hidden;
            text-indent: 9999px;
            width: 1em;
            white-space: nowrap;
            cursor: pointer;
            font-size: 40px;
        }

        .star-cb-group>input+label:before {
            display: inline-block;
            text-indent: -9999px;
            content: "☆";
            color: #888;
        }

        .star-cb-group>input:checked~label:before,
        .star-cb-group>input+label:hover~label:before,
        .star-cb-group>input+label:hover:before {
            content: "★";
            color: #e52;
            text-shadow: 0 0 1px #333;
        }

        .star-cb-group>.star-cb-clear+label {
            text-indent: -9999px;
            width: .5em;
            margin-left: -.5em;
        }

        .star-cb-group>.star-cb-clear+label:before {
            width: .5em;
        }

        .star-cb-group:hover>input+label:before {
            content: "☆";
            color: #888;
            text-shadow: none;
        }

        .star-cb-group:hover>input+label:hover~label:before,
        .star-cb-group:hover>input+label:hover:before {
            content: "★";
            color: #e52;
            text-shadow: 0 0 1px #333;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        #navbar {
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
    <nav id='navbar'class="navbar navbar-expand-lg navbar-light bg-ligh">
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
                    <p>Tu calificación: <?php
                    if (empty($calif[3])) {
                        echo 'N-A';
                    } else {
                        echo $calif[3];
                    }
                    ?>/5</p>

                </b>
                <?php
                if (!isset($_GET['myFlag'])) {
                    echo ' 
                <form method="POST" name="rating">
                    <fieldset>
                        <span class="star-cb-group">
                            <input type="radio" id="rating-5" name="rating" value=5
                                onclick="this.form.submit()" /><label for="rating-5">5</label>
                            <input type="radio" id="rating-4" name="rating" value=4
                                onclick="this.form.submit()" /><label for="rating-4">4</label>
                            <input type="radio" id="rating-3" name="rating" value=3 onclick="this.form.submit()"
                                checked="checked" /><label for="rating-3">3</label>
                            <input type="radio" id="rating-2" name="rating" value=2
                                onclick="this.form.submit()" /><label for="rating-2">2</label>
                            <input type="radio" id="rating-1" name="rating" value=1
                                onclick="this.form.submit()" /><label for="rating-1">1</label>
                            <input type="radio" id="rating-0" name="rating" value=0 onclick="this.form.submit()"
                                class="star-cb-clear" /><label for="rating-0">0</label>
                        </span>
                    </fieldset>
                </form>';
                }
                ?>
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
                <h1><?php echo $arr['nombre']; ?></h1>
                <h5 class="fw-light">@<?php echo $arr['nombreUsuario'];?></h5>
                <hr>
                <?php
                if (!empty($_SESSION)) {

                }
                ?>

                <?php checkFlag($enlace); ?>

                <button id="alter" class="btn btn-success" onclick="alternarDivs()">Ver comentarios hechos por el
                    usuario</button>
                <br><br>

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">Comentarios hechos por <?php echo $arr['nombre']; ?> </button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Partidas</button>
                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                            type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Clubes</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    </div>
                </div>

                <p id="label">Comentarios sobre ti:</p>
                <hr>
                <div class="row" id="toMe">

                    <?php while ($row = $sql2->fetch_assoc()) {
                        if ($row['imagen'] != NULL) {
                            $ruta = $row['imagen'];
                        }
                        $fecha = new DateTime($row['fecha']);
                        $date = $fecha->format('d-m-Y H:i A');
                        ?>
                        <div class="col-sm-2 text-center">
                            <a href=<?php echo '"perfil.php?id=' . $row['autor'] . '"' ?>>
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
        $sql = mysqli_query($enlace, "INSERT INTO comentusuario(autor,contenido,idUsuario) VALUES ($autor,'$contenido',$idUser)");
        echo '<script type="text/javascript">';
        echo 'window.location.href="perfil.php?id=' . $idUser . '";';
        echo '</script>';

    }
}
?>