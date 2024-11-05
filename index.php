<?php
include 'php/connection.php';
$enlace=conexion();
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Aprovechamiento de Espacios Deportivos
        </title>
        <link href="libraries/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            body{
                background-color:  rgb(35, 81, 0);
                display: flex;
                flex-direction: column;
            }
            
            .titulo{
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
            .navButton{
                flex: auto;
                text-align: center;
                text-decoration: none;
                color: white;
                
            }
            .class{
                text-align: center;
                background-color: rgb(255, 255, 255,.65);}
            .canvas{
              display: flex;
                
            }
            .padd{
                padding: 2%;
                text-align: left;
            }
            h3{
                background-color: rgba(0, 0, 0,.75);
                color: white;
                border-radius: 5px;
                padding: 2%;

            }

            .img{
                width: 50%;
                border-radius: 5%;
            }
            .footer {
  padding: 20px;
  text-align: center;
  background: green;}
        </style>
    </head>
    <body>
        <nav  class="navbar navbar-expand-lg navbar-light bg-ligh">
            <a class="navButton" href="#">Inicio</a>
            <a class="navButton" href="buscador.php">Deportivos</a>
            <a class="navButton" disabled href="#"></a>
            <?php
                validarNavBar($_SESSION);
            ?>
        </nav>
        <div class="container-fluid">
            <div class="titulo">
                <div class="text">
                    <h3>Programa de Aprovechamiento de Espacios Deportivos</h3>
                </div>
                
            </div>
            
        </div>
        <div class="class">
            <h1>¿Que encontrarás aquí?</h1>
            <div class="padd">
                <p>Este proyecto tiene la intención de aprovehcar al máximo los Espacios Deportivos a nivel nacional, informar sobre la infraestructura y las actividades y conectar a la comunidad que participa de estos centros.</p>
            </div>
            <div>
            </div>
            <img class="img" src="https://www.elheraldodechiapas.com.mx/republica/sociedad/2j7f5e-ninos-futbolistas/ALTERNATES/LANDSCAPE_768/Nin%CC%83os%20futbolistas">
            <h2>Busca informacion de tu deportivo cercano</h2>
            <p>Revisa la variedad de deportivos en nuestro listado y descubre que actividades se llevan a cabo, las áreas deportivas disponibles en ellos, así cómo también los horarios, dirección entre otros medios de contacto.</p>
            <h2>Comparte comentarios con la comunidad</h2>
            <p>Puedes dejar comentarios a los deportivos para compartir tu opinión y calificarlos, también puedes anunciar tus actividades o puedes avisar que buscas una reta a la hora y día que tienes disponible, quiza alguien pueda acompañarte</p>
            <h2>¡Juega limpio! Cuida tu reputación</h2>
            <p>También puedes dejar comentarios de otros usuarios, puedes avisar de que alguien no juega limpio o por el contrario recomendar a los buenos y dejarles una buena calificación.</p>
            <img class="img" src="https://www.anahuac.mx/mexico/sites/default/files/inline-images/Como-construir-una-buena-reputacion-empresarial-2.jpg">
        </div>
        <div class="footer">
            <p class="copyright-text">Copyright &copy; 2024 All Rights Reserved by 
            </p>
        </div>
    </body>
</html>