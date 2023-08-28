<?php
session_start();
require("../../config/conexion.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = json_decode(file_get_contents('php://input'), true);
$image = $data["image"];
$rut = $data["rut"];

// Eliminando el prefijo del Base64
$uri = substr($image,strpos($image,",")+1);

// Decodificando Base64
$decodedData = base64_decode($uri);

// Crear un nombre único para el archivo usando el RUT
$uniqueName = $rut . "_" . uniqid() . ".png";
$host = $_SERVER['HTTP_HOST'];
// Definir la ruta completa de la imagen
$rutaFirma = '../../FIRMAS/' . $uniqueName;
$baseRutaFirma = 'http://' . $host . '/solicitudes/FIRMAS/';

$rutaFirmaFINAL=$baseRutaFirma . $uniqueName;
// Verificar si la carpeta "firmas" existe, si no, crearla
if (!file_exists("../../FIRMAS")) {
    mkdir("../../FIRMAS", 0777, true);
}

// Guardar la imagen en la ruta especificada
file_put_contents($rutaFirma, $decodedData);

// Guardando la ruta en la base de datos
$sql = "UPDATE solicitudes.usuario_solicitudes SET firma ='$rutaFirmaFINAL' WHERE usuario_rut='$rut'";

if ($conn->query($sql) === TRUE) {
    $_SESSION['firma']=$rutaFirmaFINAL;

    echo json_encode(['status' => 'success', 'message' => 'Imagen guardada exitosamente!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al guardar imagen: ' . $conn->error]);
}


$conn->close();
?>
