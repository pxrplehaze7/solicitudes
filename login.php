<?php
include("./config/conexion.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="icon" type="image/png" href="./assets/img/favicon-32x32.png">
	<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
	<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
	<link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,400;0,500;0,700;1,100;1,600&display=swap" rel="stylesheet">
	<link href="./assets/styles/login.css" rel="stylesheet">
	<link href="./assets/styles/styles.css" rel="stylesheet">

</head>


<body>

	<div class="container" id="container">
		<div class="form-container registrar-container">
			<form id="registroU" method="POST" autocomplete="off">
				<h1 class="titulo">Registro</h1>
				<div class="input">
					<label for="r_nombre">Nombre Completo</label>
					<input class="input-login" type="text" id="r_nombre" name="r_nombre" autocomplete="off" required />
				</div>
				<div class="input">
					<label for="r_rut">R.U.T</label>
					<input class="input-login" type="text" id="r_rut" name="r_rut" autocomplete="off" maxlength="10" minlength="9" />
					<div id="rut-validationU"></div>

				</div>
				<div class="input">
					<label for="r_correo">Correo Electrónico</label>
					<input class="input-login" type="email" id="r_correo" name="r_correo"  required />
					<div id="correo-validation"></div>

				</div>
				<div class="input">
					<label for="r_contrasenna">Contraseña</label>
					<input class="input-login" type="password" id="r_contrasenna" name="r_contrasenna" required autocomplete="off" />
				</div>
				<div id="error-rut-message" style="color: red;"></div>
				<button id="btn-continuar" type="submit">Continuar</button>
			</form>
		</div>
		<div class="form-container entrar-container">
			<form action="./backend/valida_login.php" method="POST">
				<h1 class="titulo">Iniciar Sesión</h1>
				<div class="contenedor-alerta">
					<?php
					if (isset($_SESSION['login_error']) && $_SESSION['login_error']) {
						echo '<div class="alert alert-danger alerta-login" role="alert" >Correo Electrónico o contraseña incorrectos.<br>Por favor, intenta nuevamente.</div>';
						$_SESSION['login_error'] = false;
					}
					?>
				</div>
				<div class="input">
					<label for="iniciar_correo">Correo Electrónico</label>
					<input class="input-login" type="email" id="iniciar_correo" name="iniciar_correo" />
				</div>
				<div class="input">
					<label for="r_contrasenna">Contraseña</label>
					<input class="input-login" type=iniciarpassword" id="iniciar_contrasenna" name="iniciar_contrasenna" />
				</div>
				<a href="#">¿Olvidaste tu contraseña?</a>
				<button>Entrar</button>
			</form>
		</div> 
		<div class="overlay-container">
			<div class="overlay">
				<div class="capa-panel capa-izquierda">
					<h1>¿Ya estás registrado?</h1>
					<p>Accede a tu cuenta</p>
					<button class="ghost" id="btn_entrar">Iniciar Sesión</button>
				</div>
				<div class="capa-panel capa-derecha">
					<h1>¿No estas registrado?</h1>
					<p>Regístrate para tener acceso a los formularios </p>
					<button class="ghost" id="btn_registro">Registrarse</button>
				</div>
			</div>
		</div>
	</div>

	<script src="./assets/js/main.js"></script>
	<script src="./assets/js/datatables.js"></script>
	<script src="./assets/js/sidebar.js"></script>
	<script src="./assets/js/validaciones.js"></script>
	<script src="./assets/js/login.js"></script>


	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.js"></script>
</body>

</html>