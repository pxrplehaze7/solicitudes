<?php
include(".././config/conexion.php");

// SI LA PERSONA NO ESTA ADMIN, NO PUEDE VER
session_start();
if (!isset($_SESSION['rol'])==1)

// deberia ser 0 pero por mientras pongo 1 para verlo
{
    header('Location: ../index.php');
    exit();
} 



// SI NO HAY RESULTADOS DE LA CONSULTA, REDIRIGE A INICIO

    $idtl = $_GET['idtl'];
    $query = "SELECT * FROM solicitudes.teletrabajo WHERE IDTL = '$idtl'";
    $res = mysqli_query($conn_sol, $query);
    if (mysqli_num_rows($res) == 1) {
        $formulario_tl = mysqli_fetch_assoc($res);
    



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>F. Teletrabajo</title>
        <link rel="shortcut icon" type="image/png" href=".././assets/img/favicon-32x32.png">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet" />
        <link href=".././assets/styles/teletrabajo.css" rel="stylesheet">
        <link href=".././assets/styles/styles.css" rel="stylesheet">

    </head>


    <body class="sb-nav-fixed">


        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="home.php"><img src="../../assets/img/logo.png" width="30px"> DAS Chiguayante</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg></button>
            <!-- Navbar Search-->
            <form class="d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 text-end" action="" method="POST" id="searchForm">
                <div class="input-group">
                    <input class="form-control" type="text" name="nameBuscaRut" id="nameBuscaRut" placeholder="19876543-K" pattern="^\d{7,8}-[kK\d]$" maxlength="10" minlength="9" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary btn-buscar" id="btnNavbarSearch" type="submit" disabled><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav me-3">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        </svg></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="editar_mi_perfil.php">Editar perfil</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="./controller/logout.php">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Principal</div>
                            <a class="nav-link" href="home.php">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                                Inicio
                            </a>

                            <div class="sb-sidenav-menu-heading">Registro</div>

                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseTrabajador" aria-expanded="false" aria-controls="collapseTrabajador">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Trabajador
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="collapseTrabajador" aria-labelledby="headingTrabajador" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionTrabajador">
                                    <a class="nav-link" href="registro_contrata.php">
                                        A Contrata e Indefinidos
                                    </a>

                                    <a class="nav-link" href="registro_honorario.php">
                                        A honorarios
                                    </a>
                                </nav>
                            </div>

                            <a class="nav-link" href="registrar_usuario.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Usuario
                            </a>




                            <div class="sb-sidenav-menu-heading">Tablas</div>


                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseListaTrabajadores" aria-expanded="false" aria-controls="collapseListaTrabajadores">
                                <div class="sb-nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
                                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z" />
                                    </svg>
                                </div>
                                Lista de Trabajadores
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="collapseListaTrabajadores" aria-labelledby="headingListaTrabajadores" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionListaTrabajadores">
                                    <a class="nav-link" href="lista_contrata.php">
                                        A Contrata e Indefinidos
                                    </a>

                                    <a class="nav-link" href="lista_honorarios.php">
                                        A honorarios
                                    </a>
                                </nav>
                            </div>


                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseListaDecretos" aria-expanded="false" aria-controls="collapseListaDecretos">
                                <div class="sb-nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
                                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z" />
                                    </svg>
                                </div>
                                Lista de Decretos
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="collapseListaDecretos" aria-labelledby="headingListaDecretos" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionListaDecretos">
                                    <a class="nav-link" href="lista_dec_contrata.php">
                                        A Contrata e Indefinidos
                                    </a>

                                    <a class="nav-link" href="lista_dec_honorario.php">
                                        A honorarios
                                    </a>
                                </nav>
                            </div>




                            <a class="nav-link" href="lista_usuarios.php">
                                <div class="sb-nav-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
                                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z" />
                                    </svg>
                                </div>
                                Lista de Usuarios
                            </a>

                        </div>
                    </div>


                    <div class="sb-sidenav-footer">

                        <div class="small">Usuario conectado como:</div>

                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <div class="container-md">
                    <div class="row titulo text-center">
                        <div class="col-xs-12 col-sm-2 col-md-2 d-flex justify-content-left d-none d-sm-block">
                            <img src=".././assets/img/salud_con_todo.jpg" width="100px">
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8 d-flex align-items-center justify-content-center">
                            <h1>Formulario De Teletrabajo N° <?php echo $formulario_tl['tele_num_formulario'] ?></h1>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 d-flex justify-content-end d-none d-sm-block">
                            <img src=".././assets/img/certificacion.png" width="100px">
                        </div>
                    </div>


                    <div class="container-solicitud">
                        <form id="form_teletrabajo" enctype="multipart/form-data" method="POST">




                            <table id="tabla_documentos" class="table table-striped table-bordered table-centered" style="width:100%;" data-search="false">
                                <thead style="display: none;">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle" width="50%">Nombre Completo</td>
                                        <td class="align-middle"><?php echo $formulario_tl['tele_nomb_funcionario'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">R.U.T</td>
                                        <td class="align-middle"><?php echo $formulario_tl['tele_rut_funcionario'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Lugar</td>
                                        <td class="align-middle"> <?php if ($formulario_tl['IDLugar'] == 1) { ?>
                                                <input class="form-control" value="Dirección de Admistración de Salud" disabled>
                                            <?php  } ?>
                                            <?php if ($formulario_tl['IDLugar'] == 2) { ?>
                                                CESFAM Pinares
                                            <?php  } ?>
                                            <?php if ($formulario_tl['IDLugar'] == 3) { ?>
                                                CESFAM La Leonera
                                            <?php  } ?>
                                            <?php if ($formulario_tl['IDLugar'] == 4) { ?>
                                                CESFAM Valle La Piedra
                                            <?php  } ?>
                                            <?php if ($formulario_tl['IDLugar'] == 5) { ?>
                                                CESFAM Chiguayante
                                            <?php  } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Jornada</td>
                                        <td class="align-middle"><?php echo $formulario_tl['tele_jornada'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Estamento</td>
                                        <td class="align-middle"><?php echo $formulario_tl['tele_estamento'] ?></td>
                                    </tr>

                                    <tr>
                                        <td class="aligh-middle">
                                            Situación
                                        </td>
                                        <td class="aligh-middle">
                                            <?php if ($formulario_tl['IDSit'] == 1) { ?>
                                                Cuidado personal de al menos un niño o niña en etapa preescolar.
                                            <?php  } ?>
                                            <?php if ($formulario_tl['IDSit'] == 2) { ?>
                                                Cuidado personal de al menos un niño o niña menor de 12 años.
                                            <?php  } ?>
                                            <?php if ($formulario_tl['IDSit'] == 3) { ?>
                                                Cuidado personas con alguna discapacidad.
                                            <?php  } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Periodo</td>
                                        <td class="align-middle"><?php echo date('d-m-Y', strtotime($formulario_tl['tele_desde'])); ?> - <?php echo date('d-m-Y', strtotime($formulario_tl['tele_hasta'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">
                                            Sistema elegido
                                        </td>
                                        <td class="align-middle">
                                            <?php echo $formulario_tl['tele_sistema_elegido'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">
                                            Distribución de la jornada laboral
                                        </td>
                                        <td class="align-middle">
                                            <?php echo $formulario_tl['tele_distribucion_jor'] ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>









                            <div class="documentos">
                                <h6>Documentos Adjuntos</h6>

                                <table id="tabla_documentos" class="table table-striped table-bordered table-centered" style="width:100%" data-search="false">
                                    <thead>
                                        <tr>
                                            <th class="" width="90%">Nombre del documento</th>
                                            <th class="">PDF</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (($formulario_tl['IDSit'] == 1) || ($formulario_tl['IDSit'] == 2)) { ?>
                                            <tr>
                                                <td class="align-middle">Certificado de nacimiento del menor.</td>




                                                <td class="align-middle">

                                                    <?php if (!empty($formulario_tl['tele_pdf_cnacimiento'])) { ?>
                                                        <div class="contenedor-botones">
                                                            <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $formulario_tl['tele_pdf_cnacimiento']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $formulario_tl['tele_pdf_cnacimiento'] ?>" download class="btn btn-primary boton-descargar w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z" />
                                                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                                </svg></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="contenedor-botones">
                                                            <button disabled class="btn btn-warning pendiente w-100"><i class="fa-solid fa-clock"></i></button>
                                                        </div>
                                                    <?php } ?>

                                                </td>

                                            </tr>
                                        <?php } ?>

                                        <?php if (($formulario_tl['IDSit'] == 1) || ($formulario_tl['IDSit'] == 2)) { ?>
                                            <tr>
                                                <td class="align-middle">Declaración Jurada que establece que el cuidador ejerce sus funciones sin ayuda.</td>
                                                <td class="align-middle">

                                                    <?php if (!empty($formulario_tl['tele_pdf_djurada'])) { ?>
                                                        <div class="contenedor-botones">
                                                            <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $formulario_tl['tele_pdf_djurada']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $formulario_tl['tele_pdf_djurada'] ?>" download class="btn btn-primary boton-descargar w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z" />
                                                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                                </svg></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="contenedor-botones">
                                                            <button disabled class="btn btn-warning pendiente w-100"><i class="fa-solid fa-clock"></i></button>
                                                        </div>
                                                    <?php } ?>

                                                </td>
                                            </tr>

                                        <?php } ?>


                                        <?php if (($formulario_tl['IDSit'] == 1) || ($formulario_tl['IDSit'] == 2)) { ?>

                                            <tr>
                                                <td class="align-middle">Sentencia Judicial o resolución (según sea el caso).</td>
                                                <td class="align-middle">

                                                    <?php if (!empty($formulario_tl['tele_pdf_sentencia_r'])) { ?>
                                                        <div class="contenedor-botones">
                                                            <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $formulario_tl['tele_pdf_sentencia_r']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $formulario_tl['tele_pdf_sentencia_r'] ?>" download class="btn btn-primary boton-descargar w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z" />
                                                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                                </svg></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="contenedor-botones">
                                                            <button disabled class="btn btn-warning pendiente w-100"><i class="fa-solid fa-clock"></i></button>
                                                        </div>
                                                    <?php } ?>

                                                </td>

                                            </tr>

                                        <?php } ?>

                                        <?php if ($formulario_tl['IDSit'] == 2) { ?>

                                            <tr>
                                                <td class="align-middle">Certificado de Alumno Regular.</td>
                                                <td class="align-middle">

                                                    <?php if (!empty($formulario_tl['tele_pdf_a_regular'])) { ?>
                                                        <div class="contenedor-botones">
                                                            <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $formulario_tl['tele_pdf_a_regular']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $formulario_tl['tele_pdf_a_regular'] ?>" download class="btn btn-primary boton-descargar w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z" />
                                                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                                </svg></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="contenedor-botones">
                                                            <button disabled class="btn btn-warning pendiente w-100"><i class="fa-solid fa-clock"></i></button>
                                                        </div>
                                                    <?php } ?>

                                                </td>
                                            </tr>

                                        <?php } ?>


                                        <?php if ($formulario_tl['IDSit'] == 2) { ?>

                                            <tr>
                                                <td class="align-middle">Certificado del establecimiento de educación al que asiste el niño, niña o adolecente, que acredite el cierre de la institución.</td>
                                                <td class="align-middle">

                                                    <?php if (!empty($formulario_tl['tele_pdf_establecim'])) { ?>
                                                        <div class="contenedor-botones">
                                                            <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $formulario_tl['tele_pdf_establecim']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $formulario_tl['tele_pdf_establecim'] ?>" download class="btn btn-primary boton-descargar w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z" />
                                                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                                </svg></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="contenedor-botones">
                                                            <button disabled class="btn btn-warning pendiente w-100"><i class="fa-solid fa-clock"></i></button>
                                                        </div>
                                                    <?php } ?>

                                                </td>

                                            </tr>
                                        <?php } ?>



                                        <?php if ($formulario_tl['IDSit'] == 3) { ?>

                                            <tr>
                                                <td class="align-middle">Certificado de inscripción en el Registro Nacional de la Discapacidad de la persona bajo su cuidado.</td>
                                                <td class="align-middle">
                                                    <?php if (!empty($formulario_tl['tele_pdf_cinscrip'])) { ?>
                                                        <div class="contenedor-botones">
                                                            <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $formulario_tl['tele_pdf_cinscrip']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $formulario_tl['tele_pdf_cinscrip'] ?>" download class="btn btn-primary boton-descargar w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z" />
                                                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                                </svg></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="contenedor-botones">
                                                            <button disabled class="btn btn-warning pendiente w-100"><i class="fa-solid fa-clock"></i></button>
                                                        </div>
                                                    <?php } ?>
                                                </td>

                                            </tr>

                                        <?php } ?>

                                        <?php if ($formulario_tl['IDSit'] == 3) { ?>

                                            <tr>
                                                <td class="align-middle">Copia del certificado, credencial o inscripción de discapacidad en el referido registro, emitido por la autoridad competente, en los términos de los artículos 13 y 17, ambos de la citada ley, correspondientes a la persona que tengan a su cuidado. O podrá acreditarse la discapacidad de esta última a través de la calidad de asignatario de pensión de invalidez.</td>
                                                <td class="align-middle">
                                                    <?php if (!empty($formulario_tl['tele_pdf_copia_cinscrip'])) { ?>
                                                        <div class="contenedor-botones">
                                                            <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $formulario_tl['tele_pdf_copia_cinscrip']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                            <a href="<?php echo $formulario_tl['tele_pdf_copia_cinscrip'] ?>" download class="btn btn-primary boton-descargar w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z" />
                                                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                                </svg></a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="contenedor-botones">
                                                            <button disabled class="btn btn-warning pendiente w-100"><i class="fa-solid fa-clock"></i></button>
                                                        </div>
                                                    <?php } ?>
                                                </td>

                                            </tr>
                                        <?php } ?>

                                        <tr>
                                            <td class="align-middle"><strong>Compatibilidad de la Función: </strong>Certificado de jefe directo que indica que modalidad es compatible con teletrabajo (debe contener lugar, sistema elegido, así como la modalidad de control y supervisión de las funciones).</td>
                                            <td class="align-middle"> <?php if (!empty($formulario_tl['tele_pdf_compat_funcion'])) { ?>
                                                    <div class="contenedor-botones">
                                                        <button type="button" class="btn btn-primary boton-ver w-100" onclick="window.open('<?php echo $formulario_tl['tele_pdf_compat_funcion']; ?>', '_blank')"><i class="fa-solid fa-expand"></i></button>
                                                        <a href="<?php echo $formulario_tl['tele_pdf_compat_funcion'] ?>" download class="btn btn-primary boton-descargar w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                                                <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z" />
                                                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                            </svg></a>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="contenedor-botones">
                                                        <button disabled class="btn btn-warning pendiente w-100"><i class="fa-solid fa-clock"></i></button>
                                                    </div>
                                                <?php } ?>
                                            </td>


                                        </tr>

                                    </tbody>
                                </table>

                                <br>



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

        <script src=".././assets/js/main.js"></script>
        <script src=".././assets/js/datatables.js"></script>
        <script src=".././assets/js/sidebar.js"></script>
        <script src=".././assets/js/validaciones.js"></script>
        <script src="../.assets/js/oculta_input.js"></script>


        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.js"></script>
    </body>

    </html>

<?php
} else {
    header('Location: ../home.php');
}
?>