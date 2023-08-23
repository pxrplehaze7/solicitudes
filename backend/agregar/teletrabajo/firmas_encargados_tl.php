<?php
require("../../../config/conexion.php");

if (!empty($_POST['idform'])) {
    $idform = $_POST['idform'];

    $fechaActual = new DateTime('now', new DateTimeZone('America/Santiago'));
    $fechaActual = $fechaActual->format('Y-m-d');

    if (isset($_POST['firma_director_cesfam'])) {
        $firma_director_c = $_POST['firma_director_cesfam'];
        $sql = "UPDATE solicitudes.teletrabajo SET tele_firma_direct_cesfam = '$firma_director_c' WHERE IDTL = $idform";
    } else if (isset($_POST['firma_subdirector'])) {
        $firma_subd_das = $_POST['firma_subdirector'];
        $ingreso = "SELECT tele_fecha_ingreso_das FROM solicitudes.teletrabajo WHERE IDTL = $idform";
        $result = mysqli_query($conn_sol, $ingreso);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $tele_fecha_ingreso_das = $row['tele_fecha_ingreso_das'];
        }
        if (empty($tele_fecha_ingreso_das)) {
            $tele_fecha_ingreso_das = $fechaActual;
        }
        $sql = "UPDATE solicitudes.teletrabajo SET tele_firma_subdirect_das = '$firma_subd_das', tele_fecha_ingreso_das = '$tele_fecha_ingreso_das'  WHERE IDTL = $idform";
    } else if (isset($_POST['firma_ugestion'])) {
        $firma_ugestion = $_POST['firma_ugestion'];
        $ingreso = "SELECT tele_fecha_ingreso_das FROM solicitudes.teletrabajo WHERE IDTL = $idform";
        $result = mysqli_query($conn_sol, $ingreso);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $tele_fecha_ingreso_das = $row['tele_fecha_ingreso_das'];
        }
        if (empty($tele_fecha_ingreso_das)) {
            $tele_fecha_ingreso_das = $fechaActual;
        }
        $sql = "UPDATE solicitudes.teletrabajo SET tele_firma_ugestion = '$firma_ugestion', tele_fecha_ingreso_das = '$tele_fecha_ingreso_das' WHERE IDTL = $idform";
    }


    if (mysqli_query($conn_sol, $sql)) {
        $response = array(
            'success' => true,
            'message' => 'Firmado exitosamente.'
        );
        echo json_encode($response);
    } else {
        $response = array(
            'success' => false,
            'message' => 'Error al firmar: ' . mysqli_error($conn_sol)
        );
        echo json_encode($response);
    }
}
mysqli_close($conn_sol);
