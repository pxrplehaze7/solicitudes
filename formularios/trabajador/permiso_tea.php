<?php
include("../../config/conexion.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F. Cuidador TEA</title>
    <link rel="icon" type="image/png" href="../../assets/img/favicon-32x32.png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <link href="../../assets/styles/tea.css" rel="stylesheet">
    <link href="../../assets/styles/styles.css" rel="stylesheet">

</head>


<body class="sb-nav-fixed">
    <?php require("../../components/navbar.php") ?>
    <div id="layoutSidenav">
        <?php require("../../components/sidebar.php") ?>
        <div id="layoutSidenav_content">
            <div class="container-md">
                <div class="row titulo text-center">
                    <div class="col-xs-12 col-sm-2 col-md-2 d-flex justify-content-left d-none d-sm-block">
                        <img src="../../assets/img/salud_con_todo.jpg" width="100px">
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 d-flex align-items-center justify-content-center">
                        <h3>Formulario Solicitud Permiso Especial Ley TEA 21.545</h3>
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2 d-flex justify-content-end d-none d-sm-block">
                        <img src="../../assets/img/certificacion.jpg" width="100px">
                    </div>
                </div>
               <div class="text-justify">

 <h5><strong>Ley 21.545</strong></h5>
                <br>
                <p>
                    <strong>Artículo 25.- Agrégase en el Código del Trabajo el siguiente artículo 66 quinquies:
</strong>
                    <br>
                    "Artículo 66 quinquies.- Los trabajadores dependientes regidos por el Código del Trabajo, aquellos regidos por la ley Nº 18.834, sobre Estatuto Administrativo, cuyo texto refundido, coordinado y sistematizado fue fijado por el decreto con fuerza de ley N° 29, de 2004, del Ministerio de Hacienda y por la ley N° 18.883, que aprueba Estatuto Administrativo para Funcionarios Municipales, que sean padres, madres o tutores legales de menores de edad debidamente diagnosticados con trastorno del espectro autista, estarán facultados para acudir a emergencias respecto a su integridad en los establecimientos educacionales en los cuales cursen su enseñanza parvularia, básica o media.
                    El tiempo que estos trabajadores destinen a la atención de estas emergencias será considerado como trabajado para todos los efectos legales. El empleador no podrá, en caso alguno, calificar esta salida como intempestiva e injustificada para configurar la causal de abandono de trabajo establecida en la letra a) del número 4 del artículo 160, o como fundamento de una investigación sumaria o de un sumario administrativo, en su caso.
                    El trabajador deberá dar aviso a la Inspección del Trabajo del territorio respectivo respecto a la circunstancia de tener un hijo, hija o menor bajo su tutela legal, diagnosticado con trastorno del espectro autista.".

                </p>

               </div> 
               

                <div class="container-solicitud">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nombrefuncionario"><span style="color: #c40055;">*</span> Nombre Funcionaria/o</label>
                                <input type="text" class="form-control" id="nombrefuncionario" name="nombrefuncionario" required>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label for="rut"><span style="color: #c40055;">*</span> R.U.T Funcionario</label>
                                <input type="text" class="form-control" name="rut" id="rut" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <label for="idSelectLugar"><span style="color: #c40055;">*</span> Lugar</label>
                                <select name="nameSelectLugar" id="idSelectLugar" class="form-select" ">
                                                    <option value="" hidden> Selecciona</option>
                                                    <?php
                                                    $sqlLugar = "SELECT IDLugar, NombreLug FROM lugar";
                                                    $resultadoLugar = mysqli_query($conn, $sqlLugar);
                                                    while ($fila = mysqli_fetch_assoc($resultadoLugar)) {
                                                        echo "<option value='" . $fila['IDLugar'] . "'>" . $fila['NombreLug'] . "</option>";
                                                    }
                                                    ?> 
                        </select>
                          <br>
                    </div>
                  
                    <div class=" col-md-6">
                                    <label for="estamento"><span style="color: #c40055;">*</span> Estamento</label>
                                    <input type="text" class="form-control" id="estamento" name="estamento" required>
                                    <br>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <label for="nombre_ninno"><span style="color: #c40055;">*</span> Nombre niño, niña o adolecente</label>
                                <input type="text" class="form-control" id="nombre_ninno" name="nombre_ninno" required>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label for="establecimiento_e"><span style="color: #c40055;">*</span> Establecimiento Educacional</label>
                                <input type="text" class="form-control" name="establecimiento_e" id="establecimiento_e" required>
                                <br>
                            </div>
                            <div class="col-6">
                                <label for="fecha_permiso"><span style="color: #c40055;">*</span> Fecha Permiso</label>
                                <input type="date" class="form-control" name="fecha_permiso" id="fecha_permiso"">
                        </div>
                    </div>

                        <br>


                    


                        <div class=" contenedor-firma">

                            </div>

                            <br>
                            <div class=" btn-conteiner">
                                <button class="btn-content">
                                    <span class="btn-title">Enviar</span>
                                    <span class="icon-arrow">
                                        <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <path id="arrow-icon-one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                                <path id="arrow-icon-two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                                <path id="arrow-icon-three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    </div>

    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/datatables.js"></script>
    <script src="../../assets/js/sidebar.js"></script>
    <script src="../../assets/js/validaciones.js"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.js"></script>
</body>

</html>