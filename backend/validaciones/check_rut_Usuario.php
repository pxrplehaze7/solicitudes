<?php
require("../.././config/conexion.php");
$rut = $_POST['rut'];
$sqlrutU = "SELECT * FROM usuario_solicitudes WHERE usuario_rut='$rut'";
$resultrutU = $conn_sol->query($sqlrutU);
if ($resultrutU->num_rows > 0) {
    echo '<div id="rut-validationU" class="alert alert-danger" role="alert">Este RUT ya está registrado</div>';
} else {
    echo "VALIDO";
  }
  $conn_sol->close();
  ?>
