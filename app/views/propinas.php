<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Propinas</title>
    <style>
        body { font-family: sans-serif; max-width: 500px; margin: 20px auto; text-align: center; }
        .card { border: 1px solid #ccc; padding: 20px; border-radius: 8px; box-shadow: 2px 2px 10px rgba(0,0,0,0.1); }
        input, select, button { padding: 10px; margin: 10px 0; width: 80%; }
        button { background: #007bff; color: white; border: none; cursor: pointer; }
        .resultado { background: #e2f0d9; padding: 15px; margin-top: 20px; border-radius: 5px; border: 1px solid #aeb; }
    </style>
</head>
<body>
    <h1>Ejercicio 2: Calculadora de Propinas</h1>
    <a href="index.php">⬅ Volver al Menú</a>
    <hr>

    <div class="card">
        <form action="index.php?c=propinas&a=index" method="POST">
            <label>Total de la Cuenta ($):</label><br>
            <input type="number" step="0.01" name="cuenta" placeholder="Ej: 50.000" required>
            
            <br>
            <label>Porcentaje de Propina:</label><br>
            <select name="porcentaje">
                <option value="10">10% (Normal)</option>
                <option value="15">15% (Bueno)</option>
                <option value="20">20% (Excelente)</option>
                <option value="5">5% (Malo)</option>
            </select>
            
            <br>
            <button type="submit">Calcular</button>
        </form>

        <?php if (isset($resultado)): ?>
            <div class="resultado">
                <h3>Resultados:</h3>
                <p>Propina (<?php echo $resultado['porcentaje']; ?>%): <strong>$<?php echo $resultado['propina']; ?></strong></p>
                <hr>
                <h2>Total a Pagar: $<?php echo $resultado['total']; ?></h2>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>