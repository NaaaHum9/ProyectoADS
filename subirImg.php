<?php
session_start();

$servidor = "localhost";
$usuario = "root";
$clave ="root";
$baseDeDatos = "aprovDep";

$enlace= mysqli_connect($servidor,$usuario,$clave,$baseDeDatos);
$consulta = "SELECT imagen FROM usuario where idUsuario=".$_SESSION["id"];
$sqlImg = mysqli_query($enlace,$consulta);
$old=mysqli_fetch_array($sqlImg);

// Verifica si se ha enviado una imagen
if(isset($_FILES['imagen'])) {
    // Nombre del archivo original
    $nombreImagen = $_FILES['imagen']['name'];

    // Directorio donde se guardará la imagen
    $directorio = 'img/';

    // Ruta completa para guardar la imagen
    $rutaArchivo = $directorio . basename($nombreImagen);

    // Verificar si el archivo es una imagen válida
    $tipoArchivo = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));
    $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif']; // Tipos de imágenes permitidas

    if(in_array($tipoArchivo, $tiposPermitidos)) {
        // Subir archivo al directorio
        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
            echo "La imagen se ha subido correctamente.\n";
            echo $rutaArchivo;
            $consulta = "UPDATE usuario SET imagen='$rutaArchivo' WHERE idUsuario =".$_SESSION["id"]."";
            echo $consulta;
            $sql=mysqli_query($enlace,$consulta);
            // Guardar la ruta de la imagen en la base de datos
            echo $old[0];

            if (file_exists($old[0])) {
                if (unlink($old[0])) {
                    echo "El archivo $old[0] ha sido eliminado correctamente.";
                } else {
                    echo "Hubo un error al intentar eliminar el archivo.";
                }
            } else {
                echo "El archivo no existe.";
            }

        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
    }
} else {
    echo "No se ha seleccionado ninguna imagen.";
}
header("location: perfil.php?myFlag");
?>
