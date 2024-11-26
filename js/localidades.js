const ciudadInput = document.getElementById('ciudadInput');
const ciudadList = document.getElementById('ciudadList');
const ciudadesContainer = document.getElementById('ciudadesContainer');
const seleccionadas = new Set(); // Para evitar duplicados
const LIMITE_LOCALIDADES = 10;

// Actualizar la cantidad de mensajes al cambiar las ciudades seleccionadas
function updateCantidad() {
    const cantidadMensajes = seleccionadas.size * 7000;
    document.getElementById('cantidad').value = cantidadMensajes;
    
    // Opcional: muestra la cantidad de mensajes en la interfaz
    const cantidadMensajesElemento = document.getElementById('cantidadMensajes');
    if (cantidadMensajesElemento) {
        cantidadMensajesElemento.textContent = `Cantidad de mensajes: ${cantidadMensajes}`;
    }
}

// Actualizar las localidades seleccionadas
function updateLocalidadesInput() {
    // Eliminar las localidades previas
    const container = document.getElementById('localidadesSeleccionadas');
    container.innerHTML = ''; // Limpiar los campos ocultos previos

    // Crear un campo oculto por cada localidad seleccionada
    seleccionadas.forEach((localidadId) => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'campania_localidades[]'; // Array en el nombre del campo
        input.value = localidadId; // Asignar el valor del ID de localidad
        container.appendChild(input);
    });
}

// Función para manejar la búsqueda de localidades
ciudadInput.addEventListener('input', function() {
    const filter = ciudadInput.value.toLowerCase();
    const items = ciudadList.getElementsByTagName('li');

    for (let i = 0; i < items.length; i++) {
        const item = items[i];
        const text = item.textContent || item.innerText;
        if (text.toLowerCase().indexOf(filter) > -1) {
            item.style.display = "";
        } else {
            item.style.display = "none";
        }
    }
});

// Manejar la selección de localidades
ciudadList.addEventListener('click', function(e) {
    if (e.target && e.target.matches('.localidad-item')) {
        const localidadId = e.target.getAttribute('data-id');
        const localidadText = e.target.textContent;

        // Verificar si ya hemos alcanzado el límite de 10 localidades
        if (seleccionadas.size >= LIMITE_LOCALIDADES) {
            alert('Ya has alcanzado el límite de 10 localidades.');
            return;
        }

        if (!seleccionadas.has(localidadId)) {
            seleccionadas.add(localidadId);

            // Crear un elemento visual en la caja
            const ciudadDiv = document.createElement('div');
            ciudadDiv.className = 'badge bg-primary text-white m-1';
            ciudadDiv.style.height = 'min-content';
            ciudadDiv.textContent = localidadText;

            // Botón para eliminar
            const removeBtn = document.createElement('button');
            removeBtn.className = 'btn-close btn-close-white ms-2';
            removeBtn.style.fontSize = '0.8rem';
            removeBtn.addEventListener('click', () => {
                seleccionadas.delete(localidadId);
                ciudadDiv.remove();
                updateLocalidadesInput();
                updateCantidad(); // Actualizar la cantidad al eliminar
                if (seleccionadas.size === 0) {
                    ciudadesContainer.innerHTML = '<p class="text-muted">No hay ciudades agregadas.</p>';
                }
            });

            ciudadDiv.appendChild(removeBtn);
            ciudadesContainer.appendChild(ciudadDiv);

            // Actualizar los campos ocultos de localidades y la cantidad
            updateLocalidadesInput();
            updateCantidad();
        }
    }
});

// Añadir un evento de envío para asegurarse de que el campo oculto de localidades se actualiza al enviar el formulario
const formulario = document.querySelector('form');
formulario.addEventListener('submit', function(e) {
    // Actualizar las localidades antes de enviar
    updateLocalidadesInput();
});
