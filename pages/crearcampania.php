<?php
// crearcampania.php
include '..//components/navbar.php'
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox - Nueva Campaña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container text-center mt-5">
        <h2>CREAR CAMPAÑA PUBLICTARIA</h2>
        <div class="d-grid gap-3 col-6 mx-auto mt-5">
            <h3>Información de la campaña publicitaria:</h3>



            <form action="procesar_campania.php" method="POST">
                <!-- Cliente -->
                <div class="form-group">
                    <label for="cliente">Cliente:</label>
                    <select class="form-control" id="cliente" name="cliente" required>
                        <option value="">Seleccionar cliente</option>
                        <!-- Nombres/datos de los clientes ya registrados -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="nombre_campaña">Nombre de la campaña:</label>
                    <input type="text" class="form-control" id="nombre_campaña" name="nombre_campaña" required>
                    <!-- Falta validación para que no se permita un nombre que ya está creado -->
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fecha_inicio">Fecha de inicio:</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                    </div>
                    <div class="form-group col-md-6">
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
                <div class="form-group">
                    <label for="sms_text">Texto a enviar por SMS:</label>
                    <textarea class="form-control" id="sms_text" name="sms_text" rows="5" maxlength="160"></textarea>
                    <small class="form-text text-muted">Máximo: 160 caracteres</small>
                </div>

                <!-- Localidades a elegir -->
                <div class="form-group">
                    <label>Localidades de destino:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="moreno" name="localidades[]" value="Moreno">
                        <label class="form-check-label" for="moreno">Moreno</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="moron" name="localidades[]" value="Morón">
                        <label class="form-check-label" for="moron">Morón</label>
                    </div>
                    <!-- Hay que agregar más (no se si lo quieren hacer asi) -->
                </div>

                <!-- Estado de la Campaña -->
                <div class="form-group">
                    <label for="estado_campaña">Estado de la Campaña:</label>
                    <select class="form-control" id="estado_campaña" name="estado_campaña" required>
                        <option value="">Seleccionar</option>
                        <option value="Creada">Creada</option>
                        <option value="En ejecución">En ejecución</option>
                        <option value="Finalizada">Finalizada</option>


                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Añadir Campaña Publicitaria</button>
        </div>
        </form>
    </div>