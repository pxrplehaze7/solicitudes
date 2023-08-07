function mostrarOcultarInputs() {
    var valorSituacion = document.getElementById('situacion').value;
    
    // Obtén referencias a todas las filas de entrada
    var filasInput = document.querySelectorAll("#tabla_documentos tbody tr");

    // Oculta todas las filas de entrada
    filasInput.forEach(function(fila) {
        fila.style.display = 'none';
    });

    // Muestra las filas de entrada según el valor seleccionado de "situacion"
    if (valorSituacion === "1") {
        // Muestra el primer conjunto de entradas
        filasInput[0].style.display = 'table-row';
        filasInput[1].style.display = 'table-row';
        filasInput[2].style.display = 'table-row';
    } else if (valorSituacion === "2") {
        // Muestra el segundo conjunto de entradas
        filasInput[0].style.display = 'table-row';
        filasInput[1].style.display = 'table-row';
        filasInput[2].style.display = 'table-row';
        filasInput[3].style.display = 'table-row';
        filasInput[4].style.display = 'table-row';
    } else if (valorSituacion === "3") {
        // Muestra el tercer conjunto de entradas
        filasInput[5].style.display = 'table-row';
        filasInput[6].style.display = 'table-row';
    }
}

function distribucion() {
    var opcion1 = document.getElementById("opcion1");
        var opcion2 = document.getElementById("opcion2");
        var dhorario = document.getElementById("dhorario");
        var text_s_elegido = document.getElementById("text_s_elegido");

        if (opcion1.checked) {
            dhorario.style.display = "block"; // Mostrar el div si se selecciona opcion1
            text_s_elegido.value = ""; // Vaciar el contenido del textarea si se selecciona opcion1
        } else if (opcion2.checked) {
            dhorario.style.display = "none"; // Ocultar el div si se selecciona opcion2
            text_s_elegido.value = "Total"; // Establecer el valor del textarea a "Total" si se selecciona opcion2
        }
    }