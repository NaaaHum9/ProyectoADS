<?php
include 'php/connection.php';
include 'php/buscadorBack.php';
$enlace = conexion();
session_start();

$consulta = "SELECT * from deportivo ";
$resultado = mysqli_query($enlace, $consulta);

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
    <script type="text/javascript" src="libraries/js/buscadorBack.js">
    </script>
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
            width: 100%;
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

        .imagen {
            width: 30%;
        }

        .tabla {
            background-color: rgb(255, 255, 255);
        }

        table {
            width: 100%;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-ligh">
        <a class="navButton" href="index.php">Inicio</a>
        <a class="navButton" href="#">Deportivos</a>
        <a class="navButton" disabled href="#"></a>
        <?php
        validarNavBar($_SESSION);
        ?>

    </nav>
    <div class="canvas">
        <div class="titulo">
            <div class="text">
                <h3>Programa de Aprovechamiento de Espacios Deportivos</h3>
            </div>

        </div>

    </div>

    <div id="resultados" class="tabla">
        <form name="filtro" method="post" class="form-inline">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input class="btn-check" type="radio" name="filtro" id="default" value="" onclick="showDiv(0)" checked>
                <label class="btn btn-outline-primary" for="default">Sin Filtro</label>

                <input type="radio" class="btn-check" name="filtro" id="radAlcaldia" value="alcaldia"
                    onclick="showDiv(1)">
                <label class="btn btn-outline-primary" for="radAlcaldia">Alcaldía</label>

                <input type="radio" class="btn-check" name="filtro" id="radDeporte" value="deporte"
                    onclick="showDiv(2)">
                <label class="btn btn-outline-primary" for="radDeporte">Deporte</label>

                <input type="radio" class="btn-check" name="filtro" id="radCosto" value="costo" onclick="showDiv(3)">
                <label class="btn btn-outline-primary" for="radCosto">Costo</label>

                <input type="radio" class="btn-check" name="filtro" id="radGradas" value="gradas" onclick="showDiv(4)">
                <label class="btn btn-outline-primary" for="radGradas">Gradas</label>

                <input type="radio" class="btn-check" name="filtro" id="radMascotas" value="mascota"
                    onclick="showDiv(5)">
                <label class="btn btn-outline-primary" for="radMascotas">Mascotas</label>

                <input type="submit" name="subBuscr" value="Filtrar" class="btn btn-primary">
            </div>
            <table>

                <tr>
                    <td colspan="7">
                        <div class="filter">
                            <select name="alcaldia" id="alcaldia" class="form-control">
                                <option value="" disabled selected>Selecciona una Alcaldía...</option>
                                <option value="Álvaro Obregón">Álvaro Obregón</option>
                                <option value="Azcapotzalco">Azcapotzalco</option>
                                <option value="Benito Juárez">Benito Juárez</option>
                                <option value="Coyoacán">Coyoacán</option>
                                <option value="Cuajimalpa de Morelos">Cuajimalpa de Morelos</option>
                                <option value="Cuauhtémoc">Cuauhtémoc</option>
                                <option value="Gustavo A. Madero">Gustavo A. Madero</option>
                                <option value="Iztacalco">Iztacalco</option>
                                <option value="Iztapalapa">Iztapalapa</option>
                                <option value="La Magdalena Contreras">La Magdalena Contreras</option>
                                <option value="Miguel Hidalgo">Miguel Hidalgo</option>
                                <option value="Milpa Alta">Milpa Alta</option>
                                <option value="Tláhuac">Tláhuac</option>
                                <option value="Tlalpan">Tlalpan</option>
                                <option value="Venustiano Carranza">Venustiano Carranza</option>
                                <option value="Xochimilco">Xochimilco</option>
                            </select>
                        </div>
                        <div class="filter">
                            <select name="deporte" id="deporte" class="form-control">
                                <option value="" disabled selected>Selecciona un deporte...</option>
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
                        </div>
                        <div class="filter">
                            <select name="costo" id="costo" class="form-control">
                                <option value="" disabled selected>Selecciona un coste de entrada...</option>
                                <option value="Gratuito">Gratuito</option>
                                <option value="Con Costo">Con Costo</option>
                            </select>
                        </div>
                        <div class="filter">
                            <select name="gradas" id="gradas" class="form-control">
                                <option value="" disabled selected>Selecciona una opción...</option>
                                <option value="Con gradas">Con gradas</option>
                                <option value="Sin gradas">Sin gradas</option>
                            </select>
                        </div>
                        <div class="filter">
                            <select name="mascota" id="mascota" class="form-control">
                                <option value="" disabled selected>Selecciona una opción...</option>
                                <option value="Pet">Pet Friendly</option>
                                <option value="NoPet">Mascotas Prohibidas</option>
                            </select>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (!empty($_SESSION)) {
        if ($_SESSION['tipo'] == 0) {
            echo '<div class="d-grid gap-2">
            <a class="btn btn-success" href="altaEspacios.php" >Agregar un espacio</a>
            </div>';
        }}
        ?>

        <table id="" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Costo</th>
                    <th>Calificación</th>
                    <th>Oferta</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    if (!empty($_POST["subBuscr"])) {


                        buscar($consulta, $enlace, $_POST);
                    } else {
                        buscar($consulta, $enlace, NULL);
                    }
                    ?>
                </tr>
            </tbody>
        </table>
        <script>
            /* Initialization of datatables */
            $(document).ready(function () {
                $('table.display').DataTable();
            });
        </script>
        <script>
            showDiv(0);
        </script>
</body>
<script></script>
<?php

?>

</html>