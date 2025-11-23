<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Notas</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 20px auto; padding: 0 15px; }
        .form-creacion { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 30px; }
        input[type="text"], textarea { padding: 10px; margin: 5px 0 15px 0; width: 100%; box-sizing: border-box; }
        textarea { resize: vertical; min-height: 100px; }
        button { background: #007bff; color: white; padding: 12px 15px; border: none; border-radius: 5px; cursor: pointer; }
        .nota { border: 1px solid #eee; margin-bottom: 15px; padding: 15px; border-radius: 5px; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .nota h3 { margin-top: 0; color: #333; }
        .nota-footer { display: flex; justify-content: space-between; align-items: center; font-size: 0.85em; color: #666; margin-top: 10px; }
        .btn-eliminar { color: red; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Ejercicio 6: Gestor de Notas</h1>
    <a href="index.php">⬅ Volver al Menú Principal</a>
    <hr>

    <h2>➕ Crear Nueva Nota</h2>
    <div class="form-creacion">
        <form action="index.php?c=notas&a=crear" method="POST">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" placeholder="Título de la Nota" required>
            
            <label for="contenido">Contenido:</label>
            <textarea name="contenido" id="contenido" placeholder="Escribe el contenido de tu nota aquí..."></textarea>
            
            <button type="submit">Guardar Nota</button>
        </form>
    </div>

    <h2>Mis Notas Guardadas</h2>
    <?php if (empty($notas)): ?>
        <p>Aún no tienes notas. ¡Crea una!</p>
    <?php else: ?>
        <?php foreach ($notas as $indice => $nota): ?>
            <div class="nota">
                <h3><?php echo $nota['titulo']; ?></h3>
                <p><?php echo nl2br($nota['contenido']); ?></p> <div class="nota-footer">
                    <span>Guardado el: <?php echo date('d/m/Y H:i', strtotime($nota['fecha'])); ?></span>
                    <a href="index.php?c=notas&a=eliminar&id=<?php echo array_keys($_SESSION['notas'])[$indice]; ?>" class="btn-eliminar" onclick="return confirm('¿Estás seguro de que quieres eliminar esta nota?');">Eliminar</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>