<?php 

include 'php/connection.php';
$enlace=conexion();
$id=$_GET['id'];
$perfil=$_GET['idPerfil'];
$action=$_GET['func'];

if($action=="soli"){
    $consulta="INSERT INTO soliamigo (idAmigo1,idAmigo2) VALUES (".$id.",".$perfil.")";
    $exe=mysqli_query($enlace,$consulta);
}elseif($action=="cancel"){
    $consulta="DELETE from soliamigo WHERE idAmigo1=".$id." AND idAmigo2=".$perfil;
    $exe=mysqli_query($enlace,$consulta);
}elseif($action=="aceptar"){
    $consulta="INSERT INTO amigo (idAmigo1,idAmigo2) VALUES (".$perfil.",".$id.")";
    $exe=mysqli_query($enlace,$consulta);
    $consulta="DELETE from soliamigo WHERE idAmigo1=".$perfil." AND idAmigo2=".$id;
    $exe=mysqli_query($enlace,$consulta);
}elseif($action=="del"){
    $consulta="DELETE from amigo WHERE idAmigo1=".$id." AND idAmigo2=".$perfil;
    $exe=mysqli_query($enlace,$consulta);
    $consulta="DELETE from amigo WHERE idAmigo1=".$perfil." AND idAmigo2=".$id;
    $exe=mysqli_query($enlace,$consulta);
}

echo '<script>window.location.href="'.$_SERVER['HTTP_REFERER'].'";</script>';
function enviarSoli(){}

function agregarAmigo(){}
?>