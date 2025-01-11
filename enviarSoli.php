<?php 
session_start();
include 'php/connection.php';
$enlace = conexion();
if(isset($_POST['subSoli'])){
    $soli=$_POST['solicitud'];
    $id=$_SESSION['id'];
    $match=$_GET['idPartida'];
    $query='INSERT INTO soliPartida(idPartida,idSolicitante,redaccion) VALUES ('.$match.','.$id.',"'.$soli.'" )';
   
    $exe=mysqli_query($enlace,$query);
}

echo '<script> window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";</script>';

?>