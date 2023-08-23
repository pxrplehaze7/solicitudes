// FUNCION PARA LIMPIAR EL INPUT FILE
function LimpiaInputFile(inputId) {
  var fileInput = document.getElementById(inputId);
  fileInput.value = "";
}

$(document).ready(function () {
  $("#registroU").on("submit", function (event) {
    event.preventDefault();

    Swal.fire({
      title: "¿Está seguro?",
      showDenyButton: true,
      showCancelButton: false,
      allowOutsideClick: false,
      confirmButtonText: "Sí",
      confirmButtonColor: "#00c4a0",
      denyButtonColor: "#ba0051",
    }).then((result) => {
      if (result.isConfirmed) {
        var formData = new FormData(this);
        $.ajax({
          url: "./backend/registro_usuario.php",
          method: "POST",
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
        })
          .done(function (response) {
            response = JSON.parse(response);
            if (response.success) {
              Swal.fire({
                icon: "success",
                title: "Usuario registrado exitosamente",
                showConfirmButton: true,
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#009CFD",
              }).then(() => {
                $("#r_nombre").val("");
                $("#r_rut").val("");
                $("#r_correo").val("");
                $("#r_contrasenna").val("");
                window.location = location.href;
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "Error al registrar Usuario",
                text: response.message,
                showConfirmButton: true,
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#009CFD",
              });
            }
          })
          .fail(function (response) {
            Swal.fire({
              icon: "error",
              title: "Error al registrar Usuario",
              text: response.responseText,
              showConfirmButton: true,
              confirmButtonText: "Aceptar",
              confirmButtonColor: "#009CFD",
            });
          });
      }
    });
  });
});

// INICIO FORMULARIO TELETRABAJO
$("#form_teletrabajo").on("submit", function (event) {
  event.preventDefault();
  Swal.fire({
    title: "¿Está seguro de continuar?",
    showDenyButton: true,
    showCancelButton: false,
    allowOutsideClick: false,
    confirmButtonText: "Si",
    confirmButtonColor: "#00c4a0",
    denyButtonText: "No",
    denyButtonColor: "#ba0051",
  }).then((result) => {
    if (result.isDenied) {
      return;
    } else {
      let formData = new FormData(this);

      formData.append("rut", $("#rut").attr("value"));

      $.ajax({
        url: "../../backend/agregar/add_teletrabajo.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      })
        .done(function (respuesta) {
          $("body").append(respuesta);
          // console.log(respuesta)
        })
        .fail(function (respuesta) {
          $("body").append(respuesta);
          // console.log(respuesta)
        })
        .always(function (respuesta) {
          // console.info(respuesta)
        });
    }
  });
});


// INICIO FORMULARIO CUIDADOR TEA
$("#form_cuidatea").on("submit", function (event) {
  event.preventDefault();
  Swal.fire({
    title: "¿Está seguro de continuar?",
    showDenyButton: true,
    showCancelButton: false,
    allowOutsideClick: false,
    confirmButtonText: "Si",
    confirmButtonColor: "#00c4a0",
    denyButtonText: "No",
    denyButtonColor: "#ba0051",
  }).then((result) => {
    if (result.isDenied) {
      return;
    } else {
      let formData = new FormData(this);

      formData.append("namerut", $("#rutea").attr("value"));
      console.log(formData);
      $.ajax({
        url: "../../backend/agregar/add_tea.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      })
        .done(function (respuesta) {
          $("body").append(respuesta);
          // console.log(respuesta)
        })
        .fail(function (respuesta) {
          $("body").append(respuesta);
          // console.log(respuesta)
        })
        .always(function (respuesta) {
          // console.info(respuesta)
        });
    }
  });
});


$(".btn-firmar").on("click", function(event) {
  event.preventDefault(); // Previene el envío del formulario

  Swal.fire({
      title: '¿Está seguro?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí',
      cancelButtonText: 'Cancelar'
  }).then((result) => {
      if (result.isConfirmed) {
          enviarFirma($(this).closest("form")); // Si confirma, envía el formulario
      }
  });
});

function enviarFirma($form) {
  $.ajax({
      type: $form.attr("method"),
      url: $form.attr("action"),
      data: $form.serialize(),
      dataType: 'json',  // Especifica que esperas una respuesta en formato JSON
      success: function(response) {
          if (response.success) {
              Swal.fire({
                  icon: 'success',
                  title: response.message,
                  confirmButtonText: 'Aceptar',
                  confirmButtonColor: '#009CFD'
              }).then(() => {
                  location.reload(); // Recarga la página
              });
          } else {
              Swal.fire({
                  icon: 'error',
                  title: 'Error al firmar',
                  text: response.message,
                  confirmButtonText: 'Aceptar',
                  confirmButtonColor: '#009CFD'
              });
          }
      },
      error: function(error) {
          Swal.fire({
              icon: 'error',
              title: 'Error al firmar',
              text: 'Ocurrió un error inesperado.',
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#009CFD'
          });
      }
  });
}



// INICIO FORMULARIO CUIDADOR TEA
$("#resolucion_tl").on("submit", function (event) {
  event.preventDefault();
  Swal.fire({
    title: "¿Está seguro?",
    showDenyButton: true,
    showCancelButton: false,
    allowOutsideClick: false,
    confirmButtonText: "Si",
    confirmButtonColor: "#00c4a0",
    denyButtonText: "No",
    denyButtonColor: "#ba0051",
  }).then((result) => {
    if (result.isDenied) {
      return;
    } else {
      let formData = new FormData(this);

      formData.append("idform", $("#idformulario").attr("value"));
      console.log(formData);
      $.ajax({
        url: "../backend/agregar/teletrabajo/resolver_tl.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      }).done(function (response) {
        const parsedResponse = JSON.parse(response);
        if (parsedResponse.success) {
          Swal.fire("Éxito", parsedResponse.message, "success");
        } else {
          Swal.fire("Error", parsedResponse.message, "error");
        }
      })
      .fail(function (response) {
        Swal.fire("Error", "Error al procesar la solicitud.", "error");
      })
      
    }
  });
});
