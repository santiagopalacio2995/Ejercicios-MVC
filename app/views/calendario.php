<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario de Eventos</title>
    <style>
        body { font-family: sans-serif; max-width: 900px; margin: 20px auto; padding: 0 15px; }
        .nav-mes { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .nav-mes h2 { margin: 0; }
        .calendario { width: 100%; border-collapse: collapse; }
        .calendario th, .calendario td { border: 1px solid #ddd; padding: 10px; height: 100px; vertical-align: top; text-align: left; position: relative; }
        .calendario th { background-color: #f2f2f2; }
        .dia-numero { font-size: 1.5em; font-weight: bold; color: #333; display: block; margin-bottom: 5px; }
        .evento { background-color: #d4edda; color: #155724; padding: 2px 5px; font-size: 0.8em; margin-top: 3px; border-radius: 3px; cursor: pointer; display: flex; justify-content: space-between; align-items: center;} /* display: flex para el botón X */
        .evento:hover { background-color: #c3e6cb; }
        .dia-vacio { background-color: #f7f7f7; }
        .formulario { border: 1px solid #ccc; padding: 20px; border-radius: 8px; margin-top: 30px; }
        .btn-delete { color: red; font-weight: bold; margin-left: 5px; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Ejercicio 7: Calendario de Eventos</h1>
    <a href="index.php">⬅ Volver al Menú Principal</a>
    <hr>
    
    <?php
        
        $mesesEspañol = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
            7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
        $nombreMes = $mesesEspañol[intval($mes)];
        $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    ?>

    <div class="nav-mes">
        <a href="index.php?c=calendario&a=index&mes=<?php echo $mesAnterior; ?>&anio=<?php echo $anioAnterior; ?>">
            &lt; Anterior
        </a>
        <h2><?php echo $nombreMes . ' ' . $anio; ?></h2>
        <a href="index.php?c=calendario&a=index&mes=<?php echo $mesSiguiente; ?>&anio=<?php echo $anioSiguiente; ?>">
            Siguiente &gt;
        </a>
    </div>

    <table class="calendario">
        <thead>
            <tr>
                <?php foreach ($diasSemana as $dia): ?>
                    <th><?php echo $dia; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $diaActual = 1;
                
                for ($i = 1; $i < $diaInicio; $i++) {
                    echo '<td class="dia-vacio"></td>';
                }

                
                while ($diaActual <= $diasDelMes) {
                    $diaDeLaSemana = date('N', strtotime("$anio-$mes-$diaActual"));
                    
                    
                    if ($diaDeLaSemana == 1 && $diaActual != 1) {
                        echo '</tr><tr>';
                    }

                    // Formato de fecha para búsqueda (YYYY-MM-DD)
                    $fechaCompleta = sprintf('%s-%s-%s', $anio, $mes, str_pad($diaActual, 2, '0', STR_PAD_LEFT));
                    $eventosDelDia = $eventos[$fechaCompleta] ?? [];
                    
                    echo '<td>';
                    echo '<span class="dia-numero">' . $diaActual . '</span>';
                    
                    
                    foreach ($eventosDelDia as $index => $evento) {
                        echo '<div class="evento" title="' . $evento['hora'] . '">';
                        echo '<span>' . $evento['titulo'] . '</span>';
                        
                        echo '<a href="index.php?c=calendario&a=eliminar&fecha=' . $fechaCompleta . '&index=' . $index . '" ';
                        echo 'class="btn-delete" onclick="return confirm(\'¿Eliminar el evento: ' . $evento['titulo'] . '?\');">X</a>';
                        echo '</div>';
                    }
                    
                    echo '</td>';
                    $diaActual++;
                }

                
                $celdasRestantes = 7 - $diaDeLaSemana;
                for ($i = 0; $i < $celdasRestantes; $i++) {
                    echo '<td class="dia-vacio"></td>';
                }
                ?>
            </tr>
        </tbody>
    </table>

    <div class="formulario">
        <h3>➕ Agregar Nuevo Evento</h3>
        <form action="index.php?c=calendario&a=agregar" method="POST">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" required>
            
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha_evento" required value="<?php echo date('Y-m-d'); ?>">

            <label for="hora">Hora (Opcional):</label>
            <input type="time" name="hora_evento">

            <button type="submit">Guardar Evento</button>
        </form>
    </div>
</body>
</html>
