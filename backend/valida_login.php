<?php
session_start();
include("../config/conexion.php");
$correo = $_POST['iniciar_correo'];
$contrasenna = $_POST['iniciar_contrasenna'];

$login = "SELECT * FROM usuario_solicitudes WHERE usuario_correo = ?";
$stmt = $conn_sol->prepare($login);
$stmt->bind_param('s',$correo);
$stmt->execute();

$resultado = $stmt->get_result();
if ($resultado->num_rows ==1){

    $row = $result->fetch_assoc();
    $hashedPass = $row['iniciar_contrasenna'];

    if (password_verify($contrasenna, $hashedPass)){
        $nombre = $row['usuario_nombre'];
        $rut = $row['usuario_rut'];
        $correo = $row['usuario_correo'];
        $pass = $row['usuario_contrasenna'];
        $rol = $row['usuario_rol'];
        $rutafirma = $row['firma'];

    $_SESSION['nombre'] = $nombre;        
        $_SESSION['correo'] = $correo;
        $_SESSION['rut'] = $rut;
        $_SESSION['rol'] = $rol;
        $_SESSION['firma'] = $rutafirma;

    }
}

$_SESSION['login_error'] = true;
header('Location: ../../../login.php');
exit();

$conn_sol->close();

?>