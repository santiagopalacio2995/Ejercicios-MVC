<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego de Memoria MVC</title>
    <style>
        body { font-family: sans-serif; text-align: center; }
        .tablero { display: grid; gap: 10px; margin: 20px auto; }
        .card { width: 100%; height: 100%; border: 2px solid #333; border-radius: 8px; cursor: pointer; display: flex; justify-content: center; align-items: center; font-size: 2em; font-weight: bold; user-select: none; }
        .hidden { background-color: #3c8dbc; color: white; transition: background-color 0.3s; }
        .hidden:hover { background-color: #337a9f; }
        .shown { background-color: #f0f0f0; color: #333; }
        .matched { background-color: #d4edda; color: #155724; border-color: #155724; pointer-events: none; } /* Desactiva el click */
        .card a { text-decoration: none; color: inherit; display: flex; justify-content: center; align-items: center; width: 100%; height: 100%; }
        .score-info { margin-bottom: 20px; border: 1px solid #ccc; padding: 15px; border-radius: 8px; background: #f9f9f9; }
        .links a { margin: 0 10px; text-decoration: none; color: #d9534f; font-weight: bold; }
        
        /* Ajuste de Grid según la dimensión */
        <?php if (isset($estado['dimension'])): ?>
            .tablero { 
                grid-template-columns: repeat(<?php echo $estado['dimension']; ?>, 1fr); 
                width: <?php echo $estado['dimension'] * 100 + ($estado['dimension'] * 10); ?>px;
            }
            .card { height: 100px; }
        <?php endif; ?>
    </style>
</head>
<body>
    <h1>Ejercicio 9: Juego de Memoria</h1>
    <a href="index.php">⬅ Volver al Menú Principal</a>
    <hr>
    
    <div class="score-info">
        <h3><?php echo $estado['mensaje'] ?? 'Selecciona una dificultad para empezar'; ?></h3>
        <?php if (isset($estado)): ?>
            <p>
                Puntuación: <strong><?php echo $estado['score']; ?></strong> | 
                Intentos: <?php echo $estado['intentos']; ?> | 
                Pares Restantes: <?php echo $estado['pares_restantes']; ?>
            </p>
        <?php endif; ?>

        <div class="links">
            <p>Iniciar nuevo juego:</p>
            <a href="index.php?c=juego&a=iniciar&dificultad=facil">4x4 (Fácil)</a> |
            <a href="index.php?c=juego&a=iniciar&dificultad=dificil">6x6 (Difícil)</a>
        </div>
    </div>

    <?php if (isset($estado['tablero'])): ?>
        <div class="tablero">
            <?php foreach ($estado['tablero'] as $card): ?>
                <?php 
                    $clase = $card['estado'];
                    $contenido = ($clase == 'hidden') ? '' : $card['valor'];
                    $url = "index.php?c=juego&a=voltear&index={$card['index']}";
                ?>
                <div class="card <?php echo $clase; ?>">
                    <?php if ($clase == 'hidden'): ?>
                        <a href="<?php echo $url; ?>" title="Voltear carta">?</a>
                    <?php else: ?>
                        <?php echo $contenido; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>
