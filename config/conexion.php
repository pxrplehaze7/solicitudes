<?php

$conn = mysqli_connect('localhost', 'root', '', 'das');
$conn_sol = mysqli_connect('localhost', 'root', '', 'solicitudes');

// SE VERIFICAN LOS DATOS DE CONEXION
if ((!$conn) || (!$conn_sol)) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>