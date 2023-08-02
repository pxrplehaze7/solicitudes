
// FUNCION PARA LIMPIAR EL INPUT FILE
function LimpiaInputFile(inputId) {
    var fileInput = document.getElementById(inputId);
    fileInput.value = "";
  
  }
  
  

$(document).ready(function () {
  $("#registroU").on("submit", function (event) {
    event.preventDefault();

    Swal.fire({
      title: '¿Está seguro?',
      showDenyButton: true,
      showCancelButton: false,
      allowOutsideClick: false,
      confirmButtonText: 'Sí',
      confirmButtonColor: '#00c4a0',
      denyButtonColor: '#ba0051'
    }).then((result) => {
      if (result.isConfirmed) {
        var formData = new FormData(this);
        $.ajax({
          url: "./backend/registro_usuario.php",
          method: "POST",
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        }).done(function (response) {
          response = JSON.parse(response);
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'Usuario registrado exitosamente',
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            }).then(() => {
              $("#r_nombre").val("");
              $("#r_rut").val("");
              $("#r_correo").val("");
              $("#r_contrasenna").val("");

            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error al registrar Usuario',
              text: response.message,
              showConfirmButton: true,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
            });
          }
        }).fail(function (response) {
          Swal.fire({
            icon: 'error',
            title: 'Error al registrar Usuario',
            text: response.responseText,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#009CFD'
          });
        });
      }
    });
  });
});