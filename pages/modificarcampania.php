<?php
include '..//db/conexion.php'; 
include '..//components/navbar.php';
include '../auth.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox - Actualizar Campaña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/stylesheet.css">
</head>

<body>
    <div class="container text-center mt-5">
        <h2>ACTUALIZAR CAMPAÑA PUBLICITARIA</h2>
        <div class="d-grid gap-3 col-6 mx-auto mt-5">
            <h4>Información de la campaña publicitaria:</h4>

            <!-- Formulario -->
            <form action="procesar_campania.php" method="POST">
                <!-- Cliente -->
                <div class="row mb-3">
                    <div class="col text-start">
                        <label for="cliente">Cliente:</label>
                        <select class="form-control" id="cliente" name="cliente" required>
                            <option value="">Seleccionar cliente</option>
                            <!-- Opciones de clientes -->
                        </select>
                    </div>
                </div>

                <!-- Nombre de la Campaña -->
                <div class="row mb-3">
                    <div class="col text-start">
                        <label for="nombre_campaña">Nombre de la campaña:</label>
                        <input type="text" class="form-control" id="nombre_campaña" name="nombre_campaña" required>
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

                <div class="row mb-3 text-start">
                    <label>Localidades de destino:</label>
                </div>

                <!-- Contenedor principal centrado -->
                <div class="container d-flex justify-content-center">
                    <!-- Localidades a elegir -->
                    <div class="row mb-3">
                        <!-- Columna 1 -->
                        <div class="col-md-6 text-start">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="moreno" name="localidades[]" value="Moreno">
                                <label class="form-check-label" for="moreno">Moreno</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="moron" name="localidades[]" value="Morón">
                                <label class="form-check-label" for="moron">Morón</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="quilmes" name="localidades[]" value="Quilmes">
                                <label class="form-check-label" for="quilmes">Quilmes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lanus" name="localidades[]" value="Lanús">
                                <label class="form-check-label" for="lanus">Lanús</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="moreno2" name="localidades[]" value="Moreno">
                                <label class="form-check-label" for="moreno2">Moreno</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="moron2" name="localidades[]" value="Morón">
                                <label class="form-check-label" for="moron2">Morón</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="quilmes2" name="localidades[]" value="Quilmes">
                                <label class="form-check-label" for="quilmes2">Quilmes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lanus2" name="localidades[]" value="Lanús">
                                <label class="form-check-label" for="lanus2">Lanús</label>
                            </div>
                        </div>
                        <!-- Columna 2 -->
                        <div class="col-md-6 text-start">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="pilar" name="localidades[]" value="Pilar">
                                <label class="form-check-label" for="pilar">Pilar</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="mar_del_plata" name="localidades[]" value="Mar del Plata">
                                <label class="form-check-label text-nowrap" for="mar_del_plata">Mar del Plata</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="la_plata" name="localidades[]" value="La Plata">
                                <label class="form-check-label" for="la_plata">La Plata</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="avellaneda" name="localidades[]" value="Avellaneda">
                                <label class="form-check-label" for="avellaneda">Avellaneda</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="pilar2" name="localidades[]" value="Pilar">
                                <label class="form-check-label" for="pilar2">Pilar</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="mar_del_plata2" name="localidades[]" value="Mar del Plata">
                                <label class="form-check-label text-nowrap" for="mar_del_plata2">Mar del Plata</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="la_plata2" name="localidades[]" value="La Plata">
                                <label class="form-check-label" for="la_plata2">La Plata</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="avellaneda2" name="localidades[]" value="Avellaneda">
                                <label class="form-check-label" for="avellaneda2">Avellaneda</label>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Estado de la Campaña -->
                <div class="row mb-3">
                    <div class="col text-start">
                        <label for="estado_campaña">Estado de la Campaña:</label>
                        <select class="form-control" id="estado_campaña" name="estado_campaña" required>
                            <option value="">Seleccionar</option>
                            <option value="Creada">Creada</option>
                            <option value="En ejecución">En ejecución</option>
                            <option value="Finalizada">Finalizada</option>
                        </select>
                    </div>
                </div>

                <!-- Botones de Enviar y Cancelar -->
                <div class="mt-4 mb-5 d-flex justify-content-between">
                    <button type="submit" class="btn-steel-blue btn" name="actualizar" style="width: 200px;">Actualizar Campaña</button>
                    <button href="tu-pagina-destino.php" class="btn btn-secondary" style="width: 200px; text-align: center;">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
