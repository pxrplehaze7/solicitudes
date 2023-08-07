<?php
include("../../config/conexion.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F. Teletrabajo</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/img/favicon-32x32.png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <link href="../../assets/styles/teletrabajo.css" rel="stylesheet">
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
                        <h1>Formulario De Teletrabajo</h1>
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2 d-flex justify-content-end d-none d-sm-block">
                        <img src="../../assets/img/certificacion.jpg" width="100px">
                    </div>
                </div>


                <div class="container-solicitud">
                    <form id="form_teletrabajo" enctype="multipart/form-data" method="POST">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="nombrefuncionario"><span style="color: #c40055;">*</span> Nombre Completo</label>
                                <input type="text" class="form-control" id="nombrefuncionario" name="nombrefuncionario">
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label for="rut"><span style="color: #c40055;">*</span> R.U.T</label>
                                <input type="text" class="form-control" name="rut" id="rut">
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
                                    <label for="jornada"><span style="color: #c40055;">*</span> Jornada</label>
                                    <input type="text" class="form-control" id="jornada" name="jornada">
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-6">
                                <label for="estamento"><span style="color: #c40055;">*</span> Estamento</label>
                                <input type="text" class="form-control" id="estamento" name="estamento">
                                <br>
                            </div>
                            <div class="col-md-6">

                                <label for="situacion"><span style="color: #c40055;">*</span> Situación</label>
                                <select name="situacion" class="form-select" id="situacion" class="form-select" onchange="mostrarOcultarInputs()">
                                    <option value="" hidden> Selecciona</option>
                                    <?php
                                    mysqli_select_db($conn_sol, 'solicitudes');
                                    $situacion = "SELECT IDSit, sit_tipo_situacion FROM tl_situacion";
                                    $r_situacion = mysqli_query($conn_sol, $situacion);
                                    while ($row_situacion = mysqli_fetch_assoc($r_situacion)) {
                                        echo "<option value='" . $row_situacion['IDSit'] . "'>" . $row_situacion['sit_tipo_situacion'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>



                        <div class="row">
                            <p class="text-center titulo-radio"><span style="color: #c40055;">*</span> Periodo</p>
                            <div class="col-6">
                                <label for="desde"><span style="color: #c40055;">*</span> Desde</label>
                                <input type="date" class="form-control" name="desde" id="desde" onchange="validarPeriodo()">
                            </div>
                            <div class="col-6">
                                <label for="hasta"><span style="color: #c40055;">*</span> Hasta</label>
                                <input type="date" class="form-control" name="hasta" id="hasta">
                            </div>
                        </div>
                        <br>

                        <div class="documentos">
                            <h6>Documentos</h6>

                            <table id="tabla_documentos" class="table table-striped table-bordered table-centered" style="width:100%" data-search="false">
                                <thead>
                                    <tr>
                                        <th class="col-6">Nombre del documento</th>
                                        <th class="col-6">PDF</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle">Certificado de nacimiento del menor.</td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="c_nacimiento_menor" id="c_nacimiento_menor" accept=".pdf">
                                                <button class="buttonDelete" type="button" onclick="LimpiaInputFile('c_nacimiento_menor')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                    </svg>
                                                </button>
                                            </div>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="align-middle">Declaración Jurada que establece que el cuidador ejerce sus funciones sin ayuda.</td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="dj_sin_ayuda" id="dj_sin_ayuda" accept=".pdf">
                                                <button class="buttonDelete" type="button" onclick="LimpiaInputFile('dj_sin_ayuda')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Sentencia Judicial o resolución (según sea el caso).</td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="sentencia_judicial" id="sentencia_judicial" accept=".pdf">
                                                <button class="buttonDelete" type="button" onclick="LimpiaInputFile('sentencia_judicial')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                    </svg>
                                                </button>
                                            </div>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="align-middle">Certificado de Alumno Regular.</td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="alumno_regular" id="alumno_regular" accept=".pdf">
                                                <button class="buttonDelete" type="button" onclick="LimpiaInputFile('alumno_regular')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                    </svg>
                                                </button>
                                            </div>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="align-middle">Certificado del establecimiento de educación al que asiste el niño, niña o adolecente, que acredite el cierre de la institución.</td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="c_establecimiento" id="c_establecimiento" accept=".pdf">
                                                <button class="buttonDelete" type="button" onclick="LimpiaInputFile('c_establecimiento')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                    </svg>
                                                </button>
                                            </div>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="align-middle">Certificado de inscripción en el Registro Nacional de la Discapacidad de la persona bajo su cuidado.</td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="inscripcion_RND" id="inscripcion_RND" accept=".pdf">
                                                <button class="buttonDelete" type="button" onclick="LimpiaInputFile('inscripcion_RND')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                    </svg>
                                                </button>
                                            </div>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="align-middle">Copia del certificado, credencial o inscripción de discapacidad en el referido registro, emitido por la autoridad competente, en los términos de los artículos 13 y 17, ambos de la citada ley, correspondientes a la persona que tengan a su cuidado. O podrá acreditarse la discapacidad de esta última a través de la calidad de asignatario de pensión de invalidez.</td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="copia_certificado" id="copia_certificado" accept=".pdf">

                                                <button class="buttonDelete" type="button" onclick="LimpiaInputFile('copia_certificado')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                    </svg>
                                                </button>
                                            </div>


                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <table id="tabla_doc" class="table table-striped table-bordered table-centered" style="width:100%" data-search="false">
                                <thead>
                                    <tr>
                                        <th class="col-6">Compatibilidad de la Función</th>
                                        <th class="col-6">PDF</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle">Certificado de jefe directo que indica que modalidad es compatible con teletrabajo (debe contener lugar, sistema elegido, así como la modalidad de control y supervisión de las funciones).</td>
                                        <td class="align-middle">
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="modalidad_compatible" id="modalidad_compatible" accept=".pdf">
                                                <button class="buttonDelete" type="button" onclick="LimpiaInputFile('modalidad_compatible')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>


                            <div class="row">
                                <p class="text-center titulo-radio"><span style="color: #c40055;">*</span> Sistema Elegido</p>
                                <div class="container-radio col-md-12 d-flex justify-content-center">
                                    <div class="opciones">
                                        <label for="opcion1">
                                            <input type="radio" id="opcion1" name="radio" value="mixto" onchange="distribucion()">
                                            <span> Mixto (Parcial) con distribución de la jornada laboral</span>
                                        </label>
                                        <label for="opcion2">
                                            <input type="radio" id="opcion2" name="radio" value="teletrabajo" onchange="distribucion()">
                                            <span> Teletrabajo (Total)</span>
                                        </label>
                                    </div>
                                    <br>
                                </div>
                                <br>
                                <div id="dhorario">

                                    <div class="container-txtarea">
                                        <p class="text-center titulo-radio"><span style="color: #c40055;">*</span> Distribución de la Jornada Laboral</p>

                                        <textarea id="text_s_elegido" name="text_s_elegido" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class=" btn-container">
                            <button class="btn-content" type="submit">
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
    <script src="../../assets/js/oculta_input.js"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.js"></script>
</body>

</html>