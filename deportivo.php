<?php
session_start();

$servidor = "localhost";
$usuario = "root";
$clave = "root";
$baseDeDatos = "aprovDep";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);


if (isset($_GET['id'])) {
    $idDepor = $_GET['id'];
    

} else {
    $idDepor = 1;
}
$consulta = "SELECT * from deportivo INNER JOIN imgDepor on imgDepor.idDeportivo=deportivo.idDeportivo 
where deportivo.idDeportivo=" . $idDepor;
$sql = mysqli_query($enlace, $consulta);


$sql2 = mysqli_query($enlace, "SELECT * , usuario.nombre, usuario.imagen
    FROM comentDeportivo INNER JOIN usuario ON comentDeportivo.autor = usuario.idUsuario where idDeportivo=$idDepor ORDER BY fecha DESC");
$arr = mysqli_fetch_array($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>
        Aprovechamiento de Espacios Deportivos
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        

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
</head>

<body style="background-color: rgba(255,255,255,0.75);">
    <nav  class="navbar navbar-expand-lg navbar-light bg-ligh">
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
                
                <img id="imgDep" class="img-thumbnail" src=<?php echo '"'.$arr[8].'"' ?> >
                <b>
                    <p>Calificación: <?php echo $arr[6]; ?>/5.0</p>
                </b>
                <strong>
                    Dirección:
                </strong>
                <p><?php echo $arr[2]; ?></p>
                <b>
                    <p>Horario:</p>
                </b>
                <p><?php echo $arr[3]; ?></p>
                <b>
                    <p>Instalaciones y Actividades:</p>
                </b>
                <p><?php echo $arr[4]; ?></p>
                <iframe src=<?php $arr[5]?> width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                            success: function(response) {
                                if (response.status === 'OK') {
                                    var coordenadas = response.results[0].geometry.location;
                                    
                                    arreglocoordenadas = [coordenadas.lng,coordenadas.lat];
                                    console.log(coordenadas);
                                    
                                    var coordenadasWEBMERC= ol.proj.fromLonLat(arreglocoordenadas);
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
                            error: function() {
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
                            success: function(response) {
                                if (response.status === 'OK') {
                                    var stores = response.results;
                                    stores.forEach(function(store) {
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
                            error: function() {
                                console.error('Error nerabysearch request.');
                            }
                        });
                        

                        
                    </script>
                    
                </div>
            </div>

            <div class="col-sm-6">
                <h1><?php echo $arr[1]; ?></h1>
                <hr>

                <h4>Ingresa un comentario o avisa cuando irás de visita:</h4>
                <form role="form" method="post">
                    <div class="form-group">
                        <textarea class="form-control" name="comentario" rows="3" placeholder="Recuerda ser respetuoso en todo momento." required></textarea>
                    </div><BR>
                    <input type="submit" class="btn btn-success" name="subComm" value="Enviar comentario">
                </form>
                <br><br>

                <p> Comentarios:</p><br>
                <div class="row" style="border-width: 2px; border-color: black;">
                    
                    <?php while ($row = $sql2->fetch_assoc()) {
                        if ($row['imagen'] != NULL) {
                            $ruta = $row['imagen'];
                        } 
                        $fecha = new DateTime($row['fecha']);
                        $date = $fecha->format('d-m-Y H:i A');
                        ?>
                        <div class="col-sm-2 text-center">
                            <a href=<?php echo '"perfil.php?id='.$row['autor'].'"' ?> >
                            <img id="perfil" src=<?php echo "'$ruta'"; ?> class="rounded" height="65" width="65"
                                alt="Avatar">
                            </a>
                        </div>
                        <div class="col-sm-10">
                            <h5><b><?php echo $row['nombre']." "; ?></b><small><?php echo $date; ?></small></h5>
                            <p><?php echo $row['contenido']; ?></p>
                            <br>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div><br>
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