 <?php

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
    $fecha_solicitud = new DateTime('now', new DateTimeZone('America/Santiago'));
    $fecha_solicitud = $fecha_solicitud->format('d-m-Y');
    $fechaSubidaDoc = $fecha_solicitud;
    $fecha_solicitud = strtotime($fecha_solicitud);
    $estado = 2;
    $host = $_SERVER['HTTP_HOST'];
    $ruta = '../../PDFS/FORMULARIOS/TELETRABAJO/';
    $baseURL = 'http://' . $host . '/solicitudes/PDFS/FORMULARIOS/TELETRABAJO/';


    $pdf_nacimiento = (!empty($_FILES['c_nacimiento_menor']['name'])) ? uniqid() . '.pdf' : '';
    $pdf_jurada = (!empty($_FILES['dj_sin_ayuda']['name'])) ? uniqid() . '.pdf' : '';
    $pdf_sentencia = (!empty($_FILES['sentencia_judicial']['name'])) ? uniqid() . '.pdf' : '';
    $pdf_aregular = (!empty($_FILES['alumno_regular']['name'])) ? uniqid() . '.pdf' : '';
    $pdf_establecimiento = (!empty($_FILES['c_establecimiento']['name'])) ? uniqid() . '.pdf' : '';
    $pdf_inscripcion = (!empty($_FILES['inscripcion_RND']['name'])) ? uniqid() . '.pdf' : '';
    $pdf_copia_inscripcion = (!empty($_FILES['copia_certificado']['name'])) ? uniqid() . '.pdf' : '';
    $pdf_mod_compat = (!empty($_FILES['modalidad_compatible']['name'])) ? uniqid() . '.pdf' : '';

    if (!file_exists($ruta . $nlug . $num_formulario)) {
        mkdir($ruta . $nlug . $num_formulario, 0777, true);
    }

    $ruta_nacimientoFINAL = NULL;

    if (!empty($pdf_nacimiento)) {
        $nombre_nacimiento = str_replace('-', '_', $rut) . 'Nacimiento_menor_' .  '_' . $pdf_nacimiento;
        $ruta_nacimientoFINAL = $baseURL . rtrim($nlug, '/') . '/' . $num_formulario . '/' . $nombre_nacimiento;
        move_uploaded_file($_FILES['c_nacimiento_menor']['tmp_name'], $ruta . $nlug . $num_formulario . '/' . $nombre_nacimiento);
    }


    $ruta_juradaFINAL = NULL;

    if (!empty($pdf_jurada)) {
        $nombre_jurada = str_replace('-', '_', $rut) . 'Declaracion_Jurada_' .  '_' . $pdf_jurada;
        $ruta_juradaFINAL = $baseURL . rtrim($nlug, '/') . '/' . $num_formulario . '/' . $nombre_jurada;
        move_uploaded_file($_FILES['dj_sin_ayuda']['tmp_name'], $ruta . $nlug . $num_formulario . '/' . $nombre_jurada);
    }



    $ruta_sentenciaFINAL = NULL;

    if (!empty($pdf_sentencia)) {
        $nombre_sentencia = str_replace('-', '_', $rut) . 'Sentencia_o_Resolucion' . str_replace('-', '_', $rut) . '_' . $pdf_sentencia;
        $ruta_sentenciaFINAL = $baseURL . rtrim($nlug, '/') . '/' . $num_formulario . '/' . $nombre_sentencia;
        move_uploaded_file($_FILES['sentencia_judicial']['tmp_name'], $ruta . $nlug . $num_formulario . '/' . $nombre_sentencia);
    }



    $ruta_aregularFINAL = NULL;

    if (!empty($pdf_aregular)) {
        $nombre_aregular = str_replace('-', '_', $rut) . 'Sentencia_o_Resolucion' . str_replace('-', '_', $rut) . '_' . $pdf_aregular;
        $ruta_aregularFINAL = $baseURL . rtrim($nlug, '/') . '/' . $num_formulario . '/' . $nombre_aregular;
        move_uploaded_file($_FILES['sentencia_judicial']['tmp_name'], $ruta . $nlug . $num_formulario . '/' . $nombre_aregular);
    }



    $ruta_establecimientoFINAL = NULL;

    
    if (!empty($pdf_aregular)) {
        $nombre_aregular = str_replace('-', '_', $rut) . 'Sentencia_o_Resolucion' . str_replace('-', '_', $rut) . '_' . $pdf_aregular;
        $ruta_establecimientoFINAL = $baseURL . rtrim($nlug, '/') . '/' . $num_formulario . '/' . $nombre_aregular;
        move_uploaded_file($_FILES['sentencia_judicial']['tmp_name'], $ruta . $nlug . $num_formulario . '/' . $nombre_aregular);
    }

    $ruta_inscripcionFINAL = NULL;
    $ruta_copia_inscripcionFINAL = NULL;
    $ruta_mod_compatFINAL = NULL;


    $sql = "INSERT INTO solicitudes.teletrabajo (IDTL,IDLugar,IDSit,tele_num_formulario,tele_nomb_funcionario,tele_rut_funcionario,tele_jornada,tele_estamento,tele_desde,tele_hasta,tele_estado_solicitud,tele_fecha_solicitud,
    tele_pdf_cnacimiento
    )
VALUES ($id_form,$lugar,$situacion,$num_formulario,'$nombre','$rut','$jornada','$estamento','$desde','$hasta',$estado,$fecha_solicitud,
'$ruta_nacimientoFINAL')";

    try {
        $resultado_sql = mysqli_query($conn_sol, $sql);
        if (!$resultado_sql) {
            throw new Exception(mysqli_error($conn_sol));
        } else {
            echo "<script>
      Swal.fire({
        icon: 'success',
        title: 'Guardado Correctamente',
        showConfirmButton: false,
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
