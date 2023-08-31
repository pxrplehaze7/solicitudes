
<?php
// echo json_encode(['success' => true, 'message' => 'Test exitoso']);
// exit;

require_once '../../../dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$options = new \Dompdf\Options();
$options->set('isHtml5ParserEnabled', true);
$options->set("isPhpEnabled", true);

$options->set("isRemoteEnabled", true);
// $options->set('tempDir', sys_get_temp_dir());
$dompdf = new Dompdf($options);
if (!empty($_POST['idform'])) {
    require("../../../config/conexion.php");

    $idform = $_POST['idform'];
    $resolucion = $_POST['radio_resolucion'];
    $nombre_resuelve = $_POST['nombre_resuelve'];
    $host = $_SERVER['HTTP_HOST'];
    $ruta = '../../../FORMULARIOS_PDF/TELETRABAJO/';
    $baseURL = 'http://' . $host . '/solicitudes/FORMULARIOS_PDF/TELETRABAJO/';


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


    function mesEnTexto($mesNumero)
    {
        $meses = array(
            '01' => 'enero',
            '02' => 'febrero',
            '03' => 'marzo',
            '04' => 'abril',
            '05' => 'mayo',
            '06' => 'junio',
            '07' => 'julio',
            '08' => 'agosto',
            '09' => 'septiembre',
            '10' => 'octubre',
            '11' => 'noviembre',
            '12' => 'diciembre'
        );
        return $meses[$mesNumero];
    }


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

            $fechadesde = strtotime($dato['tele_desde']);
            $diadesde = date('d', $fechadesde);
            $mesdesde = mesEnTexto(date('m', $fechadesde));
            $anodesde = date('Y', $fechadesde);
            $desde = $diadesde . ' de ' . $mesdesde . ' del ' . $anodesde;


            $fechahasta = strtotime($dato['tele_hasta']);
            $diahasta = date('d', $fechahasta);
            $meshasta = mesEnTexto(date('m', $fechahasta));
            $anohasta = date('Y', $fechahasta);
            $hasta = $diahasta . ' de ' . $meshasta . ' del ' . $anohasta;

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

            $fechasol = strtotime($dato['tele_fecha_solicitud']);
            $diasol = date('d', $fechasol);
            $messol = mesEnTexto(date('m', $fechasol));
            $anosol = date('Y', $fechasol);
            $f_solicitud = $diasol . ' de ' . $messol . ' del ' . $anosol;

            $fechaingresodas = strtotime($dato['tele_fecha_ingreso_das']);
            $diaingresodas = date('d', $fechaingresodas);
            $mesingresodas = mesEnTexto(date('m', $fechaingresodas));
            $anoingresodas = date('Y', $fechaingresodas);
            $f_ingresodas = $diaingresodas . ' de ' . $mesingresodas . ' del ' . $anoingresodas;


            $fechaArray = explode('-', $fecharesolucion);
            $diaresolucion = $fechaArray[2];
            $mesresolucion = mesEnTexto($fechaArray[1]);
            $anoresolucion = $fechaArray[0];
            $fecharesolucionTexto = $diaresolucion . ' de ' . $mesresolucion . ' del ' . $anoresolucion;




            $descripcion = ""; // Descripción inicial

            switch ($situacion) {
                case 1:
                    $descripcion = "Cuidado personal de al menos un niño o niña en etapa preescolar";
                    break;
                case 2:
                    $descripcion = "Cuidado personal de al menos un niño o niña menor de 12 años";
                    break;
                default:
                    $descripcion = "Cuidado de personas con alguna discapacidad";
                    break;
            }

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



            switch ($idlugar) {
                case 1:
                    $nombrelugar = "DAS";
                    $nlug = 'DAS/';
                    break;
                case 2:
                    $nombrelugar = "CESFAM Pinares Dra. Eloisa Díaz Inzunza";
                    $nlug = 'CESFAM_Pinares/';
                    break;
                case 3:
                    $nombrelugar = "CESFAM La Leonera";
                    $nlug = 'CESFAM_La Leonera/';
                    break;
                case 4:
                    $nombrelugar = "CESFAM Valle La Piedra";
                    $nlug = 'CESFAM_Valle_la_Piedra/';
                    break;
                default:
                    $nombrelugar = "CESFAM Chiguayante";
                    $nlug = 'CESFAM_Chiguayante/';
                    break;
            }




            // $dompdf = new Dompdf();

            $htmlContent =
                '

<!DOCTYPE html>
<html lang="">
<head>
<link rel="stylesheet" href="http://localhost/solicitudes/assets/styles/fontawesome-free-6.4.2-web/css/all.min.css">

<style>
 body {
        font-family: Arial, sans-serif;
    }


    h1 {
        text-align: center;
    }

    #tabla_lugar th, #tabla_lugar td {
        border: 1px solid black;
        padding: 5px;
        text-align: center;
        width: 20%  
    }

    #tabla_lugar th {
        background-color: #00a1ba;
        color: #fafafa;
        font-size:13px;
    }

   

    #firmas {
        width: 100%;
    }
    #firmas, #firmas th, #firmas td {
        border: 1px solid black;
    }

    #firmas th, #firmas td {
        padding: 5px;
        text-align: center;
        width: 20%
    }


    body {
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .col-4 {
        width: 33.33%;
        padding: 5px;
    }

    .col-4 img {
        width: 100%;
        height: auto;
    }
    .nombrefirma{
        text-align:center;
    }

    #adjuntos {
        border-collapse: collapse;
        width: 100%;
        font-size:13px;
    }

    #adjuntos, #adjuntos caption, #adjuntos td {
        border: 1px solid black;
    }

    #adjuntos th, #adjuntos td {
        padding: 5px;
        text-align: center;
        width: 20%
    }


    #adjuntos thead {
            display:none;    
        }

        
    #adjuntos td:first-child {
        width: 90%;
        text-align: left;
    }
    #adjuntos td:last-child {
        text-align: center;
        width: 10%;
    }    
.linea-firma {
    width: 200px; /* Asegúrate de que coincide con el ancho de la imagen */
    border: 0;
    border-top: 1px solid black; /* El color y el grosor de la línea */
    margin: 5px 0; /* Espaciado alrededor de la línea */
  }


#t1 td, #t1 th {
    border: 1px solid black;
    padding: 5px;
}

  
#t1 td:first-child {
background-color: #f2f2f2;
}



</style>

</head>
               
<body>
    
    <h1 style="font-size:25px">FORMULARIO DE TELETRABAJO N° ' . $numero_formulario . ' </h1>

    <table id="tabla_lugar" style=" border-collapse: collapse;width: 100%;">
        <thead>
            <tr>
                <th>CESFAM<br>Chiguayante</th>
                <th>CESFAM<br>La Leonera</th>
                <th>CESFAM<br>Pinares</th>
                <th>CESFAM<br>Valle La Piedra</th>
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
<br>


    <table id="t1" style=" border-collapse: collapse;width: 100%;">
        <thead style="display: none;">
            <tr>
                <th style="width:10%"></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td style="width:25%">Nombre</td>
                <td>' . $nombre_funcionario . '</td>
            </tr>

            <tr>
                <td style="width:25%">R.U.T</td>
                <td>' . $rut_funcionario . '</td>
            </tr>

            <tr>
                <td style="width:25%">Lugar</td>
                <td>' . $nombrelugar . '</td>
            </tr>

            <tr>
                <td style="width:25%">Estamento</td>
                <td>' . $estamento . '</td>
            </tr>

            <tr>
                <td style="width:25%">Jornada</td>
                <td>' . $jornada . '</td>
            </tr>
      ';

            $htmlContent .= '
            <tr>
                <td style="width:25%">Situación</td>
                <td>' . $descripcion . '</td>
            </tr>

            <tr>
                <td style="width:25%">Periodo</td>
                <td>Del ' . $desde . ' al ' . $hasta . '.</td>
            </tr>
            <tr>
                <td style="width:25%">Fecha Solicitud</td>
                <td>' . $f_solicitud . '</td>
            </tr>
            <tr>
                <td style="width:25%">Fecha Ingreso DAS</td>
                <td>' . $f_ingresodas . '</td>
            </tr>

            <tr>
                <td style="width:25%">Resuelve</td>
                <td>' . $nombre_resuelve . '</td>
            </tr>

            <tr>
                <td style="width:25%">Fecha Resolución</td>
                <td>' . $fecharesolucionTexto . '</td>
            </tr>
            
      
        </tbody>
    </table>

<br>
<table id="adjuntos">
        <caption style="background-color: #00a1ba; color: #fafafa; border:1px solid black; padding-top:5px; padding-bottom:5px;">
        Documentos Requeridos</caption>
    <thead>
        <tr>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>';
            if (($situacion == 1) || ($situacion == 2)) {
                $htmlContent .= '
    <tr>
        <td>Certificado de nacimiento del menor</td>';
                if (empty($dato['tele_pdf_cnacimiento'])) {
                    $htmlContent .= '<td><i class="fa-solid fa-circle-xmark" style="color: #f82616;"></i></td>';
                } else {
                    $htmlContent .= '<td><i class="fa-solid fa-circle-check" style="color: #00b303;"></i></td>
    </tr>';
                };

                $htmlContent .= '
    <tr>
        <td>Declaración Jurada que establece que el cuidador ejerce sus funciones sin ayuda</td>';
                if (empty($dato['tele_pdf_djurada'])) {
                    $htmlContent .= '<td><i class="fa-solid fa-circle-xmark" style="color: #f82616;"></i></td>';
                } else {
                    $htmlContent .= '<td><i class="fa-solid fa-circle-check" style="color: #00b303;"></i></td>
    </tr>';
                };


                $htmlContent .= '
    <tr>
        <td>Sentencia Judicial o resolución (según sea el caso</td>';
                if (empty($dato['tele_pdf_sentencia_r'])) {
                    $htmlContent .= '<td><i class="fa-solid fa-circle-xmark" style="color: #f82616;"></i></td>';
                } else {
                    $htmlContent .= '<td><i class="fa-solid fa-circle-check" style="color: #00b303;"></i></td>
    </tr>';
                };
            };



            if (($situacion == 2)) {
                $htmlContent .= '
    <tr>
        <td>Certificado de Alumno Regular</td>';
                if (empty($dato['tele_pdf_cnacimiento'])) {
                    $htmlContent .= '<td><i class="fa-solid fa-circle-xmark" style="color: #f82616;"></i></td>';
                } else {
                    $htmlContent .= '<td><i class="fa-solid fa-circle-check" style="color: #00b303;"></i></td>
    </tr>';
                };

                $htmlContent .= '
    <tr>
        <td>Certificado del establecimiento de educación al que asiste el niño, niña o adolecente, que acredite el cierre de la institución</td>';
                if (empty($dato['tele_pdf_djurada'])) {
                    $htmlContent .= '<td><i class="fa-solid fa-circle-xmark" style="color: #f82616;"></i></td>';
                } else {
                    $htmlContent .= '<td><i class="fa-solid fa-circle-check" style="color: #00b303;"></i></td>
    </tr>';
                };
            };


            if (($situacion == 3)) {
                $htmlContent .= '
    <tr>
        <td>Certificado de inscripción en el Registro Nacional de la Discapacidad de la persona bajo su cuidado</td>';
                if (empty($dato['tele_pdf_cnacimiento'])) {
                    $htmlContent .= '<td><i class="fa-solid fa-circle-xmark" style="color: #f82616;"></i></td>';
                } else {
                    $htmlContent .= '<td><i class="fa-solid fa-circle-check" style="color: #00b303;"></i></td>
    </tr>';
                };

                $htmlContent .= '
    <tr>
        <td>Copia del certificado, credencial o inscripción de discapacidad en el referido registro, emitido por la autoridad competente, en los términos de los artículos 13 y 17, ambos de la citada ley, correspondientes a la persona que tengan a su cuidado. O podrá acreditarse la discapacidad de esta última a través de la calidad de asignatario de pensión de invalidez</td>';
                if (empty($dato['tele_pdf_djurada'])) {
                    $htmlContent .= '<td><i class="fa-solid fa-circle-xmark" style="color: #f82616;"></i></td>';
                } else {
                    $htmlContent .= '<td><i class="fa-solid fa-circle-check" style="color: #00b303;"></i></td>
    </tr>';
                };
            };


            $htmlContent .= '
            <tr>
                <td>Certificado de jefe directo que indica que modalidad es compatible con teletrabajo (debe contener lugar, sistema elegido, así como la modalidad de control y supervisión de las funciones)</td>';
            if (empty($dato['tele_pdf_djurada'])) {
                $htmlContent .= '<td><i class="fa-solid fa-circle-xmark" style="color: #f82616;"></i></td>';
            } else {
                $htmlContent .= '<td><i class="fa-solid fa-circle-check" style="color: #00b303;"></i></td>
            </tr>';
            };



            $htmlContent .= '
    </tbody>
</table>

<table id="table">
<thead>
    <tr>
        <th class="col-4 nombrefirma"><img src="' . $f_director . '" alt="" /></th>
        <th class="col-4 nombrefirma"><img src="' . $f_subdirector . '" alt="" /></th>
        <th class="col-4 nombrefirma"><img src="' . $f_ugestion . '" alt="" /></th>
       
    </tr>
</thead>
<tbody>
<tr>
<td class="nombrefirma"><hr class="linea-firma"></td>
<td class="nombrefirma"><hr class="linea-firma"></td>
<td class="nombrefirma"><hr class="linea-firma"></td>
</tr>
    <tr>
        <td class="nombrefirma">Firma Director(a)<br>CESFAM</td>
        <td class="nombrefirma">Firma Subdirector<br>Administrativo DAS</td>
        <td class="nombrefirma">Firma Jefe Unidad de Gestión<br>y Desarrollo de Personas</td>
    </tr>
</tbody>
</table>
<br>
<i class="fa-sharp fa-solid fa-badge-check"></i>


<table id="estado" style=" border-collapse: collapse;width: 100%;">
<thead style="display: none;">
    <tr>
        <th></th>
        <th></th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>Resolución: </td>
        <td>' . $f_solicitud . '</td>
    </tr>
</tbody>
</table>





</body>
</html>

    ';

            $dompdf->loadHtml($htmlContent);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            // Continuación del código para guardar el PDF...
            if (!file_exists($ruta . $nlug . $numero_formulario)) {
                mkdir($ruta . $nlug . $numero_formulario, 0777, true);
            }
            $nombre_pdflisto = 'FORMULARIO_TELETRABAJO_' . $rut_funcionario;
            $filename = $ruta . $nlug . $numero_formulario . '/' . $nombre_pdflisto . '_' . uniqid() . '.pdf';
            file_put_contents($filename, $dompdf->output());
            $filenameURL = $baseURL . $nlug . '/' . $numero_formulario . '/' . $nombre_pdflisto . '_' . uniqid() . '.pdf';

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
