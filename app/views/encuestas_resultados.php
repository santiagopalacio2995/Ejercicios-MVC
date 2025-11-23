<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados: <?php echo $encuesta['titulo']; ?></title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 20px auto; padding: 0 15px; }
        .resumen { text-align: center; background: #e9ecef; padding: 15px; border-radius: 8px; margin-bottom: 25px; }
        .resultado-pregunta { margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 20px; }
        .resultado-pregunta h3 { color: #007bff; }
        .barra-opcion { display: flex; align-items: center; margin-bottom: 10px; }
        .opcion-texto { width: 30%; text-align: right; padding-right: 10px; font-weight: bold; }
        .barra-contenedor { width: 55%; background: #f0f0f0; height: 30px; border-radius: 5px; overflow: hidden; }
        .barra-progreso { background: #28a745; height: 100%; text-align: right; line-height: 30px; color: white; padding-right: 5px; box-sizing: border-box; }
        .porcentaje { width: 15%; padding-left: 10px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Resultados: <?php echo $encuesta['titulo']; ?></h1>
    <a href="index.php?c=encuestas&a=index">⬅ Volver al Listado</a> | <a href="index.php?c=encuestas&a=responder&id=<?php echo $encuesta['id']; ?>">Responder de Nuevo</a>
    <hr>

    <?php if ($resultados['total_participantes'] == 0): ?>
        <p class="resumen">Aún no hay respuestas para esta encuesta. ¡Sé el primero en responder!</p>
    <?php else: ?>
        <div class="resumen">
            <h2>Total de Participantes: <?php echo $resultados['total_participantes']; ?></h2>
        </div>

        <?php foreach ($resultados['preguntas'] as $preguntaResultado): ?>
            <div class="resultado-pregunta">
                <h3><?php echo $preguntaResultado['pregunta']; ?></h3>
                
                <?php foreach ($preguntaResultado['opciones'] as $opcion): ?>
                    <div class="barra-opcion">
                        <div class="opcion-texto"><?php echo $opcion['texto']; ?>:</div>
                        <div class="barra-contenedor">
                            <div class="barra-progreso" style="width: <?php echo $opcion['porcentaje']; ?>%">
                                <?php echo $opcion['conteo']; ?>
                            </div>
                        </div>
                        <div class="porcentaje"><?php echo $opcion['porcentaje']; ?>%</div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>