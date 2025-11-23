<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Gastos</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 20px auto; padding: 0 15px; }
        .resumen-list { list-style: none; padding: 0; }
        .resumen-item { display: flex; justify-content: space-between; padding: 10px; border-bottom: 1px dashed #ccc; font-size: 1.1em; }
        .total-general { background: #ff5722; color: white; padding: 15px; margin-top: 20px; border-radius: 5px; font-size: 1.5em; text-align: center; }
    </style>
</head>
<body>
    <h1>Ejercicio 4: Resumen de Gastos</h1>
    <p><a href="index.php">⬅ Volver al Menú Principal</a> | <a href="index.php?c=gastos&a=index">➕ Registrar Gasto</a></p>
    <hr>
    
    <h2>Gastos por Categoría:</h2>
    <ul class="resumen-list">
        <?php $totalGeneral = 0; ?>
        <?php foreach ($resumen as $categoria => $monto): ?>
            <?php $totalGeneral += $monto; ?>
            <li class="resumen-item">
                <span><?php echo $categoria; ?>:</span>
                <strong>$<?php echo number_format($monto, 0); ?></strong>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <?php if ($totalGeneral > 0): ?>
        <div class="total-general">
            TOTAL GENERAL: $<?php echo number_format($totalGeneral, 2); ?>
        </div>
    <?php else: ?>
        <p>Aún no hay suficientes datos para generar un resumen.</p>
    <?php endif; ?>
</body>
</html>