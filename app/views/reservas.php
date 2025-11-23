<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Reservas</title>
    <style>
        body { font-family: sans-serif; max-width: 900px; margin: 20px auto; padding: 0 15px; }
        .disponibilidad, .historial { border: 1px solid #ccc; padding: 20px; margin-top: 20px; border-radius: 8px; }
        .horarios button { background: #28a745; color: white; border: none; padding: 10px 15px; margin: 5px; border-radius: 5px; cursor: pointer; }
        .horarios button:hover { background: #218838; }
        .reserva-form input, .reserva-form select { margin-bottom: 10px; padding: 8px; width: 100%; box-sizing: border-box; }
        .reserva-confirmada { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Ejercicio 5: Sistema de Reservas</h1>
    <a href="index.php">⬅ Volver al Menú Principal</a>
    <hr>
    
    <?php if (isset($reservaExitosa)): ?>
        <div class="reserva-confirmada"><?php echo $reservaExitosa; ?></div>
    <?php endif; ?>

    <h2>🔍 Consultar Disponibilidad</h2>
    <form action="index.php" method="GET">
        <input type="hidden" name="c" value="reservas">
        <input type="hidden" name="a" value="index">
        <label for="fecha">Selecciona una Fecha:</label>
        <input type="date" name="fecha" id="fecha" value="<?php echo $fechaSeleccionada; ?>" onchange="this.form.submit()">
    </form>

    <div class="disponibilidad">
        <h3>Horarios Disponibles para <?php echo $fechaSeleccionada; ?>:</h3>
        
        <?php if (!empty($horariosDisponibles)): ?>
            <p>Haz clic en una hora para reservar:</p>
            <div class="horarios">
                <?php foreach ($horariosDisponibles as $hora): ?>
                    <button onclick="document.getElementById('reserva-hora').value='<?php echo $hora; ?>'; document.getElementById('reserva-fecha').value='<?php echo $fechaSeleccionada; ?>'; document.getElementById('form-reserva-oculto').style.display='block';">
                        <?php echo $hora; ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No hay horarios disponibles para el **<?php echo $fechaSeleccionada; ?>**.</p>
        <?php endif; ?>
    </div>

    <div id="form-reserva-oculto" class="disponibilidad reserva-form" style="display:none; margin-top: 30px;">
        <h3>Datos de la Reserva</h3>
        <form action="index.php?c=reservas&a=index" method="POST">
            <input type="hidden" name="fecha_reserva" id="reserva-fecha">
            <input type="hidden" name="hora_reserva" id="reserva-hora">
            
            <label>Nombre:</label>
            <input type="text" name="nombre" required>

            <label>Servicio:</label>
            <select name="servicio">
                <option value="Cita Médica">Cita Médica</option>
                <option value="Contabilidad">Corte de Pelo</option>
                <option value="Secretaria">Reunión Cliente</option>
                <option value="Otro">Otro</option>
            </select>
            
            <p>Reservando: <strong id="reserva-texto"></strong> (Actualiza al hacer clic)</p>
            <button type="submit">Confirmar Reserva</button>
        </form>
    </div>

    <div class="historial">
        <h3>Historial Completo de Reservas:</h3>
        <?php if (empty($reservasExistentes)): ?>
            <p>No hay reservas en el sistema.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr><th>Fecha</th><th>Hora</th><th>Servicio</th><th>Nombre</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($reservasExistentes as $reserva): ?>
                        <tr>
                            <td><?php echo $reserva['fecha']; ?></td>
                            <td><?php echo $reserva['hora']; ?></td>
                            <td><?php echo $reserva['servicio']; ?></td>
                            <td><?php echo $reserva['nombre']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>