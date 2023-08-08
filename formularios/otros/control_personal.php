<?php
include("../../config/conexion.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Personal</title>
    <link rel="icon" type="image/png" href="../../assets/img/favicon-32x32.png">
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
                        <h1>Formulario de Control de Personal y Pago de Asignaciones Funcionarias</h1>
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2 d-flex justify-content-end d-none d-sm-block">
                        <img src="../../assets/img/certificacion.png" width="100px">
                    </div>
                </div>


                <div class="container-solicitud">

                    <div class="row">
                        <div class="col-md-6">

                            <label for="idSelectLugar"><span style="color: #c40055;">*</span> Lugar</label>
                            <select name="nameSelectLugar" id="idSelectLugar" class="form-select" ">
                                                    <option value="" hidden> Selecciona</option>
                                                    <?php
                                                    mysqli_select_db($conn, 'das');

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

                                <label for="motivo"><span style="color: #c40055;">*</span> Motivo</label>
                                <select name="motivo" class="form-select" id="motivo" class="form-select" onchange="mostrarOcultarInputs()">
                                    <option value="" hidden> Selecciona</option>
                                    <?php
                                    mysqli_select_db($conn_sol, 'solicitudes');
                                    $motivo = "SELECT IDMotivo, nomb_motivo FROM cpp_motivo";
                                    $r_motivo = mysqli_query($conn_sol, $motivo);
                                    while ($row_situacion = mysqli_fetch_assoc($r_motivo)) {
                                        echo "<option value='" . $row_situacion['IDMotivo'] . "'>" . $row_situacion['nomb_motivo'] . "</option>";
                                    }
                                    ?>
                                </select>
                        </div>
                    </div>


                    <div class="row">
                        <h4>Solicitud de Reemplazo</h4>
                        <div class="col-md-6">
                            <label for="nombreareemplazar"><span style="color: #c40055;">*</span> Nombre del funcionario a reemplazar</label>
                            <input type="text" class="form-control" id="nombreareemplazar" name="nombreareemplazar" required>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <label for="estamento"><span style="color: #c40055;">*</span> Estamento</label>
                            <input type="text" class="form-control" id="estamento" name="estamento" required>
                            <br>
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
                                <input type="text" class="form-control" id="jornada" name="jornada" required>
                        </div>
                    </div>




                    <div class="row">
                        <div class="col-md-6">
                            <label for="estamento"><span style="color: #c40055;">*</span> Estamento</label>
                            <input type="text" class="form-control" id="estamento" name="estamento" required>
                            <br>
                        </div>
                        <div class="col-md-6">

                            <label for="situacion"><span style="color: #c40055;">*</span> Motivo</label>
                            <select name="situacion" class="form-select" id="situacion" class="form-select" onchange="mostrarOcultarInputs()">
                                <option value="" hidden> Selecciona</option>
                                <?php
                                mysqli_select_db($conn, 'solicitudes');
                                $motivo = "SELECT IDMotivo, nomb_motivo FROM cpp_motivo";
                                $r_motivo = mysqli_query($conn, $motivo);
                                while ($row_situacion = mysqli_fetch_assoc($r_motivo)) {
                                    echo "<option value='" . $row_motivo['IDMotivo'] . "'>" . $row_motivo['nomb_motivo'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>



                    <div class="row">
                        <p class="text-center titulo-radio"><span style="color: #c40055;">*</span> Periodo</p>
                        <div class="col-6">
                            <label for="desde"><span style="color: #c40055;">*</span> Desde</label>
                            <input type="date" class="form-control" name="desde" id="desde" required onchange="validarPeriodo()">
                        </div>
                        <div class="col-6">
                            <label for="hasta"><span style="color: #c40055;">*</span> Hasta</label>
                            <input type="date" class="form-control" name="hasta" id="hasta" required>
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
                            <div class="container-radio col-md-6">
                                <label for="opciones"><span style="color: #c40055;">*</span> Seleccione</label>
                                <div class="opciones">
                                    <label for="opcion1">
                                        <input type="radio" id="opcion1" name="radio" value="mixto">
                                        <span> Mixto (Parcial) con distribución de la jornada laboral</span>
                                    </label>
                                    <label for="opcion2">
                                        <input type="radio" id="opcion2" name="radio" value="teletrabajo">
                                        <span> Teletrabajo (Total)</span>
                                    </label>
                                </div>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label for="text_s_elegido"><span style="color: #c40055;">*</span> Escriba la distribución de horario.</label>
                                <textarea id="text_s_elegido" name="text_s_elegido" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="contenedor-firma">

                    </div>

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