<?php  
require("../../../config/conexion.php");

if (!empty($_POST['idform'])){
    $idform = $_POST['idform'];
    $resolucion = $_POST['radio_resolucion'];
    $nombre_resuelve = $_POST['nombre_resuelve'];

    $fechaActual = new DateTime('now', new DateTimeZone('America/Santiago'));
    $fecharesolucion = $fechaActual->format('Y-m-d');

    if (empty($_POST['observaciones'])){
        $observaciones="Sin observaciones";
    } else {
        $observaciones = $_POST['observaciones'];
    }


    $sql="UPDATE solicitudes.teletrabajo SET tele_estado_solicitud = $resolucion, tele_nomb_resuelve = '$nombre_resuelve', tele_fecha_resolucion = '$fecharesolucion', tele_observaciones = '$observaciones' WHERE IDTL = $idform ";
 if (mysqli_query($conn_sol, $sql)){
    $response = array(
        'success' => true,
        'message' => 'Guardado exitosamente.'
    );
    echo json_encode($response);
 } else {
    $response = array (
        'success' => false,
        'message' => 'Error al guardar: ' . mysqli_error($conn_sol)
    );
    echo json_encode($response);
 }
}
mysqli_close($conn_sol);
