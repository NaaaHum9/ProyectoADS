<?php
include 'connection.php';
$enlace=conexion();
$id=$_GET['id'];
$match=$_GET['idPartida'];
$action=$_GET['func'];

if($action=="del"){
    $query='DELETE FROM participante WHERE idPartida='.$match.' AND idUsuario='.$id;
}elseif($action=="ins"){
    $query='INSERT INTO participante(idPartida,idUsuario) VALUES ('.$match.','.$id.' )';    
}elseif($action=='soli'){
    $query='INSERT INTO soliPartida(idPartida,idSolicitante) VALUES ('.$match.','.$id.' )';    
}elseif($action=="cancel"){
    $query="DELETE from soliPartida WHERE idPartida=".$match." AND idSolicitante=".$id;
}
$insert=mysqli_query($enlace,$query);
echo '<script>window.location.href="'.$_SERVER['HTTP_REFERER'].'";</script>';
?>