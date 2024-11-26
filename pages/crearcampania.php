    <?php
    include '..//db/conexion.php';
    include '..//components/navbar.php';
    include '../auth.php';
    include '..//querys/campania/createCampania.php';
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DannaFox - Nueva Campaña</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../styles/stylesheet.css?v=1.0">
    </head>

    <body>
        <div class="container text-center mt-5">
            <h2>CREAR CAMPAÑA PUBLICITARIA</h2>
            <hr class="my-4 " style="width: 50%; margin: auto;">

            <div class="d-grid gap-3 col-6 mx-auto mt-5">
            <h4 class="" style="color: #4A90E2;">Información de la campaña publicitaria:</h4>

                <!-- Formulario -->
                <form method="POST">
                    <!-- Cliente -->
                    <div class="row mb-3">
                        <div class="col text-start">
                            <label for="cliente">Cliente:</label>
                            <select class="form-control" id="cliente" name="cliente" required>
                                <option value="">Seleccionar cliente</option>
                                <?php
                                include '..//querys/campania/getClienteOption.php';
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
                            <?php if (isset($error_campania)) { ?>
                            <span id="campaniaError" style="color: red;"><?php echo $error_campania; ?></span>
                        <?php } ?>
                        </div>
                    </div>

                    <!-- Fecha de Inicio y Cantidad de Mensajes -->
                    <div class="row mb-3">
                        <div class="col text-start">
                            <label for="fecha_inicio">Fecha de inicio:</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <!-- <div class="col text-start">
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
                        </div> -->
                    </div>

                    <!-- Texto a enviar por SMS -->
                    <div class="row mb-3">
                        <div class="col">
                            <label for="texto_SMS">Texto a enviar por SMS:</label>
                            <textarea class="form-control" id="texto_SMS" name="texto_SMS" rows="4" maxlength="160" oninput="updateCharacterCount()"></textarea>
                            <div class="d-flex justify-content-between">
                                <small class="form-text text-muted">Máximo: 160 caracteres</small>
                                <small class="form-text text-muted">Te quedan <span id="charCount">160</span> caracteres</small>
                            </div>
                        </div>
                    </div>


                        <div class="contenedor-selector-localidades fondo-gris rounded-1 mb-3">
                            <div class="row mb-3">
                                <label>Localidades de destino:</label>
                            </div>

                            <div class="row mb-3">
                                <div class="col text-start position-relative">
                                    
                                    <!-- Barra de búsqueda -->
                                    <input type="text" id="ciudadInput" class="form-control" placeholder="Buscar localidad...">
                                    <!-- Lista desordenada -->
                                    <ul id="ciudadList" class="list-group position-absolute w-100" style="max-height: 200px; overflow-y: auto; z-index: 1000;">
                                        <li class="list-group-item disabled">Selecciona una o más localidades</li>
                                        <?php
                                        include '..//querys/campania/getLocalidades.php';
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<li class="list-group-item localidad-item" data-id="' . $row['localidad_id'] . '">' . $row['localidad'] . '</li>';
                                            }
                                        } else {
                                            echo '<li class="list-group-item disabled">No hay localidades disponibles</li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <div id="localidadesSeleccionadas"></div>
                            <div id="ciudadesContainer" class="border rounded p-2 fondo-blanco" style="min-height: 100px;">
                                
                            </div>
                        </div>

                    <!-- Estado de la Campaña -->
                    <!-- <div class="row mb-3">
                        <div class="col text-start">
                            <label for="estado">Estado de la Campaña:</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="">Seleccionar</option>
                                <option value="Creada">Creada</option>
                                <option value="Ejecutandose">Ejecutandose</option>
                                <option value="Finalizada">Finalizada</option>
                            </select>
                        </div>
                    </div> -->
                    <!-- Estado de la Campaña (Oculto) -->
                    <input type="hidden" id="estado" name="estado" value="Creada">

                    <!-- Campo oculto para la cantidad de mensajes -->
                    <input type="hidden" id="cantidad" name="cantidad" value="0">
                    <div class="row mb-3">
                        <div class="col">
                            <p id="cantidadMensajes" class="form-text text-muted">Cantidad de mensajes que se enviarán (7000 por localidad): 0</p>
                        </div>
                    </div>

                    <!-- Botones de Enviar y Cancelar -->
                    <div class="mt-4 mb-5 d-flex justify-content-center">
                        <button type="submit" class="btn-steel-blue btn" name="crear_campania" style="width: 200px;">Crear Campaña</button>
                    </div>

                </form>
            </div>
        </div>

    <script src="../js/localidades.js"></script>
    <script src="../js/contadorCaracteres.js"></script>

    <script>
        const formulario = document.querySelector('form'); // Obtén el formulario
        formulario.addEventListener('submit', function(e) {
            // Actualizar el campo oculto antes de enviar el formulario
            updateLocalidadesInput();
        });
    </script>

    </body>

    </html>