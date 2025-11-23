<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Encuesta</title>
    <style>
        body { font-family: sans-serif; max-width: 700px; margin: 20px auto; padding: 0 15px; }
        .form-section { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 8px; margin-top: 20px; }
        input[type="text"], textarea { padding: 8px; margin-bottom: 10px; width: 100%; box-sizing: border-box; }
        textarea { resize: vertical; min-height: 80px; }
        button { background: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; }
        .pregunta-item { border: 1px dashed #ccc; padding: 15px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <h1>➕ Crear Nueva Encuesta</h1>
    <a href="index.php?c=encuestas&a=index">⬅ Volver al Listado</a>
    <hr>

    <?php if (isset($error)): ?>
        <div style="color: red; background: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 15px;"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="index.php?c=encuestas&a=crear" method="POST">
        <div class="form-section">
            <label for="titulo">Título de la Encuesta:</label>
            <input type="text" name="titulo" id="titulo" required>
        </div>

        <h2>Preguntas (Mínimo 1)</h2>
        <div id="preguntas-container">
            <div class="pregunta-item" data-index="0">
                <label>Pregunta 1:</label>
                <input type="text" name="pregunta[0]" placeholder="Ej: ¿Cuál es tu color favorito?" required>
                
                <label>Opciones (Una por línea. Mínimo 2):</label>
                <textarea name="opciones[0]" placeholder="Opción A\nOpción B\nOpción C..." required></textarea>
            </div>
        </div>

        <button type="button" onclick="agregarPregunta()">+ Añadir Otra Pregunta</button>
        <button type="submit" style="float: right;">Guardar Encuesta</button>
    </form>
    
    <script>
        let counter = 1; // Contador para los índices de las nuevas preguntas
        
        function agregarPregunta() {
            const container = document.getElementById('preguntas-container');
            const newIndex = counter++;
            
            const div = document.createElement('div');
            div.className = 'pregunta-item';
            div.setAttribute('data-index', newIndex);
            div.innerHTML = `
                <label>Pregunta ${newIndex + 1}:</label>
                <input type="text" name="pregunta[${newIndex}]" placeholder="Texto de la pregunta" required>
                
                <label>Opciones (Una por línea. Mínimo 2):</label>
                <textarea name="opciones[${newIndex}]" placeholder="Opción A\\nOpción B..." required></textarea>
                <button type="button" onclick="this.parentNode.remove()">Eliminar Pregunta</button>
            `;
            container.appendChild(div);
        }
    </script>
</body>
</html>