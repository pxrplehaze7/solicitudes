const COLOR_PINCEL = "black";
const GROSOR = 3;
let haComenzadoDibujo = false;
let xAnterior, yAnterior, xActual, yActual;
const $btnDescargar = document.getElementById("btnDescargar");


const $canvas = document.getElementById("canvas");
const contexto = $canvas.getContext("2d");
contexto.lineJoin = "miter"; // Cambiar "round" por "miter"
contexto.lineCap = "round"; // Agregar esta línea para redondear los extremos del trazo

function obtenerCoordenadas(evento) {
    const rect = $canvas.getBoundingClientRect();
    const escalaX = $canvas.width / rect.width;
    const escalaY = $canvas.height / rect.height;

    return {
        x: (evento.clientX - rect.left) * escalaX,
        y: (evento.clientY - rect.top) * escalaY
    };
}

$canvas.addEventListener("mousedown", (evento) => {
    const coordenadas = obtenerCoordenadas(evento);
    xAnterior = coordenadas.x;
    yAnterior = coordenadas.y;
    contexto.beginPath();
    contexto.fillStyle = COLOR_PINCEL;
    contexto.fillRect(xAnterior, yAnterior, GROSOR, GROSOR);
    contexto.closePath();
    haComenzadoDibujo = true;
});

$canvas.addEventListener("mousemove", (evento) => {
    if (!haComenzadoDibujo) {
        return;
    }

    const coordenadas = obtenerCoordenadas(evento);
    xActual = coordenadas.x;
    yActual = coordenadas.y;

    contexto.beginPath();
    contexto.moveTo(xAnterior, yAnterior);
    contexto.lineTo(xActual, yActual);
    contexto.strokeStyle = COLOR_PINCEL;
    contexto.lineWidth = GROSOR;
    contexto.stroke();
    contexto.closePath();

    xAnterior = xActual;
    yAnterior = yActual;
});

["mouseup", "mouseout"].forEach((nombreDeEvento) => {
    $canvas.addEventListener(nombreDeEvento, () => {
        haComenzadoDibujo = false;
    });
});
$btnDescargar.onclick = () => {
    const imageData = $canvas.toDataURL("image/png");

    fetch('guardar_imagen.php', {
        method: 'POST',
        body: JSON.stringify({
            image: imageData,
            rut: "12345678-9"  // Aquí deberías poner el RUT de la persona
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
};
