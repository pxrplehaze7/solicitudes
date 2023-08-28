
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
            // la ruta en la base de datos seria: http://localhost/solicitudes/FIRMAS/19334538-7_64e75b05bb071.png
            // $imagenPath = $_SERVER['DOCUMENT_ROOT'] . "/solicitudes/FIRMAS/" . basename($f_director);

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

            // $dompdf = new Dompdf();

            $htmlContent =
                '

<!DOCTYPE html>
<html lang="">
<head>
<link rel="stylesheet" href="http://localhost/solicitudes/assets/styles/fontawesome-free-6.4.2-web/css/all.min.css">

<style>
    #tabla_lugar {
        border-collapse: collapse;
        width: 100%;
    }

    #tabla_lugar, #tabla_lugar th, #tabla_lugar td {
        border: 1px solid black;
    }

    #tabla_lugar th, #tabla_lugar td {
        padding: 5px;
        text-align: center;
        width: 20%
    }

    #tabla_lugar th {
        background-color: #00a1ba;
        color: #fafafa;
        font-size:13px;
    }

    body {
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
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
</style>

</head>
               
<body>
    
    <h1 style="font-size:25px">FORMULARIO DE TELETRABAJO N° ' . $numero_formulario . ' </h1>

    <table id="tabla_lugar">
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
    <table id="tabla_lugar">
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
                <td>R.U.T</td>
                <td>' . $rut_funcionario . '</td>
            </tr>
            <tr>
                <td>Estamento</td>
                <td>' . $estamento . '</td>
                <td>Jornada</td>
                <td>' . $jornada . '</td>
            </tr>';
            if ($situacion == 1) {
                $htmlContent .= '
                <tr>
                    <td>
                        Situación
                    </td>
                    <td>
                        Cuidado personal de al menos un niño o niña en etapa preescolar.
                    </td>';

                $htmlContent .= '</tr>';
            } elseif ($situacion == 2) {
                $htmlContent .= '
                <tr>
                    <td>
                        Situación
                    </td>
                <td>
                    Cuidado personal de al menos un niño o niña menor de 12 años.           
                </td>';
            } else {
                $htmlContent .= '
                <tr>
                    <td>
                        Situación
                    </td>

                    <td>
                        Cuidado personas con alguna discapacidad. 
                    </td>';
            }
            $htmlContent .= '
                <tr>
                    <td>Periodo</td>
                    <td>Desde ' . $desde . ' Hasta ' . $hasta . '</td>
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
        <td class="nombrefirma">Firma Director(a)<br>CESFAM</td>
        <td class="nombrefirma">Firma Subdirector<br>Administrativo DAS</td>
        <td class="nombrefirma">Firma Jefe Unidad de Gestión<br>y Desarrollo de Personas</td>
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
