const signUpButton = document.getElementById("btn_registro");
const signInButton = document.getElementById("btn_entrar");
const container = document.getElementById("container");

signUpButton.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

signInButton.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});





//VALIDA EL RUT DE USUARIO
//PERMITE SOLO EL INGRESO DE NUMEROS, k O k y -
if(document.getElementById("r_rut")){
	document.getElementById("r_rut").addEventListener("input", function () {
	  var inputVALOR = this.value;
	  var valorValido = inputVALOR.replace(/[^0-9kK-]/g, "");
	  this.value = valorValido;
	});
  }
  $(document).ready(function () {
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
	$('#registroU').on('submit', function () {
	  var rutUsuario = $('#r_rut').val();
	  var correoElectronico = $('#r_correo').val(); // Obtener el valor del campo de correo electrónico
	  if (rutUsuario.trim() === '') {
		$('#rut-validationU').html(''); // SI EL CAMPO ESTA VACIO; SE ELIMINA EL MENSAJE DE VALIDACION
	  } else {
		validarRutU(rutUsuario);
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
				console.log('Response:', response);  // Agregar esto para ver exactamente qué estás obteniendo como respuesta

			  if (response.trim() === 'VALIDO') {
				$('#rut-validationU').html('<div class="alert alert-success" role="alert">El RUT es válido y no está registrado</div>');
				setTimeout(function () {
				  $('#rut-validationU').html('');
				}, 2000);
			  } else {
				$('#rut-validationU').html(response);
				setTimeout(function () {
				  $('#rut-validationU').html('');
				}, 2000);
				$('#r_rut').val(''); 
			  }
			}
		  });
		} else {
		  $('#rut-validationU').html('<div class="alert alert-danger" role="alert">El RUT no es válido</div>');
		  setTimeout(function () {
			$('#rut-validationU').html('');
		  }, 2000);
		}
	  } else {
		$('#rut-validationU').html('<div class="alert alert-warning" role="alert">El RUT debe tener 9 o 10 dígitos</div>');
		setTimeout(function () {
		  $('#rut-validationU').html('');
		}, 2000);
	  }
	}
  
  
	function validarCorreo(correoElectronico) {

		// Verifica si el correoElectronico está vacío o solo tiene espacios en blanco
		if (!correoElectronico.trim()) {
			return; // Salir de la función si el correoElectronico está vacío
		}
	
		$.ajax({
			url: './backend/validaciones/check_correo.php',
			type: 'POST',
			data: { correo: correoElectronico },
			success: function(response) {
				if (response.trim() === 'VALIDO') {
					console.log("esvalido");
					$('#correo-validation').html('<div class="alert alert-success" role="alert">El correo es válido y no está registrado</div>');
					setTimeout(function() {
						$('#correo-validation').html('');
					}, 2000);
				} else {
					console.log("sin mensaje");
					$('#correo-validation').html(response);
					setTimeout(function() {
						$('#correo-validation').html('');
					}, 2000);
					$('#r_correo').val(''); 
				}
			}
		});
	}
	
  
  
  });
  var FnU = {
	// VALIDA QUE EL RUT EN FORMATO XXXXXXXX-X EXISTA
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