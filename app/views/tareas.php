<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>
    <style>
        /* Estilos simples para que se vea decente */
        body { font-family: sans-serif; max-width: 600px; margin: 20px auto; text-align: center; }
        ul { list-style: none; padding: 0; }
        li { background: #f4f4f4; border-bottom: 1px solid #ddd; padding: 10px; display: flex; justify-content: space-between; }
        button { background: #28a745; color: white; border: none; padding: 10px; cursor: pointer; }
        input { padding: 10px; width: 70%; }
        .btn-borrar { color: red; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Ejercicio 1: Lista de Tareas</h1>
    <a href="index.php">⬅ Volver al Menú Principal</a>
    <hr>

    <form action="index.php?c=tareas&a=agregar" method="POST">
        <input type="text" name="descripcion" placeholder="Escribe una tarea nueva..." required>
        <button type="submit">Agregar Tarea</button>
    </form>

    <h3>Mis Tareas Pendientes:</h3>
    <ul>
        <?php foreach ($tareas as $indice => $tarea): ?>
            <li>
                <span><?php echo $tarea['nombre']; ?></span>
                
                <a href="index.php?c=tareas&a=eliminar&id=<?php echo $indice; ?>" class="btn-borrar">[  REALIZADA  ]</a>
            </li>
        <?php endforeach; ?>
        
        <?php if (empty($tareas)): ?>
            <p>No tienes tareas pendientes. ¡Bien hecho!</p>
        <?php endif; ?>
    </ul>
</body>
</html>