<?php
header('Content-Type: application/json');

$servidor = "localhost";
$usuario = "root";  
$clave = "root";
$baseDeDatos = "aprovDep";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    die(json_encode(['error' => 'Connection failed']));
}

$deportivo_id = isset($_GET['deportivo_id']) ? (int)$_GET['deportivo_id'] : 0;


$query = "
    SELECT 
        n.idNegocio,
        n.nombre,
        n.tipo,
        n.ubicacion,
        nd.ubicacion_especifica,
        nd.estado
    FROM negocio n
    INNER JOIN negocio_deportivo nd ON n.idNegocio = nd.idNegocio
    WHERE nd.idDeportivo = ? AND nd.estado = 'activo'
";

$stmt = $enlace->prepare($query);
$stmt->bind_param('i', $deportivo_id);
$stmt->execute();
$result = $stmt->get_result();

$businesses = [];
while ($row = $result->fetch_assoc()) {
    // Get coordinates for each business location
    $address = $row['ubicacion_especifica'] ?: $row['ubicacion'];
    $geocoding_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . 
                     urlencode($address) . 
                     '&key=AIzaSyCjDGDm_S9_UwCk7TBTOkP3UToE3rk3n90';
    
    $geocoding_response = file_get_contents($geocoding_url);
    $geocoding_data = json_decode($geocoding_response, true);
    
    if ($geocoding_data['status'] === 'OK') {
        $location = $geocoding_data['results'][0]['geometry']['location'];
        $row['lat'] = $location['lat'];
        $row['lng'] = $location['lng'];
        $businesses[] = $row;
    }
}

echo json_encode($businesses);