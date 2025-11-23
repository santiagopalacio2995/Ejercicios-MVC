<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Responder Encuesta: <?php echo $encuesta['titulo']; ?></title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 20px auto; padding: 0 15px; }
        .pregunta-bloque { margin-bottom: 25px; border: 1px solid #ddd; padding: 15px; border-radius: 8px; }
        .pregunta-bloque h3 { margin-top: 0; color: #333; }
        .opcion { margin-bottom: 10px; }
        .opcion label { cursor: pointer; display: block; padding: 5px; border-radius: 4px; }
        .opcion label:hover { background-color: #f0f0f0; }
        input[type="radio"] { margin-right: 10px; }
    </style>
</head>
<body>
    <h1>Responder Encuesta: <?php echo $encuesta['titulo']; ?></h1>
    <a href="index.php?c=encuestas&a=index">⬅ Volver al Listado</a>
    <hr>
    
    <?php if (isset($error)): ?>
        <div style="color: red; background: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 15px;"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="index.php?c=encuestas&a=responder&id=<?php echo $encuesta['id']; ?>" method="POST">
        <?php foreach ($encuesta['preguntas'] as $qIndex => $pregunta): ?>
            <div class="pregunta-bloque">
                <h3><?php echo ($qIndex + 1) . '. ' . $pregunta['texto']; ?></h3>
                
                <?php foreach ($pregunta['opciones'] as $oIndex => $opcion): ?>
                    <div class="opcion">
                        <label>
                            <input type="radio" name="respuesta[<?php echo $qIndex; ?>]" value="<?php echo $oIndex; ?>" required>
                            <?php echo $opcion; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <button type="submit">Enviar Respuestas</button>
    </form>
</body>
</html>