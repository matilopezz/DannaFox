
    const ciudadOption = document.getElementById('ciudadOption');
    const ciudadesContainer = document.getElementById('ciudadesContainer');
    const localidadesSeleccionadas = document.getElementById('localidadesSeleccionadas');
    const seleccionadas = new Set(); // Para evitar duplicados

    ciudadOption.addEventListener('change', () => {
        const selectedOptions = Array.from(ciudadOption.selectedOptions);

        selectedOptions.forEach(option => {
            if (!seleccionadas.has(option.value) && option.value !== "") {
                seleccionadas.add(option.value);

                // Crear un elemento visual en la caja
                const ciudadDiv = document.createElement('div');
                ciudadDiv.className = 'badge bg-primary text-white m-1';
                ciudadDiv.style.height = 'min-content';
                ciudadDiv.textContent = option.text;

                // Botón para eliminar
                const removeBtn = document.createElement('button');
                removeBtn.className = 'btn-close btn-close-white ms-2';
                removeBtn.style.fontSize = '0.8rem';
                removeBtn.addEventListener('click', () => {
                    seleccionadas.delete(option.value);
                    ciudadDiv.remove();
                    updateLocalidadesInput();
                    if (seleccionadas.size === 0) {
                        ciudadesContainer.innerHTML = '<p class="text-muted">No hay ciudades agregadas.</p>';
                    }
                });

                ciudadDiv.appendChild(removeBtn);
                ciudadesContainer.appendChild(ciudadDiv);

                // Actualizar input hidden
                updateLocalidadesInput();
            }
        });

        // Mostrar mensaje vacío si no hay localidades seleccionadas
        if (seleccionadas.size > 0) {
            ciudadesContainer.querySelector('p')?.remove();
        }
    });

    // Actualizar el campo hidden con las localidades seleccionadas
    function updateLocalidadesInput() {
        localidadesSeleccionadas.value = Array.from(seleccionadas).join(',');
    }
