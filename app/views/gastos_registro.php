<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Gastos</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 20px auto; padding: 0 15px; }
        .registro-form { padding: 20px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 30px; }
        input, select { padding: 10px; margin: 5px 0 15px 0; width: 100%; box-sizing: border-box; }
        button { background: #ff5722; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Ejercicio 4: Gestor de Gastos</h1>
    <p><a href="index.php">⬅ Volver al Menú Principal</a> | <a href="index.php?c=gastos&a=resumen">📈 Ver Resumen</a></p>
    <hr>

    <h2>💸 Registrar Nuevo Gasto</h2>
    <div class="registro-form">
        <form action="index.php?c=gastos&a=agregar" method="POST">
            <label for="monto">Monto:</label>
            <input type="number" step="1000" name="monto" id="monto" placeholder="Ej: $50.000" required>
            
            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria" required>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="descripcion">Descripción (Opcional):</label>
            <input type="text" name="descripcion" id="descripcion" placeholder="Ej: Comida con amigos">
            
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d'); ?>" required>
            
            <button type="submit">Guardar Gasto</button>
        </form>
    </div>

    <h2>Historial de Gastos</h2>
    <?php if (empty($gastos)): ?>
        <p>Aún no hay gastos registrados.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gastos as $gasto): ?>
                    <tr>
                        <td><?php echo $gasto['fecha']; ?></td>
                        <td>$<?php echo number_format($gasto['monto'], 0); ?></td>
                        <td><?php echo $gasto['categoria']; ?></td>
                        <td><?php echo $gasto['descripcion']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>