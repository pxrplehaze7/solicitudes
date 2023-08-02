<?php
require("../.././config/conexion.php");
$correo = $_POST['correo'];
$sqlcorreoU = "SELECT * FROM usuario_solicitudes WHERE usuario_correo='$correo'";
$resultcorreo = $conn_sol->query($sqlcorreoU);
if ($resultcorreo->num_rows > 0) {
  echo '<div class="alert alert-danger" role="alert">Este correo ya está registrado</div>';
} else {
  echo "VALIDO";
}
$conn_sol->close();
?>
