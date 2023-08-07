<?php
include(".././config/conexion.php");
$nombre = trim($_POST['r_nombre']);
$rut = trim($_POST['r_rut']);
$correo = trim($_POST['r_correo']);
$pass = trim($_POST['r_contrasenna']);
$correo    = str_replace(" ", "", $correo); 
$correo    = strtolower($correo);
$rol = 0;

$hashedPass = password_hash($pass, PASSWORD_DEFAULT);

$sqlUsuario = "INSERT INTO usuario_solicitudes (usuario_nombre,usuario_rut,usuario_correo,usuario_contrasenna,usuario_rol)
 VALUES ('$nombre','$rut','$correo','$hashedPass',$rol)";


if (mysqli_query($conn_sol, $sqlUsuario)) {
    $response = array(
        'success' => true,
        'message' => 'Usuario registrado exitosamente.',
        'tempPass' => $pass
    );
    echo json_encode($response);
} else {
    $response = array(
        'success' => false,
        'message' => 'Error al registrar: ' . mysqli_error($conn_sol)
    );
    echo json_encode($response);
}
mysqli_close($conn_sol);

?>