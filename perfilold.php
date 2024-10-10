<?php
session_start();

$servidor = "localhost";
$usuario = "root";
$clave ="root";
$baseDeDatos = "aprovDep";

$enlace= mysqli_connect($servidor,$usuario,$clave,$baseDeDatos);
    
    if (isset($_GET['myFlag'])) {
        $idUser = $_SESSION["id"];
        
    } else {
        $idUser = $_GET['id'];
    }
    $consulta="SELECT * from usuario where idUsuario=$idUser";
    $sql=mysqli_query($enlace,$consulta);
    $arr = mysqli_fetch_array($sql);

    $sql2=mysqli_query($enlace,"SELECT *, usuario.nombre, usuario.imagen
    FROM comentUsuario INNER JOIN usuario ON comentUsuario.idUsuario = usuario.idUsuario where comentUsuario.idUsuario=$idUser");
    $sql3=mysqli_query($enlace,"SELECT contenido, fecha, autorID, imagen, comentedNombre
FROM (
    -- Primera subconsulta: Comentarios de usuario con usuario comentado
    SELECT contenido, fecha, autor.nombre AS autorID, autor.imagen AS imagen, comentado.nombre AS comentedNombre
    FROM comentUsuario
    INNER JOIN usuario AS autor ON comentUsuario.autor = autor.idUsuario
    INNER JOIN usuario AS comentado ON comentUsuario.idUsuario = comentado.idUsuario
    WHERE comentUsuario.autor = 1

    UNION ALL

    -- Segunda subconsulta: Comentarios deportivos con el nombre del deporte correcto
    SELECT contenido, fecha, usuario.nombre AS autorID, usuario.imagen AS imagen, deportivo.nombre AS comentedNombre
    FROM comentDeportivo
    INNER JOIN usuario ON comentDeportivo.autor = usuario.idUsuario
    INNER JOIN deportivo ON comentDeportivo.idDeportivo = deportivo.idDeportivo  -- Cambiado a hacer JOIN en la relación correcta
    WHERE comentDeportivo.autor = 1
) AS comentarios_comb

ORDER BY fecha DESC;");
    
?>


<!DOCTYPE html>
<html>
    <head>
        <title>
            Aprovechamiento de Espacios Deportivos
        </title>
        <style>
            body{
                background-color:  rgb(35, 81, 0);
                display: flex;
                flex-direction: column;
            }
            nav{
                height: 5vw;
                display: flex;
                background-color: green;
                justify-content: center;
                align-items: center;
                
            }
            .sectCom{
                height: 60vw;
                max-height: 20vw;
                overflow-y: scroll;
                overflow-x: hidden;
                border: 1px solid #ccc; 
            }
            .navButton{
                flex: auto;
                text-align: center;
                text-decoration: none;
                color: white;
                
            }
            textarea{
                width: 100%;
                height: 100%;
            }
            .canvas2{
              display: flex;
                align-items: center;
              
            }
            .canvas{
              display: flex;
                
            }
            .coment{padding: 2%;}
            #imgDep{
                width: 100%;
                height: 100%;
                max-width: 30vw;
                max-height: 20vw;
            }
            #perfil{
                width: 10vh;
                height: 10vh;
            }
            .side{
                background-color: aliceblue;
                width: 33%;
                padding: 2%;
            }
            .info{
                background-color: aliceblue;
                width: 58vw;
                padding: 2%;
            }
            .footer {
                padding: 20px;
                text-align: center;
                background: green;}
            
            </style>
    </head>
    <body>
    <nav>
            <a class="navButton" href="index.php">Inicio</a>
            <a class="navButton" href="buscador.php">Deportivos</a>
            <a class="navButton" disabled href="#"></a>
            <?php
                if($_SESSION!=NULL){
                    echo "<a class='navButton' href='perfil.php?myFlag'>Mi Cuenta</a><br>";
                    echo "<a class='navButton' href='logout.php'>Cerrar Sesión</a>";
                }else{
                    echo "<a class='navButton' href='login.php'>Inicio Sesión</a><br>";
                    echo "<a class='navButton' href='signup.php'>Registrar</a>";
                }
            ?>       
        </nav>
        <div class="canvas">
            <div class="side">
            <a href='test.php'>
                    <?php

                        if($arr[4]!= NULL){
                        echo "<img id='imgDep' src='".$arr[4]."'>";
                        }else{
                            echo "<img id='imgDep' src='https://st3.depositphotos.com/4111759/13425/v/450/depositphotos_134255532-stock-illustration-profile-placeholder-male-default-profile.jpg'>";
                        }
                    ?>
                    
                </a>
                <b><p>Deportes:</p></b>
                <b><p>Correo electrónico:</p></b>
                <p><?php echo $arr[2]?></p>
                <b><p>Descripción:</p></b>
                <p></p>
            </div>
            <div class="info">
                <h1><?php echo $arr[1]?></h1>
                <b><p>Reputación: <?php echo $arr[5]?>/5.0</p></b>
                <div>
                    <div>
                        <form>
                            
                            <button>Ver mis comentarios</button>
                        </form>
                    </div><br>
                    <div>
                        <p><b>Comentarios sobre ti:</b></p>
                        <div class="sectCom">
                            <?php while($row = $sql2->fetch_assoc()){
                                if($row['imagen']!= NULL){
                                    $ruta = $row['imagen'];
                                    }else{
                                        $ruta='https://st3.depositphotos.com/4111759/13425/v/450/depositphotos_134255532-stock-illustration-profile-placeholder-male-default-profile.jpg';
                                    }
                                ?>
                                <div class="canvas2">
                                <img id="perfil" src=<?php  echo "'$ruta'";?>>
                                <div class="coment">
                                    <b><p><?php echo $row['nombre']; ?></p></b>
                                    <p><?php echo $row['contenido']; ?></p>
                                    <p><?php
                                        $fecha = new DateTime($row['fecha']);
                                        $date = $fecha ->format('d-m-Y H:i A');
                                        echo $date; ?></p>
                                </div>
                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
                </div>
                
        </div>
        <div class="footer">
            <p class="copyright-text">Copyright &copy; 2024 All Rights Reserved by 
            </p>
        </div>
    </body>
</html>