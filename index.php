<?php
require("./config/conexion.php");
$ver="SELECT tele_pdf_cnacimiento FROM solicitudes.teletrabajo WHERE IDTL=21";
$r= mysqli_query($conn_sol, $ver);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
while ($ruta = mysqli_fetch_array($r)) { ?>



<?php if (!empty($ruta['tele_pdf_cnacimiento'])) { ?>
    <div class="contenedor-botones">
        <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $ruta['tele_pdf_cnacimiento']; ?>', '_blank')">ver</button>
        <a href="<?php echo $ruta['tele_pdf_cnacimiento'] ?>" download class="btn btn-primary boton-descargar2 w-100">descargar</a>
    </div>
<?php } else { ?>
    <div class="contenedor-botones">
        <button disabled class="btn btn-primary pendiente w-100"><i class="fa-sharp fa-solid fa-clock"></i></button>
    </div>
<?php } 
}?>



</body>
</html>

