document.addEventListener("DOMContentLoaded", function () {
    const ciudadOption = document.getElementById("ciudadOption");
    const ciudadesContainer = document.getElementById("ciudadesContainer");
    const ciudadesSeleccionadas = []; // Array para almacenar las ciudades seleccionadas

    function actualizarContenedor() {
        // Limpia el contenedor
        ciudadesContainer.innerHTML = '';

        if (ciudadesSeleccionadas.length === 0) {
            // Muestra el mensaje por defecto si no hay ciudades
            const mensaje = document.createElement('p');
            mensaje.className = 'text-muted';
            mensaje.textContent = 'No hay ciudades agregadas.';
            ciudadesContainer.appendChild(mensaje);
        } else {
            // Muestra las ciudades seleccionadas
            ciudadesSeleccionadas.forEach((ciudad, index) => {
                const ciudadItem = document.createElement('div');
                ciudadItem.className = "badge bg-primary text-white me-1 mb-1 d-inline-flex align-items-center";
                ciudadItem.style.height = "30px";
                
                // Nombre de la ciudad
                const nombre = document.createElement('span');
                nombre.textContent = ciudad.nombre;

                // Botón para eliminar la ciudad
                const eliminarBtn = document.createElement('button');
                eliminarBtn.className = 'btn-close ms-1';
                
                eliminarBtn.addEventListener('click', function () {
                    // Elimina la ciudad del array
                    ciudadesSeleccionadas.splice(index, 1);
                    actualizarContenedor();
                });

                ciudadItem.appendChild(nombre);
                ciudadItem.appendChild(eliminarBtn);
                ciudadesContainer.appendChild(ciudadItem);
            });
        }

        // Actualizar el campo oculto con las localidades seleccionadas
        localidadesInput.value = JSON.stringify(ciudadesSeleccionadas.map(c => c.id));
    }

    // Selección de ciudades
    ciudadOption.addEventListener("change", function () {
        const selectedOption = ciudadOption.options[ciudadOption.selectedIndex];
        const id = selectedOption.value;
        const nombre = selectedOption.textContent;

        // Evita duplicados y selecciones vacías
        if (!id || ciudadesSeleccionadas.some(c => c.id === id)) {
            return
        }

        // Agrega la ciudad al array
        ciudadesSeleccionadas.push({ id, nombre });
        actualizarContenedor();

        // Resetea el select
        ciudadOption.selectedIndex = 0;
    });

    // Inicializa el contenedor con el mensaje por defecto
    actualizarContenedor();
});