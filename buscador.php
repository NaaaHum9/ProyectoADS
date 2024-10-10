<?php
session_start();


$servidor = "localhost";
$usuario = "root";
$clave = "root";
$baseDeDatos = "aprovDep";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

$consulta = "SELECT *,imgDepor.ruta from deportivo INNER JOIN imgDepor on imgDepor.idDeportivo=deportivo.idDeportivo ";
$resultado = mysqli_query($enlace, $consulta);



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
        body {
            background-color: rgb(35, 81, 0);
            display: flex;
            flex-direction: column;
        }

        a {
            text-decoration: none;
        }


        .titulo {
            background-image: url("https://distritotec.tec.mx/sites/g/files/vgjovo1626/files/inline-images/centro-deportivo-borregos-2.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 50%;
            height: 40vh;
            width: 100%;
            font-size: 2rem;
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        .navButton {
            flex: auto;
            text-align: center;
            text-decoration: none;
            color: white;

        }

        .class {
            text-align: center;
            background-color: rgb(255, 255, 255, .65);
        }

        .canvas {
            display: flex;

        }

        .padd {
            padding: 2%;
            text-align: left;
        }

        h3 {
            background-color: rgba(0, 0, 0, .75);
            color: white;
            border-radius: 5px;
            padding: 2%;

        }

        .img {
            width: 50%;
            border-radius: 5%;
        }

        .footer {
            padding: 20px;
            text-align: center;
            background: green;
        }

        #resultados {
            width: 80%;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 15px;

        }

        .items {
            background-color: black;
            border-radius: 15px;
            padding: 10px;
        }
    </style>
    <style>
        .search-result-categories>li>a {
            color: #b6b6b6;
            font-weight: 400
        }

        .search-result-categories>li>a:hover {
            background-color: #ddd;
            color: #555
        }

        .search-result-categories>li>a>.glyphicon {
            margin-right: 5px
        }

        .search-result-categories>li>a>.badge {
            float: right
        }

        .search-results-count {
            margin-top: 10px
        }

        .search-result-item {
            padding: 20px;
            background-color: #fff;
            border-radius: 4px
        }

        .search-result-item:after,
        .search-result-item:before {
            content: " ";
            display: table
        }

        .search-result-item:after {
            clear: both
        }

        .search-result-item .image-link {
            display: block;
            overflow: hidden;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px
        }

        @media (min-width:768px) {
            .search-result-item .image-link {
                display: inline-block;
                margin: -20px 0 -20px -20px;
                float: left;
                width: 200px
            }
        }

        @media (max-width:767px) {
            .search-result-item .image-link {
                max-height: 200px
            }
        }

        .search-result-item .image {
            max-width: 100%
        }

        .search-result-item .info {
            margin-top: 2px;
            font-size: 12px;
            color: #999
        }

        .search-result-item .description {
            font-size: 13px
        }

        .search-result-item+.search-result-item {
            margin-top: 20px
        }

        @media (min-width:768px) {
            .search-result-item-body {
                margin-left: 200px
            }
        }

        .search-result-item-heading {
            font-weight: 400
        }

        .search-result-item-heading>a {
            color: #555
        }

        @media (min-width:768px) {
            .search-result-item-heading {
                margin: 0
            }
        }
    </style>
</head>

<body>
<nav  class="navbar navbar-expand-lg navbar-light bg-ligh">
        <a class="navButton" href="index.php">Inicio</a>
        <a class="navButton" href="#">Deportivos</a>
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
    <div class="canvas">
        <div class="titulo">
            <div class="text">
                <h3>Programa de Aprovechamiento de Espacios Deportivos</h3>
            </div>

        </div>

    </div>

    <div id="resultados">
        

        
        <form class="form-inline" name="buscador" action="#" method="post">
            
            <div class="form-group container-fluid">
            <div class="form-outline" data-mdb-input-init>
                <input type="text" onkeyup="buscar($consulta,$enlace)" name="consulta"
                placeholder="Busca un deportivo o una actividad" class="form-control " />
                
            </div>
            </div>
            <div class="form-group">
            <input type="submit" name="subBuscr" value="Buscar" class="btn btn-primary">
            </div>
    </form><br>
    <?php

        buscar($consulta, $enlace); ?><?php
    function buscar($consulta, $enlace)
    {
        if (!empty($_POST["subBuscr"])) {
            $busqueda = (isset($_POST["consulta"])) ? $_POST["consulta"] : "";


            if (isset($busqueda)) {
                $filtro = " WHERE nombre LIKE '%" . $busqueda . "%' OR oferta like '%" . $busqueda . "%' OR direccion like '%" . $busqueda . "%'";
                $consulta = $consulta . $filtro;

            }
        }
        $resultado = mysqli_query($enlace, $consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $id = $row['idDeportivo']; ?>

            <div class="container">
                <div class="row ng-scope">
                    <div class="col-md col-md">
                        <section class="search-result-item">
                            <a class="image-link" href=<?php echo '"deportivo.php?id=' . $row['idDeportivo'] . '"' ?>><img
                                    class="image img-thumbnail" src=<?php echo '"' . $row['ruta'] . '"' ?>>
                            </a>
                            <div class="search-result-item-body">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <h4 class="search-result-item-heading"><a href=<?php echo '"deportivo.php?id=' . $row['idDeportivo'] . '"' ?>><?php echo $row['nombre'] ?></a></h4>
                                        <p class="info">Calificacion: <?php echo $row['calificacion'] ?></p>
                                        <p class="description"><?php echo $row['oferta'] ?></p>
                                    </div>

                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        <?php }
    } ?>
</body>

</html>