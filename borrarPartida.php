<?php 
include 'php/connection.php';

$enlace = conexion();

$idPartida=$_GET['idPartida'];
$consulta="DELETE FROM partida WHERE idPartida =".$idPartida;
$fin=mysqli_query($enlace,$consulta);
echo '<script>alert("Borrado Exitoso");</script>';
echo '<script>window.location.href= "'.$_SERVER['HTTP_REFERER'].'"</script>';
?>