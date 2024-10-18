<?php
session_start();


$servidor = "localhost";
$usuario = "root";
$clave = "root";
$baseDeDatos = "test";

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!--Datatable plugin CSS file -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

    <!--jQuery library file -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js">
    </script>

    <!--Datatable plugin JS library file -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
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

    <div id="resultados" class="tabla">
        <form name="filtro" action="#" method="post" class="form-inline">
            <table>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="filtro" id="default" value="no" onclick="showDiv(0)"
                                checked>
                            <label class="form-check-label" for="default">
                                Sin Filtro
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="filtro" id="radAlcaldia" value="alcaldia"
                                onclick="showDiv(1)">
                            <label class="form-check-label" for="radAlcaldia">
                                Alcaldía
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="filtro" id="radDeporte" value="deporte"
                                onclick="showDiv(2)">
                            <label class="form-check-label" for="radDeporte">
                                Deportes
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="filtro" id="radCosto" value="costo"
                                onclick="showDiv(3)">
                            <label class="form-check-label" for="radCosto">
                                Costo
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="filtro" id="radGradas" value="gradas"
                                onclick="showDiv(4)">
                            <label class="form-check-label" for="radGradas">
                                Gradas
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="filtro" id="radMascotas" value="mascota"
                                onclick="showDiv(5)">
                            <label class="form-check-label" for="radMascotas">
                                Acepta Mascotas
                            </label>
                        </div>
                    </td>
                    <td>
                        <input type="submit" name="subBuscr" value="Filtrar" class="btn btn-primary">
                    </td>
                </tr>
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


        <div class="container">
            <table id="" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Calificación</th>
                        <th>Oferta</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    buscar($consulta, $enlace); ?><?php
                      function buscar($consulta, $enlace)
                      {
                          if (!empty($_POST["subBuscr"])) {

                              if (isset($_POST['filtro'])) {
                                  // Obtener el valor del radio button seleccionado
                                  $filtroSeleccionado = $_POST['filtro'];
                                  
                              }
                              if($filtroSeleccionado=="alcaldia"){
                                $busqueda=$_POST["alcaldia"];
                                $filtro = " WHERE direccion like '%" . $busqueda . "%'";
                                $consulta=$consulta.$filtro;
                              }
                              if($filtroSeleccionado=="deporte"){
                                $busqueda=$_POST["deporte"];
                                $consulta = "SELECT *, imgDepor.ruta FROM deportivo 
                                INNER JOIN imgDepor ON imgDepor.idDeportivo = deportivo.idDeportivo 
                                INNER JOIN cancha ON cancha.idDeportivo = deportivo.idDeportivo 
                                WHERE cancha.deporteCancha = '$busqueda'";
                              }
                              if($filtroSeleccionado=="gradas"){
                                $busqueda=$_POST["gradas"];
                                if ($busqueda=="Con gradas"){
                                    $consulta = "SELECT *, imgDepor.ruta FROM deportivo 
                                INNER JOIN imgDepor ON imgDepor.idDeportivo = deportivo.idDeportivo 
                                INNER JOIN cancha ON cancha.idDeportivo = deportivo.idDeportivo 
                                WHERE cancha.gradasCanchaCantidad = 0";
                                }else{
                                    $consulta = "SELECT *, imgDepor.ruta FROM deportivo 
                                INNER JOIN imgDepor ON imgDepor.idDeportivo = deportivo.idDeportivo 
                                INNER JOIN cancha ON cancha.idDeportivo = deportivo.idDeportivo 
                                WHERE cancha.gradasCanchaCantidad > 0";
                                }
                                

                              }
                              if($filtroSeleccionado=="costo"){
                                $busqueda=$_POST["costo"];
                                if ($busqueda=="Gratuito"){
                                    $filtro = " WHERE costo is NULL";
                                }else{
                                    $filtro = " WHERE costo is NOT NULL";
                                }
                                $consulta = $consulta.$filtro;
                                
                              }
                              if($filtroSeleccionado=="mascota"){
                                $busqueda=$_POST["mascota"];
                                if ($busqueda=="Pet"){
                                    $filtro = " WHERE aceptaMascotas = 1";
                                }else{
                                    $filtro = " WHERE aceptaMascotas = 0";
                                }
                                $consulta=$consulta.$filtro;
                                
                              }

                            /*$busqueda = (isset($_POST["consulta"])) ? $_POST["consulta"] : "";*/


                              
                          }

                          $resultado = mysqli_query($enlace, $consulta);
                          while ($row = mysqli_fetch_array($resultado)) {
                              $id = $row['idDeportivo']; ?>

                            <tr>
                                <td class="imagen">
                                    <a class="image-link" href=<?php echo '"deportivo.php?id=' . $row['idDeportivo'] . '"' ?>>
                                        <img class="image img-thumbnail" src=<?php echo '"' . $row['ruta'] . '"' ?>>
                                    </a>
                                </td>
                                <td>
                                    <a href=<?php echo '"deportivo.php?id=' . $row['idDeportivo'] . '"' ?>><?php echo $row['nombre'] ?></a>
                                </td>
                                <td>
                                    <?php echo $row['calificacion'] ?>
                                </td>
                                <td>
                                    <?php echo $row['oferta'] ?>
                                </td>
                            </tr>


                        <?php }
                      } ?>

                </tbody>
            </table>
        </div>
        <script>
            /* Initialization of datatables */
            $(document).ready(function () {
                $('table.display').DataTable();
            });
        </script>
        <script>
            function showDiv(val) {
                // Primero ocultamos todos los divs
                document.getElementById('alcaldia').style.display = 'none';
                document.getElementById('deporte').style.display = 'none';
                document.getElementById('costo').style.display = 'none';
                document.getElementById('gradas').style.display = 'none';
                document.getElementById('mascota').style.display = 'none';

                // Mostramos solo el div correspondiente
                if (val == 1) {
                    document.getElementById('alcaldia').style.display = 'inline-block';
                } else if (val == 2) {
                    document.getElementById('deporte').style.display = 'inline-block';
                } else if (val == 3) {
                    document.getElementById('costo').style.display = 'inline-block';
                } else if (val == 4) {
                    document.getElementById('gradas').style.display = 'inline-block';
                } else if (val == 5) {
                    document.getElementById('mascota').style.display = 'inline-block';
                }
            }
            showDiv(0);
        </script>
</body>

</html>