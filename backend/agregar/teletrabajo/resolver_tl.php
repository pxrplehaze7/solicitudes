<?php
// echo json_encode(['success' => true, 'message' => 'Test exitoso']);
// exit;

require_once '../../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
require("../../../config/conexion.php");

if (!empty($_POST['idform'])) {
    require("../../../config/conexion.php");

    $idform = $_POST['idform'];
    $resolucion = $_POST['radio_resolucion'];
    $nombre_resuelve = $_POST['nombre_resuelve'];
    $host = $_SERVER['HTTP_HOST'];
    $ruta = '../../../FORMULARIOS_PDF/TELETRABAJO/';
    $baseURL = 'http://' . $host . '/solicitudes/FORMULARIOS_PDF/TELETRABAJO/';
    $dompdfRoot = $_SERVER['DOCUMENT_ROOT'];


    $fechaActual = new DateTime('now', new DateTimeZone('America/Santiago'));
    $fecharesolucion = $fechaActual->format('Y-m-d');

    if (empty($_POST['observaciones'])) {
        $observaciones = "Sin observaciones";
    } else {
        $observaciones = $_POST['observaciones'];
    }

    $sql = "UPDATE solicitudes.teletrabajo SET 
    tele_estado_solicitud = $resolucion, 
    tele_nomb_resuelve = '$nombre_resuelve', 
    tele_fecha_resolucion = '$fecharesolucion', 
    tele_observaciones = '$observaciones'
    WHERE IDTL = $idform ";
    
    if (mysqli_query($conn_sol, $sql)) {
        $consultaDatos = "SELECT * FROM solicitudes.teletrabajo WHERE IDTL = $idform";
        $resultadosdatos = mysqli_query($conn_sol, $consultaDatos);
        if (mysqli_num_rows($resultadosdatos) == 1) {
            $dato = mysqli_fetch_assoc($resultadosdatos);
            $idlugar = $dato['IDLugar'];
            $situacion = $dato['IDSit'];
            $numero_formulario = $dato['tele_num_formulario'];
            $nombre_funcionario = $dato['tele_nomb_funcionario'];
            $rut_funcionario = $dato['tele_rut_funcionario'];
            $jornada = $dato['tele_jornada'];
            $estamento = $dato['tele_estamento'];
            $desde = $dato['tele_desde'];
            $hasta = $dato['tele_hasta'];
            $nacimiento = $dato['tele_pdf_cnacimiento'];
            $djurada = $dato['tele_pdf_djurada'];
            $sentencia = $dato['tele_pdf_sentencia_r'];
            $alumnoR = $dato['tele_pdf_a_regular'];
            $establecimiento = $dato['tele_pdf_establecim'];
            $cinscripcion = $dato['tele_pdf_cinscrip'];
            $copia_cinscipcion = $dato['tele_pdf_copia_cinscrip'];
            $funcionCompat = $dato['tele_pdf_compat_funcion'];
            $sistema_e = $dato['tele_sistema_elegido'];
            $distribucion = $dato['tele_distribucion_jor'];
            $f_director = $dato['tele_firma_direct_cesfam'];
            $f_subdirector = $dato['tele_firma_subdirect_das'];
            $f_ugestion = $dato['tele_firma_ugestion'];
            $f_solicitante = $dato['tele_firma_solicitante'];
            $fecha_solicitud = $dato['tele_fecha_solicitud'];
            $fecha_ingreso_das = $dato['tele_fecha_ingreso_das'];
    
    
    
            if ($idlugar == 1) {
                $das = 'X';
                $nlug = 'DAS/';
            } else {
                $das = '';
            }
    
            if ($idlugar == 2) {
                $pinares = 'X';
                $nlug = 'CESFAM_Pinares/';
            } else {
                $pinares = '';
            }
    
    
            if ($idlugar == 3) {
                $leonera = 'X';
                $nlug = 'CESFAM_La Leonera/';
            } else {
                $leonera = '';
            }
    
    
            if ($idlugar == 4) {
                $valle = 'X';
                $nlug = 'CESFAM_Valle_la_Piedra/';
            } else {
                $valle = '';
            }
    
            if ($idlugar == 5) {
                $chiguayante = 'X';
                $nlug = 'CESFAM_Chiguayante/';
            } else {
                $chiguayante = '';
            }
            $dompdf = new Dompdf();
            $htmlContent =
            $htmlContent =
            '
            <style>
            #tabla_lugar {
                border-collapse: collapse;
                width: 100%;
            }
    
            #tabla_lugar, th, td {
                border: 1px solid black;
            }
    
            th, td {
                padding: 5px;
                text-align: center;
                width: 20%

            }
        body {
            font-family: Arial, sans-serif;
        }

        h1{
            text-align: center;
        }
    </style>
            
            <h1>FORMULARIO DE TELETRABAJO N° ' . $numero_formulario . ' </h1>
    
        <table id="tabla_lugar">
        <thead>
            <tr>
                <th>CESFAM Chiguayante</th>
                <th>CESFAM La Leonera</th>
                <th>CESFAM Pinares Dra. Eloísa Díaz Inzunza</th>
                <th>CESFAM Valle La Piedra</th>
                <th>DAS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>' . $chiguayante . '</td>
                <td>' . $leonera . '</td>
                <td>' . $pinares . '</td>
                <td>' . $valle . '</td>
                <td>' . $das . '</td>

            </tr>
        </tbody>
    </table>

    <table>
    <thead style="display: none;">
        <tr>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Nombre</td>
            <td>' . $nombre_funcionario . '</td>
        </tr>
        <tr>
            <td>R.U.T</td>
            <td>' . $rut_funcionario . '</td>
        </tr>
       
    </tbody>
</table>
<img src="' . $dompdfRoot . $f_director . '" alt="Imagen Descriptiva" />

    ';


            $dompdf->loadHtml($htmlContent);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            // Continuación del código para guardar el PDF...
            if (!file_exists($ruta . $nlug . $numero_formulario)) {
                mkdir($ruta . $nlug . $numero_formulario, 0777, true);
            }
            $nombre_pdflisto = 'FORMULARIO_TELETRABAJO_' . $rut_funcionario;
            $filename = $ruta . $nlug . $numero_formulario . '/' . $nombre_pdflisto . '_' . uniqid() .'.pdf';
            file_put_contents($filename, $dompdf->output());
            $filenameURL = $baseURL . $nlug . '/' . $numero_formulario . '/' . $nombre_pdflisto . '_' . uniqid() .'.pdf';

            // Respuesta de éxito con URL del PDF
            $response = array(
                'success' => true,
                'redirect' => true,
                'redirectURL' => '../home.php',
                'message' => 'Guardado exitosamente.',
                'pdf_url' => $filenameURL
            );
            echo json_encode($response);
        }
    } else {
        $response = array(
            'success' => false,
            'message' => 'Error al guardar: ' . mysqli_error($conn_sol)
        );
        echo json_encode($response);
    }
}
mysqli_close($conn_sol);
