<?php 
include 'php/connection.php';

$enlace = conexion();

$idDepor=$_GET['id'];
$consulta="DELETE FROM deportivo WHERE idDeportivo =".$idDepor;
$fin=mysqli_query($enlace,$consulta);

echo '<script>window.location.href= "buscador.php"</script>';
?>