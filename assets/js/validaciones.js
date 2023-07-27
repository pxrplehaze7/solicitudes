// SOLO INGRESO DE LETRAS
function validarTexto(input) {
    var regex = /^[A-Za-z\u00C0-\u017F\s]*$/;
    if (!regex.test(input.value)) {
      input.value = input.value.replace(/[^A-Za-z\u00C0-\u017F\s]/g, '');
    }
  }

//   FECHA DE FIN NO PUEDE SER ANTES DEL INICIO
function validarPeriodo(){
    var fechainicio = document.getElementById("desde").value;
    document.getElementById("hasta").min = fechainicio;
}