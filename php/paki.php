<?php 
function connectDB(){
    $servidor = "localhost";
    $usuario = "root";
    $clave ="root";
    $baseDeDatos = "test";
    $enlace= mysqli_connect($servidor,$usuario,$clave,$baseDeDatos);
    return $enlace;
}
function query($query){
    $link=connectDB();
    try{
        $exe=mysqli_query($link,$query);
        return $exe;

    }catch(Exception $e){
        echo '<script>alert("'.$e.'");</script>';
        return;

    }
    

}
?>