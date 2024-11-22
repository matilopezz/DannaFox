<?php
include '..//db/conexion.php';
include '..//components/navbar.php';
include '../auth.php';
include '..//querys/campania/getClienteOption.php';
//Consulta para obtener el cliente en el OPTION


// if (isset($_POST['crear_campania'])) {

//     $cliente_id = $_POST['cliente']; 
//     $nombre_campania = $_POST['nombre_campania'];
//     $fecha_inicio = $_POST['fecha_inicio']; 
//     $cantidad_mensajes = $_POST['cantidad'];
//     $texto_SMS = $_POST['sms_text'];

//     $estado = $_POST['estado_campania']; 

//     // Validar que no haya campos vacíos
//     if (!empty($cliente_id) && !empty($nombre_campana) && !empty($texto_sms)) {
//         // Preparar la consulta SQL para insertar la campaña
//         $insertQuery = "INSERT INTO campanias (cliente_id, texto_SMS, nombre_campana, fecha_inicio, estado) 
//                         VALUES (?, ?, ?, ?, ?)";
//         $stmt = $conn->prepare($insertQuery);

//         if ($stmt) {
//             $stmt->bind_param('issss', $cliente_id, $texto_sms, $nombre_campana, $fecha_inicio, $estado);

//             if ($stmt->execute()) {
//                 // Redirigir a una página de éxito
//                 header('Location: campanias.php?success=true');
//                 exit;
//             } else {
//                 echo "Error al crear la campaña: " . $stmt->error;
//             }
//         } else {
//             echo "Error al preparar la consulta: " . $conn->error;
//         }
//     } else {
//         echo "Por favor, completa todos los campos.";
//     }
// }

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox - Nueva Campaña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/stylesheet.css">
</head>

<body>
    <div class="container text-center mt-5">
        <h2>CREAR CAMPAÑA PUBLICITARIA</h2>
        <div class="d-grid gap-3 col-6 mx-auto mt-5">
            <h4>Información de la campaña publicitaria:</h4>

            <!-- Formulario -->
            <form method="POST">
                <!-- Cliente -->
                <div class="row mb-3">
                    <div class="col text-start">
                        <label for="cliente">Cliente:</label>
                        <select class="form-control" id="cliente" name="cliente" required>
                            <option value="">Seleccionar cliente</option>
                            <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['cliente_id'] . '">' . $row['cliente_nombre'] . ' - '. $row['cuil_cuit'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No hay clientes disponibles</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Nombre de la Campaña -->
                <div class="row mb-3">
                    <div class="col text-start">
                        <label for="nombre_campaña">Nombre de la campaña:</label>
                        <input type="text" class="form-control" id="nombre_campania" name="nombre_campania" required>
                    </div>
                </div>

                <!-- Fecha de Inicio y Cantidad de Mensajes -->
                <div class="row mb-3">
                    <div class="col text-start">
                        <label for="fecha_inicio">Fecha de inicio:</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                    </div>
                    <div class="col text-start">
                        <label for="cantidad">Cantidad de mensajes a enviar:</label>
                        <select class="form-control" id="cantidad" name="cantidad" required>
                            <option value="">Seleccionar</option>
                            <option value="7000">7000</option>
                            <option value="14000">14000</option>
                            <option value="21000">21000</option>
                            <option value="28000">28000</option>
                            <option value="35000">35000</option>
                            <option value="42000">42000</option>
                            <option value="49000">49000</option>
                            <option value="56000">56000</option>
                            <option value="63000">63000</option>
                            <option value="70000">70000</option>
                        </select>
                    </div>
                </div>

                <!-- Texto a enviar por SMS -->
                <div class="row mb-3">
                    <div class="col">
                        <label for="sms_text">Texto a enviar por SMS:</label>
                        <textarea class="form-control" id="sms_text" name="sms_text" rows="4" maxlength="160" oninput="updateCharacterCount()"></textarea>
                        <div class="d-flex justify-content-between">
                            <small class="form-text text-muted">Máximo: 160 caracteres</small>
                            <small class="form-text text-muted">Te quedan <span id="charCount">160</span> caracteres</small>
                        </div>
                    </div>
                </div>

                <script>
                function updateCharacterCount() {
                    const maxLength = 160;
                    const smsText = document.getElementById("sms_text");
                    const charCount = document.getElementById("charCount");
                    const remaining = maxLength - smsText.value.length;
                    charCount.textContent = remaining;
                }
                </script>

                <div class="contenedor-selector-localidades fondo-gris rounded-1 mb-3">
                    <div class="row mb-3">
                        <label>Localidades de destino:</label>
                    </div>

                    <div class="row mb-3">
                        <div class="col text-start">
                            <label for="provinciaInput" class="form-label">Provincia</label>
                            <select id="provinciaInput" class="form-select" name="provincia" required>
                                <option value="" disabled selected>Seleccionar provincia...</option>
                                <option value="Buenos Aires">Buenos Aires</option>
                                <option value="Córdoba">Córdoba</option>
                                <option value="Mendoza">Mendoza</option>
                                <option value="Salta">Salta</option>
                                <option value="Tucumán">Tucumán</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col text-start position-relative">
                            <label for="ciudadInput" class="form-label">Ciudad</label>
                            <input 
                                type="text" 
                                id="ciudadInput" 
                                class="form-control" 
                                placeholder="Seleccionar ciudad..." 
                                name="ciudades[]" multiple disabled>
                            <ul id="ciudadesLista" class="list-group position-absolute w-100" style="max-height: 200px; overflow-y: auto; display: none; z-index: 1000;"></ul>
                        </div>
                    </div>

                    <div id="ciudadesContainer" class="border rounded p-2 fondo-blanco" style="min-height: 100px;">
                        <p class="text-muted">No hay ciudades agregadas.</p>
                    </div>

                </div>

                <script>
                const ciudadesPorProvincia = {
                    "Buenos Aires": ["La Plata", "Mar del Plata", "Bahía Blanca", "Tandil", "Olavarría", "Pergamino"],
                    "Córdoba": ["Córdoba Capital", "Villa Carlos Paz", "Río Cuarto", "San Francisco", "Alta Gracia", "Villa María"],
                    "Mendoza": ["Mendoza Capital", "San Rafael", "Godoy Cruz", "Luján de Cuyo", "Tunuyán", "Las Heras"],
                    "Salta": ["Salta Capital", "San Lorenzo", "Cafayate", "Tartagal", "Metán", "Orán"],
                    "Tucumán": ["San Miguel de Tucumán", "Tafí Viejo", "Yerba Buena", "Concepción", "Lules", "Famaillá"]
                };

                const provinciaInput = document.getElementById("provinciaInput");
                const ciudadInput = document.getElementById("ciudadInput");
                const ciudadesLista = document.getElementById("ciudadesLista");
                const ciudadesContainer = document.getElementById("ciudadesContainer");
                let ciudadesSeleccionadas = [];

                // Actualizar las ciudades disponibles cuando se seleccione una provincia
                provinciaInput.addEventListener("change", () => {
                    const provinciaSeleccionada = provinciaInput.value;

                    // Habilitar el input de ciudades y resetearlo
                    ciudadInput.disabled = false;
                    ciudadInput.value = "";
                    ciudadesLista.innerHTML = "";
                    ciudadesLista.style.display = "none";
                });

                // Mostrar y filtrar la lista al escribir
                ciudadInput.addEventListener("input", () => {
                    const filtro = ciudadInput.value.toLowerCase();
                    const provinciaSeleccionada = provinciaInput.value;
                    
                    if (ciudadesPorProvincia[provinciaSeleccionada]) {
                        const ciudadesFiltradas = ciudadesPorProvincia[provinciaSeleccionada].filter(ciudad =>
                            ciudad.toLowerCase().includes(filtro)
                        );

                        // Mostrar y actualizar las opciones
                        ciudadesLista.innerHTML = "";
                        ciudadesFiltradas.forEach(ciudad => {
                            const item = document.createElement("li");
                            item.className = "list-group-item list-group-item-action";
                            item.textContent = ciudad;
                            item.addEventListener("click", () => {
                                agregarCiudad(ciudad);
                            });
                            ciudadesLista.appendChild(item);
                        });

                        ciudadesLista.style.display = ciudadesFiltradas.length > 0 ? "block" : "none";
                    }
                });

                // Agregar ciudad seleccionada
                function agregarCiudad(ciudad) {
                    if (!ciudadesSeleccionadas.includes(ciudad)) {
                        ciudadesSeleccionadas.push(ciudad);
                        actualizarCiudades();
                    }
                    ciudadInput.value = "";
                    ciudadesLista.style.display = "none";
                }

                // Actualizar la lista de ciudades seleccionadas
                function actualizarCiudades() {
                    ciudadesContainer.innerHTML = "";

                    ciudadesSeleccionadas.forEach((ciudad, index) => {
                        const ciudadBadge = document.createElement("span");
                        ciudadBadge.className = "badge bg-primary text-white me-2 mb-2 d-inline-flex align-items-center";
                        ciudadBadge.innerHTML = `
                            ${ciudad}
                            <button type="button" class="btn-close ms-2" aria-label="Eliminar"></button>
                        `;

                        // Eliminar ciudad al hacer clic en el botón
                        ciudadBadge.querySelector(".btn-close").addEventListener("click", () => {
                            ciudadesSeleccionadas.splice(index, 1);
                            actualizarCiudades();
                        });

                        ciudadesContainer.appendChild(ciudadBadge);
                    });

                    // Mostrar mensaje si no hay ciudades seleccionadas
                    if (ciudadesSeleccionadas.length === 0) {
                        ciudadesContainer.innerHTML = '<p class="text-muted">No hay ciudades agregadas.</p>';
                    }
                }

                // Ocultar la lista si se hace clic fuera
                document.addEventListener("click", (e) => {
                    if (!ciudadInput.contains(e.target) && !ciudadesLista.contains(e.target)) {
                        ciudadesLista.style.display = "none";
                    }
                });
                </script>

                <!-- Estado de la Campaña -->
                <div class="row mb-3">
                    <div class="col text-start">
                        <label for="estado_campaña">Estado de la Campaña:</label>
                        <select class="form-control" id="estado_campania" name="estado_campania" required>
                            <option value="">Seleccionar</option>
                            <option value="Creada">Creada</option>
                            <option value="En ejecución">En ejecución</option>
                            <option value="Finalizada">Finalizada</option>
                        </select>
                    </div>
                </div>

                <!-- Botones de Enviar y Cancelar -->
                <div class="mt-4 mb-5 d-flex justify-content-center">
                    <button type="submit" class="btn-steel-blue btn" name="crear_campania" style="width: 200px;">Crear Campaña</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>