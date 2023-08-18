<?php
session_start();
include("../config/conexion.php");

// Verificar si las variables POST están establecidas
if (isset($_POST['iniciar_correo']) && isset($_POST['iniciar_contrasenna'])) {

    $correo = $_POST['iniciar_correo'];
    $contrasenna = $_POST['iniciar_contrasenna'];

    $login = "SELECT * FROM usuario_solicitudes WHERE usuario_correo = ?";
    $stmt = $conn_sol->prepare($login);
    $stmt->bind_param('s', $correo);
    $stmt->execute();

    $resultado = $stmt->get_result();
    if ($resultado->num_rows == 1) {
        $row = $resultado->fetch_assoc();
        $hashedPass = $row['usuario_contrasenna'];

        if (password_verify($contrasenna, $hashedPass)) {
            $_SESSION['nombre'] = $row['usuario_nombre'];
            $_SESSION['correo'] = $row['usuario_correo'];
            $_SESSION['rut'] = $row['usuario_rut'];
            $_SESSION['rol'] = $row['usuario_rol'];
            $_SESSION['firma'] = $row['firma'];

            header('Location: ../index.php');

            if (!empty($_SESSION['firma'])) {
                header('Location: ../index.php');
            } else {
                header('Location: ../perfil.php');
            }

            $conn_sol->close();
            exit();
        }
    }

    $_SESSION['login_error'] = true;
    echo "Las credenciales son incorrectas.";
    $conn_sol->close();
    // header('Location: .././login.php');
    exit();
    
} else {
    $_SESSION['login_error'] = true;
    echo "Por favor, envía las credenciales para iniciar sesión.";
    $conn_sol->close();
    // header('Location: .././login.php');
    exit();
}
