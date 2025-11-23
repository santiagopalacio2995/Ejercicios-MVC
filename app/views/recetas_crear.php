<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Nueva Receta</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 20px auto; padding: 0 15px; }
        input[type="text"], textarea { padding: 10px; margin: 5px 0 15px 0; width: 100%; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        textarea { resize: vertical; min-height: 150px; }
        button { background: #d9534f; color: white; padding: 12px 15px; border: none; border-radius: 5px; cursor: pointer; }
        p.hint { font-size: 0.9em; color: #666; margin-top: -10px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>➕ Añadir Nueva Receta</h1>
    <a href="index.php?c=recetas&a=index">⬅ Volver al Listado</a>
    <hr>
    
    <form action="index.php?c=recetas&a=crear" method="POST">
        <label for="titulo">Título de la Receta:</label>
        <input type="text" name="titulo" id="titulo" placeholder="Ej: Pastel de Chocolate" required>
        
        <label for="ingredientes">Ingredientes:</label>
        <textarea name="ingredientes" id="ingredientes" placeholder="Un ingrediente por línea..."></textarea>
        <p class="hint">Escribe cada ingrediente en una línea separada.</p>

        <label for="pasos">Instrucciones / Pasos:</label>
        <textarea name="pasos" id="pasos" placeholder="Un paso por línea..."></textarea>
        <p class="hint">Escribe cada paso de preparación en una línea separada.</p>
        
        <button type="submit">Guardar Receta</button>
    </form>
</body>
</html>