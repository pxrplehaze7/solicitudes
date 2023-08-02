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