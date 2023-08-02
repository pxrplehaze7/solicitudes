const signUpButton = document.getElementById('btn_registro');
const signInButton = document.getElementById('btn_entrar');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});



//VALIDA EL R.U.T DE USUARIO
//PERMITE SOLO EL INGRESO DE NUMEROS, k O k y -
if(document.getElementById("r_rut")){
	document.getElementById("r_rut").addEventListener("input", function () {
	  var inputVALOR = this.value;
	  var valorValido = inputVALOR.replace(/[^0-9kK-]/g, "");
	  this.value = valorValido;
	});
  }

	  
		$(document).ready(function () {
		  if (document.getElementById("r_rut")) {
			document.getElementById("r_rut").addEventListener("input", function () {
			  var inputVALOR = this.value;
			  var valorValido = inputVALOR.replace(/[^0-9kK-]/g, "");
			  this.value = valorValido;
			});
		  }
	
		  $('#r_rut').on('blur', function () {
			var rutUsuario = $(this).val();
			if (rutUsuario.trim() !== '') {
			  validarRutU(rutUsuario);
			}
		  });
	
		  $('#r_correo').on('blur', function () {
			var correoElectronico = $(this).val();
			if (correoElectronico.trim() !== '') {
			  validarCorreo(correoElectronico);
			}
		  });
	
		  // VERIFICA SI EL INPUT ESTA VACIO ANTES DE ENVIAR EL FORMULARIO
		  $('#registroU').on('submit', function (event) {
			var rutUsuario = $('#r_rut').val();
			var correoElectronico = $('#r_correo').val(); // Obtener el valor del campo de correo electrónico
	
			if (rutUsuario.trim() === '') {
			  $('#rut-validationU').html(''); // SI EL CAMPO ESTA VACIO; SE ELIMINA EL MENSAJE DE VALIDACION
			} else {
			  if (rutUsuario.length < 9) {
				$('#error-rut-message').html('El R.U.T debe tener al menos 9 dígitos');
				event.preventDefault(); // Evita que el formulario se envíe
				return;
			  } else {
				validarRutU(rutUsuario);
			  }
			}
	
			if (correoElectronico.trim() === '') {
			  $('#correo-validation').html(''); // Eliminar el mensaje de validación del correo si el campo está vacío
			} else {
			  validarCorreo(correoElectronico);
			}
		  });
	
		  function validarRutU(rutUsuario) {
			if (rutUsuario.length === 10 || rutUsuario.length === 9) {
			  if (FnU.validaRutU(rutUsuario)) {
				$.ajax({
				  url: './backend/validaciones/check_rut_Usuario.php',
				  type: 'POST',
				  data: { rut: rutUsuario },
				  success: function (response) {
					if (response === 'VALIDO') {
					  $('#rut-validationU').html('<div class="alert alert-success" role="alert">El R.U.T es válido y no está registrado</div>');
					  setTimeout(function () {
						$('#rut-validationU').html('');
					  }, 2200);
					} else {
					  $('#rut-validationU').html(response);
					  setTimeout(function () {
						$('#rut-validationU').html('');
					  }, 2200);
					  $('#r_rut').val('');
					}
				  }
				});
			  } else {
				$('#rut-validationU').html('<div class="alert alert-danger" role="alert">El R.U.T no es válido</div>');
				setTimeout(function () {
				  $('#rut-validationU').html('');
				}, 2200);
			  }
			} else {
			  $('#rut-validationU').html('<div class="alert alert-warning" role="alert">El R.U.T debe tener 9 o 10 dígitos</div>');
			  setTimeout(function () {
				$('#rut-validationU').html('');
			  }, 2200);
			}
		  }
	
		  function validarCorreo(correoElectronico) {
			$.ajax({
			  url: './backend/validaciones/check_correo.php',
			  type: 'POST',
			  data: { correo: correoElectronico },
			  success: function (response) {
				if (response === 'VALIDO') {
				  $('#correo-validation').html('<div class="alert alert-success" role="alert">El correo es válido y no está registrado</div>');
				  setTimeout(function () {
					$('#correo-validation').html('');
				  }, 2200);
				} else {
				  $('#correo-validation').html(response);
				  setTimeout(function () {
					$('#correo-validation').html('');
				  }, 2200);
				  $('#r_correo').val('');
				}
			  }
			});
		  }
	
		  var FnU = {
			// VALIDA QUE EL R.U.T EN FORMATO XXXXXXXX-X EXISTA
			validaRutU: function (rutCompleto) {
			  rutCompleto = rutCompleto.replace("‐", "-");
			  if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto))
				return false;
			  var tmp = rutCompleto.split('-');
			  var digv = tmp[1];
			  var rut = tmp[0];
			  if (digv == 'K') digv = 'k';
	
			  return (FnU.dv(rut) == digv);
			},
			dv: function (T) {
			  var M = 0,
				S = 1;
			  for (; T; T = Math.floor(T / 10))
				S = (S + T % 10 * (9 - M++ % 6)) % 11;
			  return S ? S - 1 : 'k';
			}
		  };
		});
