

$(document).ready(function () {
    $('#tabla_documentos').DataTable({
        language: {
            "sEmptyTable": "No se encontraron datos disponibles en la tabla",
            "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sLoadingRecords": "Cargando...",
            "sProcessing": "Procesando...",
            "sSearch": "Buscar: ",
            "sZeroRecords": "No se encontraron registros coincidentes"
        },
        dom: 'frt',
        paging: false, // Deshabilitar paginación
        searching: false,
        order: [],
        columnDefs: [{
            targets: '_all',
            orderable: false
        }]
    });
});



$(document).ready(function () {
    $('#tabla_doc').DataTable({
        language: {
            "sEmptyTable": "No se encontraron datos disponibles en la tabla",
            "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sLoadingRecords": "Cargando...",
            "sProcessing": "Procesando...",
            "sSearch": "Buscar: ",
            "sZeroRecords": "No se encontraron registros coincidentes"
        },
        dom: 'frt',
        paging: false, // Deshabilitar paginación
        searching: false,
        order: [],
        columnDefs: [{
            targets: '_all',
            orderable: false
        }]
    });
});


