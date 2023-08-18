 <?php

require_once '../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;


if (isset($_POST['rut'])) {
    include("../../config/conexion.php");

    $primary = "SELECT MAX(IDTL) AS ultimo_id FROM solicitudes.teletrabajo";
    $resultado = mysqli_query($conn_sol, $primary);
    $id = mysqli_fetch_assoc($resultado);
    $ultimoID = $id['ultimo_id'];
    if ($ultimoID === null) {
        $ultimoID = 0;
    }
    $id_form = $ultimoID + 1;

    $lugar = $_POST['nameSelectLugar'];
    switch($lugar){
        case 1: $nlug = 'DAS/'; break;
        case 2: $nlug = 'CESFAM_Pinares/'; break;
        case 3: $nlug = 'CESFAM_La Leonera/'; break;
        case 4: $nlug = 'CESFAM_Valle_la_Piedra/'; break;
        default: $nlug = 'CESFAM_Chiguayante/'; break;
    }

    $numf = "SELECT MAX(tele_num_formulario) AS ultimo_num FROM solicitudes.teletrabajo WHERE IDLugar = $lugar";
    $resultado2 = mysqli_query($conn_sol, $numf);
    $num = mysqli_fetch_assoc($resultado2);
    $ultimoID = $num['ultimo_num'];
    if ($ultimoID === null) {
        $ultimoID = 0;
    }
    $num_formulario = $ultimoID + 1;

    $nombre = $_POST['nombrefuncionario'];
    $rut = $_POST['rut'];
    $jornada = $_POST['jornada'];
    $estamento = $_POST['estamento'];
    $situacion = $_POST['situacion'];
    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];
    $sistema = $_POST['radio_sistema'];
    $distribucion = $_POST['text_s_elegido'];
    $firma = $_POST['firmapersona'];
    $fecha_solicitud = new DateTime('now', new DateTimeZone('America/Santiago'));
    $fecha_solicitudf = $fecha_solicitud->format('Y-m-d');
    // $fecha_solicitudf = $fecha_solicitud->format('d-m-Y');
    
    $estado = 2;
    $host = $_SERVER['HTTP_HOST'];
    $ruta = '../../FORMULARIOS_PDF/TELETRABAJO/';
    $baseURL = 'http://' . $host . '/solicitudes/FORMULARIOS_PDF/TELETRABAJO/';


    $pdf_nacimiento = (!empty($_FILES['c_nacimiento_menor']['name'])) ? uniqid() . '.pdf' : '';
    $pdf_jurada = (!empty($_FILES['dj_sin_ayuda']['name'])) ? uniqid() . '.pdf' : '';
    $pdf_sentencia = (!empty($_FILES['sentencia_judicial']['name'])) ? uniqid() . '.pdf' : '';
    $pdf_aregular = (!empty($_FILES['alumno_regular']['name'])) ? uniqid() . '.pdf' : '';
    $pdf_establecimiento = (!empty($_FILES['c_establecimiento']['name'])) ? uniqid() . '.pdf' : '';
    $pdf_inscripcion = (!empty($_FILES['inscripcion_RND']['name'])) ? uniqid() . '.pdf' : '';
    $pdf_copia_inscripcion = (!empty($_FILES['copia_certificado']['name'])) ? uniqid() . '.pdf' : '';
    $pdf_mod_compat = (!empty($_FILES['modalidad_compatible']['name'])) ? uniqid() . '.pdf' : '';


    
    
    $dompdf = new Dompdf();

    $htmlContent = '
    <h1>Detalles del Formulario</h1>
    <p><strong>Nombre:</strong> ' . $_POST['nombrefuncionario'] . '</p>
    '; // Continúa añadiendo el resto de la información que deseas en el PDF.

    $dompdf->loadHtml($htmlContent);

    // (Opcional) Establecer configuración de papel y orientación
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar el HTML como PDF
    $dompdf->render();



    if (!file_exists($ruta . $nlug . $num_formulario . '/ADJUNTOS/')) {
        mkdir($ruta . $nlug . $num_formulario . '/ADJUNTOS/', 0777, true);
    }

    // Guarda el archivo
    $nombre_pdflisto = 'FORMULARIO_TELETRABAJO_' . $rut;
    $filename = $ruta . $nlug . $num_formulario . '/' . $nombre_pdflisto . '.pdf';
    file_put_contents($filename, $dompdf->output());
    

    $filenameURL = $baseURL . $nlug . '/' . $num_formulario . '/' . $nombre_pdflisto . '.pdf';



    
    $ruta_nacimientoFINAL = NULL;
    if (!empty($pdf_nacimiento)) {
        $nombre_nacimiento = $rut . '_Nacimiento_menor_' .  '_' . $pdf_nacimiento;
        $ruta_nacimientoFINAL = $baseURL . rtrim($nlug, '/') . '/' . $num_formulario . '/ADJUNTOS/' . $nombre_nacimiento;
        move_uploaded_file($_FILES['c_nacimiento_menor']['tmp_name'], $ruta . $nlug . $num_formulario . '/ADJUNTOS/' . $nombre_nacimiento);
    }
    $ruta_juradaFINAL = NULL;
    if (!empty($pdf_jurada)) {
        $nombre_jurada = $rut . '_Declaracion_Jurada_' .  '_' . $pdf_jurada;
        $ruta_juradaFINAL = $baseURL . rtrim($nlug, '/') . '/' . $num_formulario . '/ADJUNTOS/' . $nombre_jurada;
        move_uploaded_file($_FILES['dj_sin_ayuda']['tmp_name'], $ruta . $nlug . $num_formulario . '/ADJUNTOS/' . $nombre_jurada);
    }
    $ruta_sentenciaFINAL = NULL;
    if (!empty($pdf_sentencia)) {
        $nombre_sentencia = $rut . '_Sentencia_o_Resolucion' . '_' . $pdf_sentencia;
        $ruta_sentenciaFINAL = $baseURL . rtrim($nlug, '/') . '/' . $num_formulario . '/ADJUNTOS/' . $nombre_sentencia;
        move_uploaded_file($_FILES['sentencia_judicial']['tmp_name'], $ruta . $nlug . $num_formulario . '/ADJUNTOS/' . $nombre_sentencia);
    }
    $ruta_aregularFINAL = NULL;
    if (!empty($pdf_aregular)) {
        $nombre_aregular = $rut . '_Alumno_regular' . '_' . $pdf_aregular;
        $ruta_aregularFINAL = $baseURL . rtrim($nlug, '/') . '/' . $num_formulario . '/ADJUNTOS/' . $nombre_aregular;
        move_uploaded_file($_FILES['alumno_regular']['tmp_name'], $ruta . $nlug . $num_formulario . '/ADJUNTOS/' . $nombre_aregular);
    }
    $ruta_establecimientoFINAL = NULL;
    if (!empty($pdf_establecimiento)) {
        $nombre_establecimiento = $rut . '_Certificado_establecimiento' . '_' . $pdf_establecimiento;
        $ruta_establecimientoFINAL = $baseURL . rtrim($nlug, '/') . '/' . $num_formulario . '/ADJUNTOS/' . $nombre_establecimiento;
        move_uploaded_file($_FILES['c_establecimiento']['tmp_name'], $ruta . $nlug . $num_formulario . '/ADJUNTOS/' . $nombre_establecimiento);
    }
    $ruta_inscripcionFINAL = NULL;
    if (!empty($pdf_inscripcion)) {
        $nombre_RND = $rut . '_Certificado_inscripcion_RND' . '_' . $pdf_inscripcion;
        $ruta_inscripcionFINAL = $baseURL . rtrim($nlug, '/') . '/' . $num_formulario . '/ADJUNTOS/' . $nombre_RND;
        move_uploaded_file($_FILES['inscripcion_RND']['tmp_name'], $ruta . $nlug . $num_formulario . '/ADJUNTOS/' . $nombre_RND);
    }
    $ruta_copia_inscripcionFINAL = NULL;

    if(!empty($pdf_copia_inscripcion)){
        $nombre_copia = $rut . '_Copia_RND' . '_' . $pdf_copia_inscripcion;
        $ruta_copia_inscripcionFINAL = $baseURL . rtrim($nlug,'/') . '/' . $num_formulario . '/ADJUNTOS/' . $nombre_copia;
        move_uploaded_file($_FILES['copia_certificado']['tmp_name'],$ruta . $nlug . $num_formulario . '/ADJUNTOS/' . $nombre_copia);
    }
    $ruta_mod_compatFINAL = NULL;
    if (!empty($pdf_mod_compat)) {
        $nombre_modalidad = $rut . '_Certificado_modalidad_compatible' . '_' . $pdf_mod_compat;
        $ruta_mod_compatFINAL = $baseURL . rtrim($nlug, '/') . '/' . $num_formulario . '/ADJUNTOS/' . $nombre_modalidad;
        move_uploaded_file($_FILES['modalidad_compatible']['tmp_name'], $ruta . $nlug . $num_formulario . '/ADJUNTOS/' . $nombre_modalidad);
    }

    $sql = "INSERT INTO solicitudes.teletrabajo (IDTL,IDLugar,IDSit,tele_num_formulario,tele_nomb_funcionario,tele_rut_funcionario,tele_jornada,tele_estamento,tele_desde,tele_hasta,tele_estado_solicitud,tele_fecha_solicitud,
    tele_sistema_elegido,tele_distribucion_jor,tele_pdf_cnacimiento,tele_pdf_djurada,tele_pdf_sentencia_r,tele_pdf_a_regular,tele_pdf_establecim,tele_pdf_cinscrip,tele_pdf_copia_cinscrip,tele_pdf_compat_funcion,tele_pdf_solicitud,tele_firma_solicitante
    )
VALUES ($id_form,$lugar,$situacion,$num_formulario,'$nombre','$rut','$jornada','$estamento','$desde','$hasta',$estado,'$fecha_solicitudf','$sistema','$distribucion','$ruta_nacimientoFINAL','$ruta_juradaFINAL','$ruta_sentenciaFINAL','$ruta_aregularFINAL','$ruta_establecimientoFINAL','$ruta_inscripcionFINAL','$ruta_copia_inscripcionFINAL','$ruta_mod_compatFINAL','$filenameURL','$firma')";

    try {
        $resultado_sql = mysqli_query($conn_sol, $sql);
        if (!$resultado_sql) {
            throw new Exception(mysqli_error($conn_sol));
        } else {
            echo "<script>
      Swal.fire({
        icon: 'success',
        title: 'Guardado Correctamente',
        text:'Su formulario es el número ". $num_formulario ."',
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#009CFD'
      }).then(() => {
      });
    </script>";
        }
    } catch (Exception $e) {
        if (file_exists($ruta . $nlug . $num_formulario)) {
            $files = glob($ruta . $nlug . $num_formulario . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($ruta . $nlug . $num_formulario);
        }
        echo "<script>
    Swal.fire({
      icon: 'error',
      title: 'Error al guardar los archivos: " . $e->getMessage() . "',
      showConfirmButton: true,
      confirmButtonText: 'Aceptar',
      confirmButtonColor: '#009CFD'
    });
  </script>";
    }
}
mysqli_close($conn_sol);
