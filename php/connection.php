<?php
function conexion(){

    $servidor = "localhost";
    $usuario = "root";
    $clave ="root";
    $baseDeDatos = "test";

    $enlace= mysqli_connect($servidor,$usuario,$clave,$baseDeDatos);
    return $enlace;
}

function validarNavBar($sesion){
    if($sesion!=NULL){
        echo "<a class='navButton' href='perfil.php?myFlag'>Mi Cuenta</a><br>";
        echo "<a class='navButton' href='logout.php'>Cerrar Sesión</a>";
    }else{
        echo "<a class='navButton' href='login.php'>Inicio Sesión</a><br>";
        echo "<a class='navButton' href='signup.php'>Registrar</a>";
    }
}

?>