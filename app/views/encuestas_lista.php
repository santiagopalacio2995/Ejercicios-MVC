<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plataforma de Encuestas</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 20px auto; padding: 0 15px; }
        .encuesta-card { border: 1px solid #cce5ff; background-color: #e6f7ff; padding: 15px; margin-bottom: 15px; border-radius: 8px; }
        .encuesta-card h3 { color: #004085; margin-top: 0; }
        .encuesta-card a { margin-right: 15px; text-decoration: none; color: #007bff; }
        .encuesta-card a.resultados { color: #28a745; }
    </style>
</head>
<body>
    <h1>Ejercicio 10: Plataforma de Encuestas</h1>
    <a href="index.php">⬅ Volver al Menú Principal</a> | <a href="index.php?c=encuestas&a=crear">➕ Crear Nueva Encuesta</a>
    <hr>

    <h2>Encuestas Disponibles</h2>
    <?php if (empty($encuestas)): ?>
        <p>Aún no hay encuestas creadas.</p>
    <?php else: ?>
        <?php foreach ($encuestas as $encuesta): ?>
            <div class="encuesta-card">
                <h3><?php echo $encuesta['titulo']; ?> (<?php echo count($encuesta['preguntas']); ?> Preguntas)</h3>
                <a href="index.php?c=encuestas&a=responder&id=<?php echo $encuesta['id']; ?>">Responder Encuesta</a>
                <a href="index.php?c=encuestas&a=resultados&id=<?php echo $encuesta['id']; ?>" class="resultados">Ver Resultados</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>