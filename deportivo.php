<?php
include 'php/connection.php';
include 'php/deporBack.php';
$enlace = conexion();
session_start();

if (isset($_SESSION['id'])) {

    $idUser = $_SESSION['id'];

} else {
    $idUser = -1;
}
if (isset($_GET['id'])) {
    $idDepor = $_GET['id'];

} else {
    echo "<script>window.location.href = 'buscador.php';</script>";
}

$consulta = "SELECT * from deportivo where idDeportivo=" . $idDepor;
$sql = mysqli_query($enlace, $consulta);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            


$sql2 = mysqli_query($enlace, "SELECT * , usuario.nombre, usuario.imagen
    FROM comentDeportivo INNER JOIN usuario ON comentDeportivo.autor = usuario.idUsuario where idDeportivo=$idDepor ORDER BY fecha DESC");
$arr = mysqli_fetch_array($sql);

$sql3 = mysqli_query($enlace, "SELECT * FROM partida where idDeportivo =" . $idDepor);
$partidas = mysqli_fetch_array($sql3);
$cons = "SELECT * from calificacion where idDeportivo =" . $idDepor . " and idUsuario=" . $idUser;

$sql4 = mysqli_query($enlace, $cons);
$calif = mysqli_fetch_array($sql4);

if (isset($_POST['rating'])) {

    if (empty($calif)) {
        $consulta = "INSERT INTO calificacion(idUsuario,idDeportivo,calificacion) VALUES
        ($idUser,$idDepor," . $_POST['rating'] . ")";

    } else {
        $consulta = "UPDATE calificacion SET calificacion = " . $_POST['rating'] . " WHERE idUsuario = $idUser AND idDeportivo = $idDepor;";
    }

    updateRate($enlace, $consulta, $idUser);

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
    <script src="libraries/js/jquery.min.js"></script>
    <!--Datatable plugin CSS file -->
    <link rel="stylesheet" href="libraries/css/jquery.dataTables.min.css" />

    <!--Datatable plugin JS library file -->
    <script type="text/javascript" src="libraries/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="libraries\bootstrap-icons-1.11.3\bootstrap-icons-1.11.3\font/bootstrap-icons.min.css">
    <script src="libraries/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="libraries/js/deporBack.js"></script>
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

        #partidas {
            display: none;
        }

        #navId {
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

        table {
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
</head>

<body style="background-color: white;">
    <nav id="navId" class="navbar navbar-expand-lg navbar-light bg-ligh">
        <a class="navButton" href="index.php">Inicio</a>
        <a class="navButton" href="buscador.php">Deportivos</a>

        <a class="navButton" disabled href="#"></a>
        <?php
        validarNavBar($_SESSION);
        ?>
    </nav>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-4 sidenav">
                <img id="imgDep" class="img-thumbnail" src=<?php echo '"' . $arr[6] . '"' ?>>
                <b>
                    <p>Tu calificación: <?php
                    if (empty($calif[3])) {
                        echo 'N/A';
                    } else {
                        echo $calif[3];
                    }
                    ?>/5</p>

                </b>

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
                </form>


                <strong>
                    Dirección:
                </strong>
                <p><?php echo $arr[2]; ?></p>
                <b>
                    <i class="bi-alarm"></i> Horario:
                </b>
                <p><?php echo $arr[3]; ?></p>
                <b>Costo:</b><br>
                <?php
                if (!empty($arr['costo'])) {
                    echo "$" . $arr['costo'];
                } else {
                    echo "Gratuito";
                }
                ?>
                <br>
                <b>Aceptan Mascotas: </b>

                <p><?php
                if ($arr['aceptaMascotas'] == 0) {
                    echo "Prohibidas las mascotas";

                } else {
                    echo "Mascotas Bienvenidas";
                } ?></p>
                <b>Tipo de Espacio:</b>
                </b>
                <p><?php echo $arr['tipoEspacio']; ?></p>
                <b>
                    <p>Instalaciones:</p>
                </b>
                <p><?php echo $arr[4]; ?></p>
                <div class="">
                    <div id="map" style="width: 100%; height: 400px;"></div>
                    <script src="https://cdn.jsdelivr.net/npm/ol@v10.2.1/dist/ol.js"></script>
                    <script>

                        var latitude = 0;
                        var longitude = 0;

                        $.ajax({
                            url: 'https://maps.googleapis.com/maps/api/geocode/json',
                            type: 'GET',
                            data: {
                                address: '<?php echo $arr[2]; ?>',
                                key: 'AIzaSyCjDGDm_S9_UwCk7TBTOkP3UToE3rk3n90'
                            },
                            success: function (response) {
                                if (response.status === 'OK') {
                                    var coordenadas = response.results[0].geometry.location;

                                    arreglocoordenadas = [coordenadas.lng, coordenadas.lat];
                                    console.log(coordenadas);

                                    var coordenadasWEBMERC = ol.proj.fromLonLat(arreglocoordenadas);
                                    var map = new ol.Map({
                                        target: 'map',
                                        layers: [
                                            new ol.layer.Tile({
                                                source: new ol.source.OSM()
                                            })
                                        ],
                                        view: new ol.View({
                                            center: coordenadasWEBMERC,
                                            zoom: 17
                                        })

                                    });
                                    var marker = new ol.Feature({
                                        geometry: new ol.geom.Point(coordenadasWEBMERC)
                                    });

                                    var vectorSource = new ol.source.Vector({
                                        features: [marker]
                                    });

                                    var markerVectorLayer = new ol.layer.Vector({
                                        source: vectorSource
                                    });

                                    map.addLayer(markerVectorLayer);
                                    console.log(map);
                                } else {
                                    console.error('Error api geocoding: ' + response.status);
                                }
                            },
                            error: function () {
                                console.error('Error api geocoding.');
                            }
                        });
                        $.ajax({
                            url: 'https://maps.googleapis.com/maps/api/place/nearbysearch/json',
                            type: 'GET',
                            data: {
                                location: location.lat + ',' + location.lng,
                                radius: 1500,
                                type: 'store',
                                key: 'AIzaSyCjDGDm_S9_UwCk7TBTOkP3UToE3rk3n90'
                            },
                            success: function (response) {
                                if (response.status === 'OK') {
                                    var stores = response.results;
                                    stores.forEach(function (store) {
                                        var coordenadas = [store.geometry.location.lng, store.geometry.location.lat];
                                        var coordenadasWEBMERC = ol.proj.fromLonLat(coordenadas);
                                        var Marcador = new ol.Feature({
                                            geometry: new ol.geom.Point(coordenadasWEBMERC)
                                        });
                                        vectorSource.addFeature(Marcador);
                                    });
                                } else {
                                    console.error('Error api nearbysearch: ' + response.status);
                                }
                            },
                            error: function () {
                                console.error('Error nerabysearch request.');
                            }
                        });



                    </script>

                </div>
            </div>

            <div class="col-sm-8">
                <h1><?php echo $arr[1]; ?></h1>
                <hr>
                <?php
                if (!empty($_SESSION)) {
                    if (($_SESSION['id'] == $arr[19])) {
                        echo '<a href="cambioEspacios.php?id=' . $idDepor . '" class="btn btn-secondary btn-lg">Editar espacio</a>';
                    }
                    if (($_SESSION['tipo'] == 0)) {
                        echo '<a href="cambioEspacios.php?id=' . $idDepor . '" class="btn btn-secondary btn-lg">Editar espacio</a>
                        <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar espacio</button><hr>';
                    }
                }
                ?>
                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteeModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirmar borrar espacio</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de borrar el espacio? Ésta acción no se puede revertir.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <a href=<?php echo '"borrarEspacio.php?id=' . $idDepor . '"'; ?>><button type="button"
                                        class="btn btn-danger">Borrar</button></a>
                            </div>
                        </div>
                    </div>
                </div>


                <h6>Ingresa un comentario o avisa cuando irás de visita:</h6>
                <form role="form" method="post">
                    <div class="form-group">
                        <textarea class="form-control" name="comentario" rows="3"
                            placeholder="Recuerda ser respetuoso en todo momento." required></textarea>
                    </div><BR>
                    <input type="submit" class="btn btn-success" name="subComm" value="Enviar comentario">
                </form>
                <br><br>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">Comentarios</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Partidas</button>
                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                            type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Canchas</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <br>
                        <div id="coments" class="row" style="border-width: 2px; border-color: black;">
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
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><br>
                        <?php
                        if (!empty($_SESSION)) {

                            if (($_SESSION['tipo'] == 0) || ($_SESSION['id'] == $arr[19])) {
                                echo '<div class="d-grid gap-2">
                                <a class="btn btn-primary" href="registropartida.php?id=' . $_GET['id'] . '" >Agregar Partida</a>
                                </div>';
                            }
                        }
                        ?>
                        <br>
                        <table id="" class="display" style="width:100%">
                            <thead>
                                <tr>

                                    <th>Partida</th>
                                    <th>Fecha y Hora</th>
                                    <th>Detalles</th>
                                    <?php
                                    if (!empty($_SESSION)) {
                                        if (($_SESSION['id'] == $arr[19]) || ($_SESSION['tipo'] == 0)) {
                                            echo '<th>Controles</th>';
                                        }
                                        if (($_SESSION['tipo'] == 0)) {
                                            /*echo '<button type="button" class="btn btn-secondary btn-lg">Editar espacio</button> <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar espacio</button><hr>';*/
                                        }
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    $consulta = "SELECT partida.*, cancha.idCancha,cancha.etiqueta AS nombreCancha FROM partida JOIN cancha ON cancha.idCancha = partida.lugarPartida WHERE partida.idDeportivo =$idDepor";
                                    $resultado = mysqli_query($enlace, $consulta);

                                    while ($row = mysqli_fetch_array($resultado)) {

                                        ?>

                                        <td>
                                            <h2><?php echo $row['nombrePartida'] ?></h2>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <b>Deporte:</b><?php echo $row['deportePartida'] ?>
                                                    </td>
                                                </tr>
                                                <td colspan="2">
                                                    <b>Descripción:</b><br><?php echo $row['descripcionPartida'] ?>
                                                </td>
                                    </tr>
                            </table>
                            <?php
                            if (!empty($_SESSION)) {
                                $query = "SELECT * FROM participante where idPartida=" . $row['idPartida'] . " AND idUsuario=" . $_SESSION['id'];
                                $find = mysqli_query($enlace, $query);
                                $fetch = mysqli_fetch_array($find);

                                if (!empty($fetch)) {

                                    echo '<br><div class="d-grid gap-2">
                                            <a class="btn btn-danger" href="php/participarPartida.php?func=del&idPartida=' . $row['idPartida'] . '&id=' . $_SESSION['id'] . '" >Dejar de participar</a>
                                            </div>';

                                } else {
                                    echo '<br><div class="d-grid gap-2">
                                            <a class="btn btn-warning" href="php/participarPartida.php?func=ins&idPartida=' . $row['idPartida'] . '&id=' . $_SESSION['id'] . '" >Participar</a>
                                            </div>';
                                }
                            }
                            ?>
                            </td>

                            <td>
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <?php echo '<b>Cancha:</b>' . $row['nombreCancha']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <?php echo '<b>Fecha:</b>' . $row['fechaPartida']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: center;">
                                            <?php echo '<b>Hora:</b>' . $row['horaReunion']; ?>
                                        </td>
                                    </tr>

                                </table>


                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td colspan="2" style="text-align: center;">
                                            <?php echo '<b>Uniforme:</b><br>' . $row['uniformes']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: center;">
                                            <?php echo '<b>Nivel de Experiencia:</b><br>' . $row['nivelExperiencia']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: center;">
                                            <?php echo '<b>Público:</b>' . $row['publicoDirigido']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: center;">
                                            <?php echo '<b>Indicaciones extra:</b><br>' . $row['indicacionesExtra']; ?>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                            <?php
                            if (!empty($_SESSION)) {
                                if (($_SESSION['id'] == $arr[19]) || ($_SESSION['tipo'] == 0)) {
                                    echo '<td><a class="btn btn-secondary" href="#editar"><i class="bi bi-pencil-square"></i></a>';
                                }
                                if (($_SESSION['tipo'] == 0)) {
                                    echo '<a class="btn btn-danger" href="#editar"><i class="bi bi-trash"></i></a>';
                                    /*echo '<button type="button" class="btn btn-secondary btn-lg">Editar espacio</button> <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar espacio</button><hr>';*/
                                }
                                echo '</td>';
                            }
                            ?>
                            </tr>
                        <?php }
                                    ?>
                        </tbody>
                        </table>
                        <script>
                            /* Initialization of datatables */
                            $(document).ready(function () {
                                $('table.display').DataTable();
                            });
                        </script>


                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <br>
                        <?php
                        if (!empty($_SESSION)) {

                            if (($_SESSION['tipo'] == 0) || ($_SESSION['id'] == $arr[19])) {
                                echo '<div class="d-grid gap-2">
                                <a class="btn btn-primary" href="altaCanchas.php?id=' . $_GET['id'] . '" >Agregar Cancha</a>
                                </div>';
                            }
                        }
                        ?>
                        <br>
                        <table id="" class="display" style="width:100%">
                            <thead>
                                <tr>

                                    <th>Cancha</th>
                                    <th>Deporte</th>
                                    <th>Servicios</th>
                                    <?php
                                    if (!empty($_SESSION)) {
                                        if (($_SESSION['id'] == $arr[19]) || ($_SESSION['tipo'] == 0)) {
                                            echo '<th>Controles</th>';
                                        }
                                        if (($_SESSION['tipo'] == 0)) {
                                            /*echo '<button type="button" class="btn btn-secondary btn-lg">Editar espacio</button> <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar espacio</button><hr>';*/
                                        }
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    $consulta = "SELECT * FROM cancha WHERE idDeportivo=$idDepor";
                                    $resultado = mysqli_query($enlace, $consulta);
                                    $contModal = 1;
                                    while ($row = mysqli_fetch_array($resultado)) {

                                        ?>

                                        <td>
                                            <a href=<?php echo '"deportivo.php?id=' . $row['idDeportivo'] . '"' ?>>
                                                <h2><?php echo $row['etiqueta'] ?></h2>
                                            </a>
                                            <table>
                                                <tr>
                                                    <td colspan="2">
                                                        <b>Medidas:</b><?php echo '"' . $row['medidasCancha'] . '"' ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Horario: </b><br><?php echo $row['horarioCancha'] ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td colspan="2">
                                                        <?php echo '<b>' . $row['deporteCancha'] . '</b>'; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <?php echo '<b>Tipo de Suelo:</b><br>' . $row['tipoSueloCancha']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: center;">
                                                        <?php echo '<b>Equipamiento:</b><br>' . $row['equipamientoCanchaTipo']; ?>
                                                    </td>
                                                </tr>

                                            </table>


                                        </td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td colspan="2">
                                                        <?php echo '<b>Iluminación:</b>';
                                                        if ($row['iluminacionCanchaStatus'] == 0) {
                                                            echo '<i class="bi bi-x-square"></i>';
                                                        } else {
                                                            echo '<i class="bi bi-check-square"></i>';
                                                        }
                                                        ; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <?php echo '<b>Techado :</b>';
                                                        if ($row['techadoCancha'] == 0) {
                                                            echo '<i class="bi bi-x-square"></i>';
                                                        } else {
                                                            echo '<i class="bi bi-check-square"></i>';
                                                        }
                                                        ; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <?php echo '<b>Gradas: </b>';
                                                        if ($row['gradasCanchaStatus'] == 0) {
                                                            echo '<i class="bi bi-x-square"></i>';
                                                        } else {
                                                            echo '<i class="bi bi-check-square"></i>';
                                                        }
                                                        ; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <?php echo '<b>Baños: </b>';
                                                        if ($row['banosCanchasStatus'] == 0) {
                                                            echo '<i class="bi bi-x-square"></i>';
                                                        } else {
                                                            echo '<i class="bi bi-check-square"></i>';
                                                        }
                                                        ; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <?php echo '<b>Vestidores: </b>';
                                                        if ($row['vestidoresCanchaStatus'] == 0) {
                                                            echo '<i class="bi bi-x-square"></i>';
                                                        } else {
                                                            echo '<i class="bi bi-check-square"></i>';
                                                        }
                                                        ; ?>
                                                    </td>
                                                </tr>



                                            </table>
                                        </td>

                                        <?php
                                        if (!empty($_SESSION)) {
                                            if (($_SESSION['id'] == $arr[19]) || ($_SESSION['tipo'] == 0)) {
                                                echo '<td style="width: auto;"><a class="btn btn-secondary" href="cambioCanchas.php?id=' . $row['idCancha'] .'&idDepor='.$idDepor. '"><i class="bi bi-pencil-square"></i></a><br>';
                                            }
                                            if (($_SESSION['tipo'] == 0)) {

                                                echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCancha' . $contModal . '"><i class="bi bi-trash"></i></button><hr>';

                                                echo $row['idCancha'];


                                            }
                                            echo '</td>';
                                        }
                                        ?>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" <?php echo 'id="deleteCancha' . $contModal . '"' ?> tabindex="-1"
                                        aria-labelledby="deleteCanchaModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteCanchaModalLabel">Confirmar borrar
                                                        cancha</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de borrar la cancha? Ésta acción no se puede revertir.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <a href=<?php echo '"borrarCanchas.php?id=' . $row['idCancha'] . '"'; ?>><?php echo $row['idCancha']; ?><button type="button"
                                                            class="btn btn-danger">Borrar</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $contModal++;
                                    }
                                    ?>
                            </tbody>
                        </table>



                        <script>
                            /* Initialization of datatables */
                            $(document).ready(function () {
                                $('table.display').DataTable();
                            });
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div><br>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

</html>
<?php

if (empty($calif)) {
    $calif[3] = "N.A.";

    checarCalif(0);
} elseif ($calif[3] == 0) {
    checarCalif(0);
} else {
    checarCalif($calif[3]);
}

function delete()
{

}

function updateRate($link, $cons, $idUser)
{
    if ($idUser == -1) {
        echo '<script> window.location.href = "login.php";</script>';
    } else {
        $query = mysqli_query($link, $cons);
        echo '<script> window.location.href = "'.$_SERVER['HTTP_REFERER'].'";</script>';
    }
}


function checarCalif($val)
{
    echo "<script>reCheckbox(" . $val . ");</script>";
}


if (!empty($_POST["subComm"])) {

    if ($_SESSION == NULL) {
        //Redireccion por JavaScript
        echo '<script type="text/javascript">';
        echo 'window.location.href="login.php";';
        echo '</script>';
    }


    if (empty($_POST["comentario"])) {
        echo '<div class="alert alert-danger">LOS CAMPOS ESTAN VACIOS</div>';
    } else {
        $contenido = $_POST['comentario'];
        $autor = $_SESSION["id"];
        $fecha = date("Y-m-d H:i:s");
        $sql = mysqli_query($enlace, "INSERT INTO comentDeportivo(autor,contenido,fecha,idDeportivo) VALUES ($autor,'$contenido','$fecha',$idDepor)");
        echo '<script type="text/javascript">';
        echo 'window.location.href="deportivo.php?id=' . $idDepor . '";';
        echo '</script>';

    }
}
?>