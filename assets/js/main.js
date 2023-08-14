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
