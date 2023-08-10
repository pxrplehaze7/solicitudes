<?php
include("./config/conexion.php");

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <title>Pendientes TL</title>

    <link rel="shortcut icon" type="image/png" href="./assets/img/favicon-32x32.png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <link href="./assets/styles/styles.css" rel="stylesheet" />

</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="home.php"><img src="./assets/img/logo.png" width="30px"></a>
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
                <!-- <h1 class="mt-4">Lista de Formularios Pendientes de Teletrabajo</h1> -->

                <div class="row titulo text-center">
                    <div class=" d-flex justify-content-left d-none d-sm-block">
                        <h1>Lista de Formularios Pendientes de Teletrabajo</h1>
                    </div>

                </div>

                <br>
                <div class="">
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="totalUsuarios" class="table table-striped table-bordered table-centered" style="width:100%" data-search="true">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Fecha de solicitud</th>
                                        <th>RUT</th>
                                        <th>Nombre</th>
                                        <th>Periodo</th>
                                        <th>Sistema Elegido</th>
                                        <th>Ir</th>
                                    </tr>
                                </thead>



                                <tbody id="trabajadores_tbody">
                                    <?php
                                    // añadir a la consulta un adn lugar es igual al lugar del que autoriza y que su firma esta null, o sea, hacer consultas dependiendo si es direc, sub direct y que este null el campo correspondiente
                                    $lista_tl = "SELECT *
                                        FROM solicitudes.teletrabajo WHERE tele_estado_solicitud=2 ";
                                    $resultados = mysqli_query($conn_sol, $lista_tl);
                                    while ($pendiente = mysqli_fetch_array($resultados)) {

                                    ?>
                                        <tr>
                                            <td><?php echo $pendiente['tele_num_formulario'] ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($pendiente['tele_fecha_solicitud'])) ?></td>
                                            <td><?php echo $pendiente['tele_rut_funcionario'] ?></td>
                                            <td><?php echo $pendiente['tele_nomb_funcionario'] ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($pendiente['tele_desde'])) . ' - ' . date('d-m-Y', strtotime($pendiente['tele_hasta']))

                                                ?></td>


                                            <td><?php echo $pendiente['tele_sistema_elegido'] ?></td>
                                            <td>

                                                <div class="d-flex align-items-center justify-content-around">
                                                    <a href="./por_autorizar/fpa_teletrabajo.php?idtl=<?php echo $pendiente['IDTL']; ?>" class="btn btn-warning text-white"><i class="fa-solid fa-arrow-right"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/datatables.js"></script>
    <script src="./assets/js/sidebar.js"></script>
    <!-- <script src="./assets/js/validaciones.js"></script> -->
    <!-- <script src="./assets/js/oculta_input.js"></script> -->


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.js"></script>
</body>

</html>