<?php 
include 'php/connection.php';

$enlace = conexion();

$idCancha=$_GET['id'];
$consulta="DELETE FROM cancha WHERE idCancha =".$idCancha;
$fin=mysqli_query($enlace,$consulta);

echo '<script>window.location.href= "'.$_SERVER['HTTP_REFERER'].'"</script>';
?>