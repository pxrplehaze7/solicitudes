<?php 
include("./config/conexion.php");
session_start();

if(isset($_SESSION['correo'])){
$email=$_SESSION['correo'];
$nombre=$_SESSION['nombre'];
$rutcito=$_SESSION['rut'];
$rol=$_SESSION['rol'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link rel="icon" type="image/png" href="./assets/img/favicon-32x32.png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <link href="./assets/styles/tea.css" rel="stylesheet">
    <link href="./assets/styles/styles.css" rel="stylesheet">
    <style>
        #canvas {
            border: 1px solid #ccc;

            width: 400px;
            height: 200px;
            margin: 0;
            padding: 0;


        }
    </style>
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

                        <div class="sb-sidenav-menu-heading">Solicitudes</div>

                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseTrabajador" aria-expanded="false" aria-controls="collapseTrabajador">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Formularios
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseTrabajador" aria-labelledby="headingTrabajador" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionTrabajador">
                                <a class="nav-link" href="./formularios/trabajador/teletrabajo.php">
                                    Teletrabajo
                                </a>

                                <a class="nav-link" href="registro_honorario.php">
                                    Permiso especial<BR>Ley TEA
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


                <h3>Mi Perfil</h3>




                <div class="container-solicitud">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="minombre"><span style="color: #c40055;">*</span> Nombre</label>
                                <input type="text" class="form-control" id="minombre" name="minombre" value="<?php echo $nombre ?>" required>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label for="mirut"><span style="color: #c40055;">*</span> R.U.T</label>
                                <input type="text" class="form-control" name="mirut" id="mirut" value="<?php echo $rutcito ?>" required>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <label for="micorreo"><span style="color: #c40055;">*</span> Correo Electrónico</label>
                                <input type="text" class="form-control" id="micorreo" name="micorreo" value="<?php echo $email ?>" required>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label for="mipass"><span style="color: #c40055;">*</span> Contraseña</label>
                                <input type="text" class="form-control" name="mipass" id="mipass" required>
                            </div>
                        </div>

                        <h3>Subir Firma</h3>
                        <p>Firmar a continuación:</p>
                        <canvas id="canvas"></canvas>
                        <br>
                        <button id="btnLimpiar">Limpiar</button>
                        <button id="btnDescargar">Descargar</button>
                        <button id="btnGenerarDocumento">Pasar a documento</button>
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

    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/datatables.js"></script>
    <script src="./assets/js/sidebar.js"></script>
    <script src="./assets/js/validaciones.js"></script>
    <script src="./assets/js/signature.js"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.js"></script>
</body>

</html>

<?php } else {
     header('Location: login.php');
     exit();
    }?>