<?php
require("../../config/conexion.php");

if (!empty($_POST['idform'])) {
    $numform = $_POST['idform'];


    if (!empty($_POST['firma_das'])) {
        $firma_ugestion = $_POST['firma_ugestion'];
    } else {
        $firma_ugestion = NULL;
    }

    if (!empty($_POST['firma_director_cesfam'])) {
        $firma_direct_cesfam = $_POST['firma_director_cesfam'];
    } else {
        $firma_direct_cesfam = NULL;
    }

    if (!empty($_POST['firma_subdirector'])) {
        $firma_subdirector_das = $_POST['firma_subdirector'];
    } else {
        $firma_subdirector_das = NULL;
    }


    $sqlf = "UPDATE solicitudes.teletrabajo SET tele_firma_ugestion = '$firma_ugestion',
    tele_firma_subdirect_das = '$firma_subdirector_das',
    tele_firma_direct_cesfam = '$firma_direct_cesfam'
     WHERE IDTL = $numform";
    try {
        $resultado_sql = mysqli_query($conn_sol, $sqlf);
        if (!$resultado_sql) {
            throw new Exception(mysqli_error($conn_sol));
        } else {
            echo "<script>
    Swal.fire({
      icon: 'success',
      title: 'FIRMA ACTUALIZADA Correctamente',
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
