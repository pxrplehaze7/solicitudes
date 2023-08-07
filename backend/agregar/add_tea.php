<?php


if (isset($_POST['IDUsu'])){
    $sqlids = "SELECT MAX(ft) AS ultimoID FROM trabajador";
    $resides = mysqli_query($conn, $sqlids);
    $ids = mysqli_fetch_assoc($resides);
    $ultimoID = $ids['ultimoID'];
    
    if ($ultimoID === null) {
      $ultimoID = 0;
    }
    $idtra = $ultimoID + 1;
    
$nombrefuncionario = $_POST['nombrefuncionario'];
$rutfuncionario = $_POST['rut'];
$nombreninno = $_POST['nombre_ninno']; 
$rutninno = $_POST['rut_ninno'];
$estamento = $_POST['estamento'];
$numformulario = $_POST['']
if ($_POST['nameSelectLugar'] != "") {
    // Si no está vacío, se asigna el valor
    $lugar = $_POST['nameSelectLugar'];
  } else {
    $lugar = NULL;
  }

  $host = $_SERVER['HTTP_HOST'];
  $ruta = 'PDFS/';






}

?>