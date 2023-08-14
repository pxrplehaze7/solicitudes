<?php

include("../../config/conexion.php");


if (isset($_POST['namerut'])) {

  $pk = "SELECT MAX(IDFTEA) AS ultimo_id FROM solicitudes.funcionarios_tea";
  $resultado = mysqli_query($conn_sol, $pk);
  $id = mysqli_fetch_assoc($resultado);
  $ultimoID = $id['ultimo_id'];
  if ($ultimoID === null) {
    $ultimoID = 0;
  }
  $id_form = $ultimoID + 1;

  $lugar = $_POST['nameSelectLugar'];
  switch ($lugar) {
    case 1:
      $nlug = 'DAS/';
      break;
    case 2:
      $nlug = 'CESFAM_Pinares/';
      break;
    case 3:
      $nlug = 'CESFAM_La Leonera/';
      break;
    case 4:
      $nlug = 'CESFAM_Valle_la_Piedra/';
      break;
    default:
      $nlug = 'CESFAM_Chiguayante/';
      break;
  }

  $numf = "SELECT MAX(ftea_num_formulario) AS ultimo_num FROM solicitudes.funcionarios_tea WHERE IDLugar = $lugar";
  $resultado2 = mysqli_query($conn_sol, $numf);
  $num = mysqli_fetch_assoc($resultado2);
  $ultimoID = $num['ultimo_num'];
  if ($ultimoID === null) {
    $ultimoID = 0;
  }
  $num_formulario = $ultimoID + 1;

  $nombre = $_POST['nombrefuncionario'];
  $rut = $_POST['namerut'];
  echo "rut es: " .$rut;
  $nombreninno = $_POST['nombre_ninno'];
  $rutninno = $_POST['rut_ninno'];
  $estamento = $_POST['estamento'];

  $fecha_solicitud = new DateTime('now', new DateTimeZone('America/Santiago'));
  $fecha_solicitudf = $fecha_solicitud->format('Y-m-d');
  // $fecha_solicitudf = $fecha_solicitud->format('d-m-Y');

  $estado = 2;
  $host = $_SERVER['HTTP_HOST'];
  $ruta = '../../FORMULARIOS_PDF/CUIDADOR_TEA/';
  $baseURL = 'http://' . $host . '/solicitudes/FORMULARIOS_PDF/CUIDADOR_TEA/';

  $pdf_nacimiento = (!empty($_FILES['c_nacimiento']['name'])) ? uniqid() . '.pdf' : '';
  $pdf_certificadoM = (!empty($_FILES['c_medico']['name'])) ? uniqid() . '.pdf' : '';


  if (!file_exists($ruta . $nlug . $num_formulario . '/ADJUNTOS/')) {
    mkdir($ruta . $nlug . $num_formulario . '/ADJUNTOS/', 0777, true);
  }



  $ruta_nacimientoFINAL = NULL;
  if (!empty($pdf_nacimiento)) {
    $nombre_nacimiento = $rut . '_Nacimiento_menor_' .  '_' . $pdf_nacimiento;
    $ruta_nacimientoFINAL = $baseURL . rtrim($nlug, '/') . '/' . $num_formulario . '/ADJUNTOS/' . $nombre_nacimiento;
    move_uploaded_file($_FILES['c_nacimiento']['tmp_name'], $ruta . $nlug . $num_formulario . '/ADJUNTOS/' . $nombre_nacimiento);
  }
  $ruta_certificadomFINAL = NULL;
  if (!empty($pdf_certificadoM)) {
    $nombre_certificado = $rut . '_Certificado_Medico_' .  '_' . $pdf_certificadoM;
    $ruta_certificadomFINAL = $baseURL . rtrim($nlug, '/') . '/' . $num_formulario . '/ADJUNTOS/' . $nombre_certificado;
    move_uploaded_file($_FILES['c_medico']['tmp_name'], $ruta . $nlug . $num_formulario . '/ADJUNTOS/' . $nombre_certificado);
  }

  $sql = "INSERT INTO solicitudes.funcionarios_tea (IDFTEA,IDLugar,ftea_num_formulario,ftea_nomb_funcionario,ftea_rut_funcionario,ftea_estamento,ftea_nomb_ninno,ftea_rut_ninno,ftea_fecha_solicitud,ftea_pdf_nacimiento,ftea_pdf_diagnostico,ftea_estado_solicitud)
VALUES ($id_form,$lugar,$num_formulario,'$nombre','$rut','$estamento','$nombreninno','$rutninno','$fecha_solicitudf','$ruta_nacimientoFINAL','$ruta_certificadomFINAL',$estado)";
  try {
    $resultado_sql = mysqli_query($conn_sol, $sql);
    if (!$resultado_sql) {
      throw new Exception(mysqli_error($conn_sol));
    } else {
      echo "<script>
    Swal.fire({
      icon: 'success',
      title: 'Guardado Correctamente',
      text:'Su formulario es el número " . $num_formulario . "',
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
