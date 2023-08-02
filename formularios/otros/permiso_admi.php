<?php
include("../../config/conexion.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permiso Administrativo</title>
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
                        <h3>Solicitud de Permiso Administrativo</h3>
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2 d-flex justify-content-end d-none d-sm-block">
                        <img src="../../assets/img/certificacion.jpg" width="100px">
                    </div>
                </div>


                <div class="container-solicitud">


<p>Nombre funcionario: <input type="text" class="form-control" id="nombrefuncionario" name="nombrefuncionario" required> RUT:  <input type="text" class="form-control" name="rut" id="rut" required> Cargo:                             <input type="text" class="form-control" id="" name="" required> viene en solicitar permiso <strong>CON</strong> goce de remuneraciones por 
   </p>






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
                            <label for="nombre_ninno"><span style="color: #c40055;">*</span> Nombre niño, niña o adolecente</label>
                            <input type="text" class="form-control" id="nombre_ninno" name="nombre_ninno" required>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <label for="rut_ninno"><span style="color: #c40055;">*</span> R.U.T niño, niña o adolecente</label>
                            <input type="text" class="form-control" name="rut_ninno" id="rut_ninno" required>
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





                    <div class="documentos">
                        <h6>Documentos</h6>

                        <table id="tabla_documentos" class="table table-bordered table-centered" style="width:100%" data-search="false">
                            <thead>
                                <tr>
                                    <th class="col-6">Nombre del documento</th>
                                    <th class="col-6">PDF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle">Certificado de Nacimiento.</td>
                                    <td class="align-middle">
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="c_nacimiento" id="c_nacimiento" accept=".pdf">
                                            <button class="buttonDelete" type="button" onclick="LimpiaInputFile('c_nacimiento')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                </svg>
                                            </button>
                                        </div>

                                    </td>

                                </tr>
                                <tr>
                                    <td class="align-middle">Certificado Médico con Diagnóstico.</td>
                                    <td class="align-middle">
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="c_medico" id="c_medico" accept=".pdf">
                                            <button class="buttonDelete" type="button" onclick="LimpiaInputFile('c_medico')">
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


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.js"></script>
</body>

</html>